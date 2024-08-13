<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Postre Chajá') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('index') }}"><i class="bi bi-house-door-fill"></i></a>
        <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">Dashboard</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><span
                class="navbar-toggler-icon"></span> </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group d-none">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="bi bi-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <div class="logueo">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-person"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
                <li><a class="dropdown-item" href="{{ route('perfil.edit') }}">Perfil</a></li>

                <li><a class="dropdown-item" href="#">Configuración</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            Salir
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav" class="layoutSidenav_nav">
            <nav class="sb-sidenav sb-sidenav-dark" id=" ">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Modelos</div>
                        <a class="nav-link" href="{{ route('productos.table') }}">
                            <div class="sb-nav-link-icon"></div>
                            Productos
                        </a>
                        <a class="nav-link" href="{{ route('categorias.index') }}">
                            <div class="sb-nav-link-icon"></div>
                            Categorías
                        </a>
                        <a class="nav-link" href="{{ route('secciones.index') }}">
                            <div class="sb-nav-link-icon"></div>
                            Secciones
                        </a>
                        <a class="nav-link" href="{{ route('clientes.index') }}">
                            <div class="sb-nav-link-icon"></div>
                            Clientes
                        </a>
                        <a class="nav-link" href="{{ route('discounts.index') }}">
                            <div class="sb-nav-link-icon"></div>
                            Descuentos
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
