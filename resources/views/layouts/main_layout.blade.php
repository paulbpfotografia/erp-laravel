<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>


      <!-- Barra superior -->
      @if(!isset($hidenav))
      @include('partials.topbar')
          @endif


    <div class="d-flex" style="min-height: 100vh;">
        <!-- Menú lateral -->
        {{-- Con esta condición decimos que si hidenav es true, se oculte la barra lateral. Lo incluimos en Login y register --}}
        @if(!isset($hidenav))
    @include('partials.nav')  <!-- Aquí se incluye el menú lateral -->
        @endif



        <!-- Contenido principal -->
        <div class="flex-grow-1 p-3">
            @yield('content') <!-- Aquí se inyecta el contenido de cada vista -->
        </div>
    </div>
</body>
</html>
