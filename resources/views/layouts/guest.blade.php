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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('includes.navbar')
    @if (Route::current()->uri() == '/')
    <div class="banner">
        <div class="filter-banner-div">
            <img src="img/banner.jpg" alt="Banner" class="banner-image">
        </div>
        <div class="banner-text">
            <h1>Descubre nuestros sabores</h1>
            <p>Preparamos los mejores postres de Uruguay. Ven y disfruta de una experiencia inolvidable.</p>
            <a class="text-decoration-none" href="/#products-section">
            <button class="details-button">Ver mas</button>
        </a>
        </div>
    </div>
    @endif
    <main class="{{Route::current()->uri() == 'productos/{id}' || Route::current()->uri() == '/' ? '' : 'container'}}">
        {{ $slot }}
    </main>
    @include('includes.footer')
</body>

</html>