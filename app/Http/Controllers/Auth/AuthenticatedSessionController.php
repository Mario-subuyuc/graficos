<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Obtener la base de datos seleccionada
        $database = $request->input('database');

        // Validar que la base de datos sea válida
        $validDatabases = ['mysql', 'pgsql', 'sqlsrv','oracle'];
        if (!in_array($database, $validDatabases)) {
            return back()->withErrors(['database' => 'Selección de base de datos inválida']);
        }

        // Guardar la base de datos en la sesión para mantener la selección en cada petición
        session(['database' => $database]);

        // Cambiar la conexión de base de datos
        Config::set('database.default', $database);

        // Cambiar la conexión para las sesiones
        Config::set('session.connection', $database);

        // Limpiar y reconectar la base de datos
        try {
            DB::purge($database);
            DB::reconnect($database);

            // Verificar si la conexión funciona
            DB::connection($database)->getPdo();  // Esto intentará obtener el PDO para verificar la conexión
        } catch (\Exception $e) {
            // En caso de error, devuelve al usuario a la página de login con un mensaje adecuado
            return back()->withErrors(['database' => 'No se pudo conectar a la base de datos seleccionada. Por favor, elija otra base de datos.']);
        }


        // Regenerar sesión
        $request->session()->regenerate();

        // Intentar autenticar al usuario en la base de datos seleccionada
        $request->authenticate();



        // Verifica si el usuario tiene 2FA habilitado y no verificado
        $user = $request->user();
        if ($user && !$user->two_factor_verified) {
            $user->regenerateTwoFactorCode();
            $user->notify(new TwoFactorCodeNotification());
            return redirect()->route('verify');
        }

        // Si todo es correcto, redirige al dashboard
        return redirect()->intended(route('dashboard'));
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
