@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Detalle de Venta: {{$venta->id}}</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detalles de la venta</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_id">Identificador del Vendedor</label>
                                    <input type="text" value="{{ $venta->usuario->codigo }} - {{ $venta->usuario->name }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" value="{{ $venta->fecha }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="number" value="{{ $venta->total }}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="articulo">Articulo</label>
                                    <input type="text" value="{{ $venta->articulo }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" value="{{ $venta->cantidad }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="metodo_pago">Método de Pago</label>
                                    <input type="text" value="{{ $venta->metodo_pago }}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <input type="text" value="{{ $venta->cliente }}" class="form-control" readonly>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cliente">Creado en</label>
                                    <input type="text" value="{{ $venta->created_at }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cliente">Ultima actualización</label>
                                    <input type="text" value="{{ $venta->updated_at }}" class="form-control" readonly>
                                </div>
                            </div> --}}
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/ventas') }}" class="btn btn-secondary">Volver a la lista</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
