<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venta;
use App\Models\Session;
use App\Models\UserSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function index()
    {
        $total_usuarios = User::count();
        $total_ventas = Venta::count();


        // Se obtiene el tiempo actual menos
        $limiteTiempo = Carbon::now()->subSeconds(60)->timestamp;



        // Consultar los usuarios activos en la tabla sessions
        $usuarios = DB::table('sessions')
            ->where('last_activity', '>=', $limiteTiempo)
            ->join('users', 'sessions.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.email', 'sessions.last_activity', 'sessions.ip_address', 'sessions.user_agent')
            ->get();

        $total_online = $usuarios->count();

        return view('admin.index', compact(
            'total_usuarios',
            'total_ventas',
            'total_online',
        ));
    }

  

public function mostrarGrafico()
{
    // Obtener ventas del año 2024 y 2025 agrupadas por mes
    $ventas2024 = Venta::whereYear('fecha', 2024)
        ->select(DB::raw('MONTH(fecha) as mes'), DB::raw('SUM(total) as total_ventas'))
        ->groupBy(DB::raw('MONTH(fecha)'))
        ->pluck('total_ventas', 'mes')
        ->toArray();

    $ventas2025 = Venta::whereYear('fecha', 2025)
        ->select(DB::raw('MONTH(fecha) as mes'), DB::raw('SUM(total) as total_ventas'))
        ->groupBy(DB::raw('MONTH(fecha)'))
        ->pluck('total_ventas', 'mes')
        ->toArray();

    // Asegurarse de que ambos arrays tengan los mismos meses (de 1 a 12)
    $ventas2024 = array_replace(array_fill(1, 12, 0), $ventas2024);
    $ventas2025 = array_replace(array_fill(1, 12, 0), $ventas2025);

    // Log para verificar los datos
    Log::info('Ventas 2024:', $ventas2024);
    Log::info('Ventas 2025:', $ventas2025);

    // Pasar los datos a la vista
    return view('admin.index', [
        'ventas2024' => array_values($ventas2024), // Valores de ventas 2024
        'ventas2025' => array_values($ventas2025), // Valores de ventas 2025
    ]);
}

}
