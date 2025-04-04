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

        $inicioAño = Carbon::now()->startOfYear()->toDateString();
        $finAño = Carbon::now()->endOfYear()->toDateString();

        $ventas2024 = Venta::whereBetween('fecha', ['2024-01-01', '2024-12-31'])->get();
        $ventas2025 = Venta::whereBetween('fecha', [$inicioAño, $finAño])->get();

        $ventasProducto2025 = $ventas2025->groupBy('articulo')->map(function ($ventas){
            return $ventas->sum('cantidad');
        });
    
        $totalVentas2024 = [];
        $totalVentas2025 = [];

        foreach ($ventas2024 as $venta) {
            $mes = Carbon::parse($venta['fecha'])->format('n'); // Obtener el mes (1-12)
            if (!isset($totalVentas2024[$mes])) {
                $totalVentas2024[$mes] = 0;
            }
            $totalVentas2024[$mes] += $venta['total'];
        }
        foreach ($ventas2025 as $venta) {
            $mes = Carbon::parse($venta['fecha'])->format('n'); // Obtener el mes (1-12)
            if (!isset($totalVentas2025[$mes])) {
                $totalVentas2025[$mes] = 0;
            }
            $totalVentas2025[$mes] += $venta['total'];
        }

        unset($ventas2024, $ventas2025);

        return view('admin.index', compact(
            'totalVentas2024', // Valores de ventas 2024
            'totalVentas2025', // Valores de ventas 2024
            'ventasProducto2025', // Valores de ventas 2025	
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



        // Pasar los datos a la vista
        return view('admin.index', [
            'ventas2024' => array_values($ventas2024), // Valores de ventas 2024
            'ventas2025' => array_values($ventas2025), // Valores de ventas 2025
        ]);
    }
}
