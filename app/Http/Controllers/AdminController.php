<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venta;
use App\Models\Session;
use App\Models\UserSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;


class AdminController extends Controller
{
    public function index()
    {
        $total_usuarios = User::count();
        $total_ventas1 = Venta::count();
        $total_ventas2 = Venta::whereYear('fecha', 2025)->count();
        $limiteTiempo = Carbon::now()->subSeconds(30)->timestamp;



        // Consultar los usuarios activos en la tabla sessions
        $usuarios = DB::table('sessions')
            ->where('last_activity', '>=', $limiteTiempo)
            ->get();
        $total_online = $usuarios->count();

        // Obtén el nombre de la conexión activa
        $connectionName = Config::get('database.default');
        // Obtén el tipo de base de datos (mysql, pgsql, sqlsrv, etc.) de la conexión activa
        $conexion  = Config::get('database.connections.' . $connectionName . '.driver');

        //ventas totales por año
        $ventas2024 = Venta::whereBetween('fecha', ['2024-01-01', '2024-12-31'])->get();
        $ventas2025 = Venta::whereBetween('fecha', [
            Carbon::now()->startOfYear()->toDateString(),
            Carbon::now()->endOfYear()->toDateString()
        ])->get();

        $totalVentas2024 = [];
        $totalVentas2025 = [];

        foreach ($ventas2024 as $venta) {
            $mes = Carbon::parse($venta['fecha'])->format('n');
            if (!isset($totalVentas2024[$mes])) {
                $totalVentas2024[$mes] = 0;
            }
            $totalVentas2024[$mes] += $venta['total'];
        }
        foreach ($ventas2025 as $venta) {
            $mes = Carbon::parse($venta['fecha'])->format('n');
            if (!isset($totalVentas2025[$mes])) {
                $totalVentas2025[$mes] = 0;
            }
            $totalVentas2025[$mes] += $venta['total'];
        }

        //compras totales por articulo 2025
        $ventasProducto2025 = $ventas2025->groupBy('articulo')->map(function ($ventas) {
            return $ventas->sum('cantidad');
        });

        //compras totales por usuario 2025
        $ventasUsuario2025 = $ventas2025->groupBy(function ($venta) {
            return $venta->usuario->name;
        })->map(function ($ventas) {
            return $ventas->sum('total');
        });

        //compras totales por cliente 2025
        $ventasPorCliente = DB::table('ventas')
            ->select('cliente', DB::raw('SUM(total) as total_compras'))
            ->whereYear('fecha', 2025)  // Filtrar solo ventas del año 2025
            ->groupBy('cliente')
            ->get();
        $clientes = $ventasPorCliente->pluck('cliente')->toArray(); // Lista de clientes
        $totales = $ventasPorCliente->pluck('total_compras')->toArray(); // Lista de totales de compras

        // Preparar los datos para el gráfico
        $barChartData = [
            'labels'  => $clientes,
            'datasets' => [
                [
                    'label' => 'Total Compras',
                    'data'  => $totales,
                    'backgroundColor' => 'rgba(86, 206, 158, 0.9)',
                    'borderColor' => 'rgba(0, 0, 0, 0.8)',
                    'borderWidth' => 1
                ]
            ]
        ];

        //ventas totales por metodo de pago 2025
        $ventasPorMetodoPago = DB::table('ventas')
            ->select('metodo_pago', DB::raw('SUM(total) as total_compras'))
            ->whereYear('fecha', 2025)  // Filtrar solo ventas del año 2025
            ->groupBy('metodo_pago')
            ->get();

        $metodosPago = $ventasPorMetodoPago->pluck('metodo_pago')->toArray(); // Lista de métodos de pago
        $totalesMetodoPago = $ventasPorMetodoPago->pluck('total_compras')->toArray(); // Lista de totales de compras por método de pago

        // Preparar los datos para el gráfico
        $barChartDataMetodoPago = [
            'labels'  => $metodosPago,
            'datasets' => [
                [
                    'label' => 'Total Compras por Método de Pago',
                    'data'  => $totalesMetodoPago,
                    'backgroundColor' => 'rgba(74, 84, 192, 0.9)',
                    'borderColor' => 'rgba(1, 1, 1, 0.8)',
                    'borderWidth' => 1
                ]
            ]
        ];

        /*
        //no lo toquez y falla
        $driver = DB::getDriverName();
        switch ($driver) {
            case 'sqlsrv':
                $monthExpression = "MONTH([fecha])";
                break;
            case 'pgsql':
                $monthExpression = "EXTRACT(MONTH FROM fecha)";
                break;
            default: // mysql, mariadb
                $monthExpression = "MONTH(fecha)";
                break;
        }
        $ventasSubquery = DB::table('ventas')
            ->select(
                DB::raw("$monthExpression AS mes"),
                'articulo',
                DB::raw('SUM(cantidad) as total_vendido')
            )
            ->whereYear('fecha', 2025)
            ->groupBy(DB::raw($monthExpression), 'articulo');

        $ventasPorMes = DB::table(DB::raw("({$ventasSubquery->toSql()}) as sub"))
            ->mergeBindings($ventasSubquery)
            ->select('mes', 'articulo', 'total_vendido')
            ->orderBy('mes')
            ->orderByDesc('total_vendido')
            ->get();
        $productosPorMes = [];

        foreach ($ventasPorMes as $venta) {
            if (!isset($productosPorMes[$venta->mes])) {
                $productosPorMes[$venta->mes] = [[
                    'articulo' => $venta->articulo,
                    'total_vendido' => $venta->total_vendido
                ]]; // Solo el más vendido
            }
        }
        //hasta por aca           
        */


        $hoy = Carbon::today();

        // 1. Ventas del día (suma total)
        $ventasHoy = DB::table('ventas')
            ->whereDate('fecha', $hoy)
            ->sum(DB::raw('cantidad '));

        // 2. Producto estrella del día (más vendido hoy por cantidad)
        $productoEstrella = DB::table('ventas')
            ->select('articulo', DB::raw('SUM(cantidad) as total_cantidad'))
            ->whereDate('fecha', $hoy)
            ->groupBy('articulo')
            ->orderByDesc('total_cantidad')
            ->limit(1)
            ->value('articulo'); // Devuelve solo el nombre del artículo


        // 3. Promedio de ingreso por venta (hoy)
        $promedioVenta = DB::table('ventas')
            ->whereDate('fecha', $hoy)
            ->sum(DB::raw('total'));

        // 4. Total de transacciones del día (ventas realizadas)
        $transaccionesHoy = DB::table('ventas')
            ->whereDate('fecha', $hoy)
            ->count();


        //no nover
        unset($ventas2024, $ventas2025);

        //envio de informacion a la vista
        return view('admin.index', compact(
            'totalVentas2024',
            'totalVentas2025',
            'ventasProducto2025',
            'ventasUsuario2025',
            'barChartData',
            'barChartDataMetodoPago',
            'total_usuarios',
            'total_ventas1',
            'total_ventas2',
            'total_online',
            //'productosPorMes',
            'ventasHoy',
            'productoEstrella',
            'promedioVenta',
            'transaccionesHoy',
            'conexion'

        ));
    }
}
