@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Editar Venta: {{$venta->id}}</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Actualice los datos de la venta</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ventas.update', $venta->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_id">Identificador del Vendedor</label><b>*</b>
                                    <select name="user_id" class="form-control" required>
                                        <option value="" disabled>Seleccionar vendedor...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == old('user_id', $venta->user_id) ? 'selected' : '' }}>
                                                {{ $user->codigo }} - {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label><b>*</b>
                                    <input type="date" name="fecha" value="{{ old('fecha', $venta->fecha) }}" class="form-control" required>
                                    @error('fecha')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total">Total</label><b>*</b>
                                    <input type="number" name="total" value="{{ old('total', $venta->total) }}" class="form-control" required step="0.01">
                                    @error('total')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="articulo">Articulo</label><b>*</b>
                                    <select name="articulo" class="form-control" required>
                                        <option value="" disabled>Seleccionar...</option>
                                        <option value="Articulo1" {{ old('articulo', $venta->articulo) == 'Articulo1' ? 'selected' : '' }}>Articulo1</option>
                                        <option value="Articulo2" {{ old('articulo', $venta->articulo) == 'Articulo2' ? 'selected' : '' }}>Articulo2</option>
                                        <option value="Articulo3" {{ old('articulo', $venta->articulo) == 'Articulo3' ? 'selected' : '' }}>Articulo3</option>
                                        <option value="Articulo4" {{ old('articulo', $venta->articulo) == 'Articulo4' ? 'selected' : '' }}>Articulo4</option>
                                        <option value="Articulo5" {{ old('articulo', $venta->articulo) == 'Articulo5' ? 'selected' : '' }}>Articulo5</option>
                                    </select>
                                    @error('articulo')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label><b>*</b>
                                    <input type="number" name="cantidad" value="{{ old('cantidad', $venta->cantidad) }}" class="form-control" required>
                                    @error('cantidad')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="metodo_pago">Método de Pago</label><b>*</b>
                                    <select name="metodo_pago" class="form-control" required>
                                        <option value="" disabled>Seleccionar...</option>
                                        <option value="Efectivo" {{ old('metodo_pago', $venta->metodo_pago) == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                        <option value="Tarjeta" {{ old('metodo_pago', $venta->metodo_pago) == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                        <option value="Transferencia" {{ old('metodo_pago', $venta->metodo_pago) == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                                        <option value="Otro" {{ old('metodo_pago', $venta->metodo_pago) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('metodo_pago')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label><b>*</b>
                                    <select name="cliente" class="form-control" required>
                                        <option value="" disabled>Seleccionar...</option>
                                        <option value="Cliente1" {{ old('cliente', $venta->cliente) == 'Cliente1' ? 'selected' : '' }}>Cliente1</option>
                                        <option value="Cliente2" {{ old('cliente', $venta->cliente) == 'Cliente2' ? 'selected' : '' }}>Cliente2</option>
                                        <option value="Cliente3" {{ old('cliente', $venta->cliente) == 'Cliente3' ? 'selected' : '' }}>Cliente3</option>
                                        <option value="Cliente4" {{ old('cliente', $venta->cliente) == 'Cliente4' ? 'selected' : '' }}>Cliente4</option>
                                        <option value="Otro" {{ old('cliente', $venta->cliente) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('cliente')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/ventas') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Actualizar Venta</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
