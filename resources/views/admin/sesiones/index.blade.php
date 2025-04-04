@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Usuarios Activos Ahora</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">   
                <h3 class="card-title">Usuarios Online</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Nombre</th>
                            <th scope="col" style="text-align: center">Correo</th>
                        </tr>
                    </thead>
                    <tbody id="usuarios_online">
                        <!-- Aquí se actualizarán los usuarios activos -->
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td style="text-align: center">{{$loop->iteration}}</td>
                                <td style="text-align: center">{{$usuario->name}}</td>
                                <td style="text-align: center">{{$usuario->email}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>               
            </div>
        </div>
    </div>    
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Hacer la petición AJAX cada 10 segundos
    setInterval(function() {
        $.ajax({
            url: "{{ route('admin.sesiones.obtener') }}", // La ruta para obtener los usuarios activos
            method: "GET",
            dataType: "json",
            success: function(data) {
                // Limpiar la tabla actual
                $('#usuarios_online').empty();

                // Agregar los usuarios actualizados
                $.each(data, function(index, usuario) {
                    $('#usuarios_online').append(`
                        <tr>
                            <td style="text-align: center">${index + 1}</td>
                            <td style="text-align: center">${usuario.name}</td>
                            <td style="text-align: center">${usuario.email}</td>
                        </tr>
                    `);
                });
            }
        });
    }, 10000); 
@endsection
@endsection
