<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $database = session('database');
        if ($database) {
            Config::set('database.default', $database);
        }

        $user = Auth::user();

        if ($user && $user->two_factor_code && !$user->two_factor_verified) {
            return redirect()->route('verify');
        }

        return $next($request);
    }
}
