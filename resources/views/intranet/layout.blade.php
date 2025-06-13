<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title') - Sistema Logístico Precio Uno</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('storage/imgsistema/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
    @vite([
        'resources/css/demo/styles.css',
        'resources/css/views/layout.css',
        'resources/js/intranet/usuarios.js',
        'resources/js/intranet/appproducto.js',
        'resources/js/intranet/appvehiculo.js',
        'resources/js/intranet/appconductores.js',
        'resources/js/intranet/appguiasremision.js',
        'resources/js/appglobal.js',
        'resources/js/applogin.js',
        'resources/js/bootstrap.js',
        'resources/js/demo/chart-area-demo.js',
        'resources/js/demo/chart-bar-demo.js',
        'resources/js/demo/datatables-simple-demo.js',
        'resources/js/demo/scripts.js',
    ])
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --primary-color: #c8102e;
            --primary-dark: #a10b25;
            --secondary-color: #f8f9fa;
            --accent-color: #007bff;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
            --border-radius: 0.5rem;
            --box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary-color) !important;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            margin: 0 0.25rem;
            transition: var(--transition);
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .navbar-nav .nav-link.active {
            background-color: var(--primary-color);
            color: white !important;
            box-shadow: var(--box-shadow);
        }

        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background-color: white;
            border-radius: 2px;
        }

        .main-content {
            min-height: calc(100vh - 80px);
            padding: 2rem 0;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .page-subtitle {
            opacity: 0.9;
            margin: 0;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .btn {
            border-radius: var(--border-radius);
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--dark-color);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #e9ecef;
        }

        .table tbody tr:hover {
            background-color: rgba(200, 16, 46, 0.05);
        }

        .badge {
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            border-radius: var(--border-radius);
        }

        .form-control, .form-select {
            border-radius: var(--border-radius);
            border: 1px solid #ced4da;
            padding: 0.75rem;
            transition: var(--transition);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(200, 16, 46, 0.25);
        }

        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: var(--primary-color);
        }

        .alert {
            border-radius: var(--border-radius);
            border: none;
            padding: 1rem 1.5rem;
        }

        .dropdown-menu {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 3rem;
            height: 3rem;
            border: 0.3rem solid rgba(255, 255, 255, 0.3);
            border-top: 0.3rem solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-card.success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .stats-card.warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stats-card.danger {
            background: linear-gradient(135deg, #fc466b 0%, #3f5efb 100%);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .action-buttons .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .navbar-nav {
                padding: 1rem 0;
            }
            
            .navbar-nav .nav-link {
                margin: 0.25rem 0;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark shadow-sm">
        <!-- Brand -->
        <a class="navbar-brand ps-3" href="{{ route('vistadashboard') }}">
            <i class="fas fa-truck me-2"></i>
            Sistema Logístico
        </a>

        <!-- Sidebar Toggle -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Menú principal horizontal -->
        <div class="navbar-nav me-auto ms-md-0">
            @if (session('usuariologeado')["data"][0]['idrol'] == 1)
                <a class="nav-link {{ request()->routeIs('vistadashboard') ? 'active' : '' }}" href="{{ route('vistadashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('vistausuarios') ? 'active' : '' }}" href="{{ route('vistausuarios') }}">
                    <i class="fa-solid fa-user me-2"></i>Usuarios
                </a>
                <a class="nav-link {{ request()->routeIs('vistaconductor') ? 'active' : '' }}" href="{{ route('vistaconductor') }}">
                    <i class="fa-solid fa-id-card me-2"></i>Conductores
                </a>
                <a class="nav-link {{ request()->routeIs('vistavehiculo') ? 'active' : '' }}" href="{{ route('vistavehiculo') }}">
                    <i class="fa-solid fa-truck me-2"></i>Vehículos
                </a>
                <a class="nav-link {{ request()->routeIs('vistaproducto') ? 'active' : '' }}" href="{{ route('vistaproducto') }}">
                    <i class="fa-solid fa-bag-shopping me-2"></i>Productos
                </a>
            @elseif (session('usuariologeado')["data"][0]['idrol'] == 2)
                <a class="nav-link {{ request()->routeIs('vistaguiasderemision') ? 'active' : '' }}" href="{{ route('vistaguiasderemision') }}">
                    <i class="fa-solid fa-table-list me-2"></i>Guías de Remisión
                </a>
            @elseif (session('usuariologeado')["data"][0]['idrol'] == 3)
                <a class="nav-link {{ request()->routeIs('vistadashboard') ? 'active' : '' }}" href="{{ route('vistadashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('vistausuarios') ? 'active' : '' }}" href="{{ route('vistausuarios') }}">
                    <i class="fa-solid fa-user me-2"></i>Usuarios
                </a>
                <a class="nav-link {{ request()->routeIs('vistaconductor') ? 'active' : '' }}" href="{{ route('vistaconductor') }}">
                    <i class="fa-solid fa-id-card me-2"></i>Conductores
                </a>
                <a class="nav-link {{ request()->routeIs('vistavehiculo') ? 'active' : '' }}" href="{{ route('vistavehiculo') }}">
                    <i class="fa-solid fa-truck me-2"></i>Vehículos
                </a>
                <a class="nav-link {{ request()->routeIs('vistaproducto') ? 'active' : '' }}" href="{{ route('vistaproducto') }}">
                    <i class="fa-solid fa-bag-shopping me-2"></i>Productos
                </a>
                <a class="nav-link {{ request()->routeIs('vistaguiasderemision') ? 'active' : '' }}" href="{{ route('vistaguiasderemision') }}">
                    <i class="fa-solid fa-table-list me-2"></i>Guías de Remisión
                </a>
            @endif
        </div>

        <!-- Menú de usuario -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle me-2">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><h6 class="dropdown-header">Mi Cuenta</h6></li>
                    <li><a class="dropdown-item" href="#!"><i class="fas fa-user-cog me-2"></i>Configuración</a></li>
                    <li><a class="dropdown-item" href="#!"><i class="fas fa-history me-2"></i>Actividad</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item text-danger" href="#!" id="btncerrarsesion"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <div class="container-fluid main-content">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vistadashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-title">@yield('title')</h1>
                        <p class="page-subtitle">@yield('subtitle', 'Gestión del sistema logístico')</p>
                    </div>
                    <div class="col-auto">
                        @yield('header-actions')
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    
    @livewireScripts
    @stack('scripts')
    @yield('scripts')

    <style>
        .avatar-circle {
            width: 32px;
            height: 32px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.875rem;
        }
    </style>
</body>
</html>