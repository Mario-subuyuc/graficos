<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Gráficos</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- iconos de bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--para datatable-->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- jQuery -->
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    <!-- sweetalert2 alertas de pagina-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container">
        @yield('links')
    </div>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/admin') }}" class="nav-link">Sistemas Gráficos</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/admin') }}" class="brand-link">
                <img src="{{ url('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Sistemas Gráficos</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User imagen">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!--para ventas-->
                        <li class="nav-item">
                            <a href="#" class="nav-link active bg-teal">
                                <i class="nav-icon fas bi bi-shop"></i>
                                <p>
                                    Ventas
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/ventas/create') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Creación de venta</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/ventas') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de ventas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--para admin usuarios-->
                        <li class="nav-item">
                            <a href="#" class="nav-link active bg-indigo">
                                <i class="nav-icon fas bi bi-people"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/usuarios/create') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Creación de usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/usuarios') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--para usuarios en line-->
                        <li class="nav-item">
                            <a href="#" class="nav-link active bg-cyan">
                                <i class="nav-icon fas bi bi-wifi"></i>
                                <p>
                                    En linea
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/sesiones') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Usuarios en linea</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <br>
                        <!--boton para cerrar cession-->
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link" style="background-color: #a9200e"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p>Cerrar sesión</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!--Sweetalert-->
        @if (($message = Session::get('mensaje')) && ($icono = Session::get('icono')))
            <script>
                Swal.fire({
                    position: "top-center",
                    icon: "{{ $icono }}",
                    title: "{{ $message }}",
                    showConfirmButton: false,
                    timer: 4500
                });
            </script>
        @endif
        <!--Contenido dinamico-->
        <div class="content-wrapper">
            <br>
            <div class="container">
                @yield('content')
            </div>
        </div>
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                1990-21-1428
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2024-2025 <a href="https://youtu.be/BtLSaxRnIhc">Admin de
                    teconologias</a></strong> Todos los derechos reservados
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- dataTable -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
