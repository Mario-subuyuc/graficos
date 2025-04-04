<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SessionController extends Controller
{
    public function index()
    {
        // Se obtiene el tiempo actual menos
        $limiteTiempo = Carbon::now()->subSeconds(60)->timestamp;

        // Consultar los usuarios activos en la tabla sessions
        $usuarios = DB::table('sessions')
            ->where('last_activity', '>=', $limiteTiempo)
            ->join('users', 'sessions.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.email', 'sessions.last_activity', 'sessions.ip_address', 'sessions.user_agent')
            ->get();

        return view('admin.sesiones.index', compact('usuarios'));
    }

    // Función para obtener los usuarios activos para la petición AJAX
    public function obtenerUsuariosActivos()
    {
        $limiteTiempo = Carbon::now()->subSeconds(60)->timestamp;

        $usuarios = DB::table('sessions')
            ->where('last_activity', '>=', $limiteTiempo)
            ->join('users', 'sessions.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.email', 'sessions.last_activity', 'sessions.ip_address', 'sessions.user_agent')
            ->get();

        // Si la solicitud es por AJAX, devolver en formato JSON
        return response()->json($usuarios);
    }
}
