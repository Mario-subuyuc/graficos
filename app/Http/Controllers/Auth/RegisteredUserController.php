<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Notifications\TwoFactorCodeNotification;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // Obtener el último código registrado
        $ultimoCodigo = User::orderBy('codigo', 'desc')->value('codigo');

        // Si no hay códigos en la BD, inicia en 1000; de lo contrario, incrementa el último código
        $nuevoCodigo = $ultimoCodigo ? $ultimoCodigo + 1 : 1000;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'codigo' => $nuevoCodigo, // Código generado automáticamentel
        ]);


        // Generar código de 2FA y enviarlo por correo
        $user->regenerateTwoFactorCode();
        $user->notify(new TwoFactorCodeNotification());
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verify');
    }
}
