@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registro de una nueva venta</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">LLene los datos de la venta a guardar</h3>
                </div>
                <div class="card-body">
                    <form action= "{{ url('/admin/ventas/create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_id">Identificador del Vendedor</label><b>*</b>
                                    <select name="user_id" class="form-control" required>
                                        <option value="" disabled {{ old('user_id') == '' ? 'selected' : '' }}>Seleccionar vendedor...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
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
                                    <label for = " ">Fecha</label><b>*</b>
                                    <input type ="date" value= "{{ old('fecha') }}" name="fecha" class="form-control"
                                        required>
                                    @error('fecha')
                                        <small style = "color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for = " ">Total</label><b>*</b>
                                    <input type ="number" value= "{{ old('total') }}" name="total" class="form-control"
                                        required step="0.01">
                                    @error('total')
                                        <small style = "color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="articulo">Articulo</label><b>*</b>
                                    <select name="articulo" class="form-control" required>
                                        <option value="" disabled {{ old('articulo') == '' ? 'selected' : '' }}>
                                            Seleccionar...</option>
                                        <option value="Articulo1" {{ old('articulo') == 'Articulo1' ? 'selected' : '' }}>
                                            Articulo1</option>
                                        <option value="Articulo2" {{ old('articulo') == 'Articulo2' ? 'selected' : '' }}>
                                            Articulo2</option>
                                        <option value="Articulo3" {{ old('articulo') == 'Articulo3' ? 'selected' : '' }}>
                                            Articulo3</option>
                                        <option value="Articulo4" {{ old('articulo') == 'Articulo4' ? 'selected' : '' }}>
                                            Articulo4</option>
                                        <option value="Articulo5" {{ old('articulo') == 'Articulo5' ? 'selected' : '' }}>
                                            Articulo5</option>
                                    </select>
                                    @error('articulo')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for = " ">Cantidad</label><b>*</b>
                                    <input type ="number" value= "{{ old('cantidad') }}" name="cantidad"
                                        class="form-control" required>
                                    @error('cantidad')
                                        <small style = "color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="metodo_pago">Método Pago</label><b>*</b>
                                    <select name="metodo_pago" class="form-control" required>
                                        <option value="" disabled {{ old('metodo_pago') == '' ? 'selected' : '' }}>
                                            Seleccionar...</option>
                                        <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>
                                            Efectivo</option>
                                        <option value="Tarjeta" {{ old('metodo_pago') == 'Tarjeta' ? 'selected' : '' }}>
                                            Tarjeta</option>
                                        <option value="Transferencia"
                                            {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia
                                        </option>
                                        <option value="Otro" {{ old('metodo_pago') == 'Otro' ? 'selected' : '' }}>Otro
                                        </option>
                                    </select>
                                    @error('metodo_pago')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="cliente">Cliente</label><b>*</b>
                                    <select name="cliente" class="form-control" required>
                                        <option value="" disabled {{ old('cliente') == '' ? 'selected' : '' }}>Seleccionar...</option>
                                        <option value="Cliente1" {{ old('cliente') == 'Cliente1' ? 'selected' : '' }}>Cliente1</option>
                                        <option value="Cliente2" {{ old('cliente') == 'Cliente2' ? 'selected' : '' }}>Cliente2</option>
                                        <option value="Cliente3" {{ old('cliente') == 'Cliente3' ? 'selected' : '' }}>Cliente3</option>
                                        <option value="Cliente4" {{ old('cliente') == 'Cliente4' ? 'selected' : '' }}>Cliente4</option>
                                        <option value="Otro" {{ old('cliente') == 'Otro' ? 'selected' : '' }}>Otro</option>
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
                                    <a href="{{ url('admin/ventas') }}" class= "btn btn-secondary">Cancelar</a>
                                    <button type ="submit" class= "btn btn-primary">Registar Venta</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection