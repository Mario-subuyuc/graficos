<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\User;
use Carbon\Carbon;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        
        return view('admin.ventas.index', compact('ventas'));
    }

    public function create()
    {
        $users = User::all(); 
        return view('admin.ventas.create', compact('users'));
        return view('admin.ventas.create');
    }

    public function store(Request $request)
    {
        //usado para pruebas en formato json y ver datos de nuevo ingreso de registros  
        //$datos = $request->all();    
        //return response()->json($datos);

        $request->validate([
            'user_id' => 'required|numeric|exists:users,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0', 
            'articulo' => 'required|in:Articulo1,Articulo2,Articulo3,Articulo4,Articulo5',
            'cantidad' => 'required|numeric|min:1', 
            'metodo_pago' => 'required|in:Efectivo,Tarjeta,Transferencia,Otro',
            'cliente' => 'required|in:Cliente1,Cliente2,Cliente3,Cliente4,Otro',
        ]);

        $venta = new Venta();
        $venta->user_id  = $request->user_id;
        $venta->fecha = $request->fecha;
        $venta->total = $request->total;
        $venta->articulo = $request->articulo;
        $venta->cantidad = $request->cantidad;
        $venta->metodo_pago = $request->metodo_pago;
        $venta->cliente = $request->cliente;
        $venta->save();

        return redirect()->route('admin.ventas.index')
            ->with([
                'mensaje' => 'Se registró la venta correctamente',
                'icono' => 'success'
            ]);
    }

    public function show($id)
    {
        $venta = Venta::with('usuario')->findOrFail($id);

        return view('admin.ventas.show', compact('venta'));
    }


    public function edit($id)
    {

        $venta = Venta::findOrFail($id);
        $users = User::all();

        return view('admin.ventas.edit', compact('venta', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|numeric|exists:users,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0', 
            'articulo' => 'required|in:Articulo1,Articulo2,Articulo3,Articulo4,Articulo5',
            'cantidad' => 'required|numeric|min:1', 
            'metodo_pago' => 'required|in:Efectivo,Tarjeta,Transferencia,Otro',
            'cliente' => 'required|in:Cliente1,Cliente2,Cliente3,Cliente4,Otro',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($request->all());

        return redirect()->route('admin.ventas.index')
            ->with([
                'mensaje' => 'Se actualizó correctamente',
                'icono' => 'success'
            ]);
    }

        public function confirmDelete($id)
        {
            $venta = Venta::findOrFail($id);
            return view('admin.ventas.delete', compact('venta'));
        }
    
        public function destroy($id)
        {
            Venta::destroy($id);
    
            return redirect()->route('admin.ventas.index')
                ->with('mensaje', 'Se eliminó la venta correctamente')
                ->with('icono', 'success');
        }
}
