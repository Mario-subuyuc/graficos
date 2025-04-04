@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registro de Ventas</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ventas Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/ventas/create') }}" class="btn btn-primary">
                            Registrar Nueva Venta
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover  table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="text-align: center">Nro</th>
                                <th scope="col" style="text-align: center">Vendedor</th>
                                <th scope="col" style="text-align: center">Fecha</th>
                                <th scope="col" style="text-align: center">Cantidad</th>
                                <th scope="col" style="text-align: center">Articulo</th>
                                <th scope="col" style="text-align: center">Total</th>
                                <th scope="col" style="text-align: center">Método Pago</th>
                                <th scope="col" style="text-align: center">Cliente</th>
                                <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($ventas as $venta)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: center">{{  $venta->usuario->name}}</td>
                                    <td style="text-align: center">{{ $venta->fecha }}</td>
                                    <td style="text-align: center">{{ $venta->cantidad}}</td>
                                    <td style="text-align: center">{{ $venta->articulo }}</td>
                                    <td style="text-align: center">{{ $venta->total }}</td>
                                    <td style="text-align: center">{{ $venta->metodo_pago }}</td>
                                    <td style="text-align: center">{{ $venta->cliente }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('admin/ventas/' . $venta->id) }}" type="button"
                                                class="btn btn-info btn-sm"><i class="bi bi-eye">Ver</i></a>
                                            <a href="{{ url('admin/ventas/' . $venta->id . '/edit') }}" type="button"
                                                class="btn btn-success btn-sm"><i class="bi bi-pencil"></i>Editar</a>
                                            <a href="{{ url('admin/ventas/' . $venta->id . '/confirm-delete') }}"
                                                type="button" class="btn btn-danger btn-sm"><i
                                                    class="bi bi-trash3"></i>Borrar</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(function() {
                            $("#example1").DataTable({
                                "pageLength": 5,
                                "lengthMenu": [
                                    [5, 10, 20, -1],
                                    [5, 10, 20, "Todos"]
                                ], // Configura las opciones de filas por página
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Ventas",
                                    "infoFiltered": "(Filtrado de _MAX_ total de Ventas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Ventas  ",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true,
                                "lengthChange": true,
                                "autoWidth": false,
                                buttons: [{
                                        extend: 'collection',
                                        text: '<i class="bi bi-file-earmark-text"></i> Reportes',
                                        orientation: 'landscape',
                                        buttons: [{
                                            text: '<i class="bi bi-clipboard"></i> Copiar',
                                            extend: 'copy',
                                            exportOptions: { columns: ':visible:not(.no-export)' }
                                        }, {
                                            text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                                            extend: 'pdf',
                                            exportOptions: { columns: ':visible:not(.no-export)' }
                                        }, {
                                            text: '<i class="bi bi-file-earmark-spreadsheet"></i> CSV',
                                            extend: 'csv',
                                            exportOptions: { columns: ':visible:not(.no-export)' }
                                        }, {
                                            text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                                            extend: 'excel',
                                            exportOptions: { columns: ':visible:not(.no-export)' }
                                        }, {
                                            text: '<i class="bi bi-printer"></i> Imprimir',
                                            extend: 'print',
                                            exportOptions: { columns: ':visible:not(.no-export)' }
                                        }]
                                    },
                                    {
                                        extend: 'colvis',
                                        text: '<i class="bi bi-eye"></i> Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
