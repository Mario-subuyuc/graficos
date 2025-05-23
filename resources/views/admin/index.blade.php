@extends('layouts.admin')
@section('links')
    <!-- ChartJS -->
    <script src="{{ url('plugins/chart.js/Chart.min.js') }}"></script>
@endsection
@section('content')
    <div class="row d-flex justify-content-between align-items-center">
        <h1>Bienvenido : {{ Auth::user()->name }}</h1>
        <p>Conectado a la base de datos: {{ $conexion }}</p>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-4 col-4">
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{ $total_ventas }}</h3>
                    <p>Ventas</p>
                </div>
                <div class="icon">
                    <i class="ion fas bi bi-shop"></i>
                </div>
                <a href="{{ url('admin/ventas') }}" class="small-box-footer">Más Información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-4">
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{ $total_usuarios }}</h3>
                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion fas bi bi-people"></i>
                </div>
                <a href="{{ url('admin/usuarios') }}" class="small-box-footer">Más Información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-4">
            <div class="small-box bg-cyan">
                <div class="inner">
                    <h3>{{ $total_online }}</h3>
                    <p>En linea</p>
                </div>
                <div class="icon">
                    <i class="ion fas bi bi-wifi"></i>
                </div>
                <a href="{{ url('admin/sesiones') }}" class="small-box-footer">Más Información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Ventas del Día -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="bi bi-cash-coin"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ventas del Día</span>
                    <span class="info-box-number">Q{{ number_format($ventasHoy, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Producto Estrella -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="bi bi-star-fill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Producto Estrella</span>
                    <span class="info-box-number">{{ $productoEstrella ?? 'Ninguno' }}</span>
                </div>
            </div>
        </div>

        <!-- Promedio por Venta -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="bi bi-graph-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ingreso Promedio</span>
                    <span class="info-box-number">Q{{ number_format($promedioVenta, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Total Transacciones Hoy -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="bi bi-receipt-cutoff"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Transacciones Hoy</span>
                    <span class="info-box-number">{{ $transaccionesHoy }}</span>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gráficos de Control</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- AREA CHART -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Ventas Anules 2025/2024</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="areaChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- DONUT CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Venta Articulos 2025</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Compras 2025 clientes</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-md-6">

                        <!-- BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Productos Más Vendidos del Mes</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart1"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- PIE CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Total Ventas Vendedores</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- STACKED BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Metodos de Pago 2025</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="stackedBarChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col (RIGHT) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Page specific script -->
    <script>
        $(function() {
            ventas2024 = @json($totalVentas2024);
            ventas2025 = @json($totalVentas2025);
            const dataVentas2024 = [...Array(12)].map((_, i) => ventas2024[i + 1] || 0);
            const dataVentas2025 = [...Array(12)].map((_, i) => ventas2025[i + 1] || 0);
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
            var areaChartData = {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                    'Octubre', 'Noviembre', 'Diciembre'
                ],
                datasets: [{
                        label: 'Ventas 2024',
                        backgroundColor: 'rgba(92, 107, 192, 0.5)',
                        borderColor: 'rgba(92, 107, 192, 1)',
                        pointRadius: 4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: 'rgba(92, 107, 192, 1)',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7,
                        pointHoverBackgroundColor: '#5c6bc0',
                        pointHoverBorderColor: '#3b8bba',
                        pointHoverBorderWidth: 3,
                        data: dataVentas2024
                    },
                    {
                        label: 'Ventas 2025',
                        backgroundColor: 'rgba(0, 188, 212, 0.5)',
                        borderColor: 'rgba(0, 188, 212, 1)',
                        pointRadius: 5,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: 'rgba(0, 188, 212, 1)',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7,
                        pointHoverBackgroundColor: '#00bcd4',
                        pointHoverBorderColor: '#00bcd4',
                        pointHoverBorderWidth: 3,
                        data: dataVentas2025
                    },
                ]


            }
            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }]
                }
            }
            new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })
        })
    </script>

    <script>
        productos2025 = @json($ventasProducto2025);
        labels = Object.keys(productos2025);
        data = Object.values(productos2025);
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>

    <script>
        const ventasUsuario2025 = @json($ventasUsuario2025);
        const donutDataUsuarios = {
            labels: Object.keys(ventasUsuario2025),
            datasets: [{
                data: Object.values(ventasUsuario2025),
                backgroundColor: [
                    '#f56954', '#00a65a', '#f39c12', '#00c0ef',
                    '#3c8dbc', '#d2d6de', '#8e44ad', '#2ecc71',
                    '#e74c3c', '#3498db', '#1abc9c', '#9b59b6'
                ],
                borderWidth: 1
            }]
        };
        const pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'right',
                }
            }
        };
        const pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: donutDataUsuarios,
        });
    </script>

    <script>
        // Suponiendo que la variable barChartData se pasa desde el controlador
        var barChartCanvas = $('#barChart').get(0).getContext('2d');
        var barChartData = @json($barChartData);

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }

        };

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });
    </script>

    <script>
        $(document).ready(function() {
            // Datos para el gráfico de barras apiladas (métodos de pago)
            var stackedBarChartData = {!! json_encode($barChartDataMetodoPago) !!};

            // Configuración del gráfico de barras apiladas
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d');

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            };

            new Chart(stackedBarChartCanvas, {
                type: 'bar', // Tipo de gráfico (barras)
                data: stackedBarChartData, // Datos pasados desde PHP
                options: stackedBarChartOptions // Configuración
            });
        });
    </script>

    
@endsection
