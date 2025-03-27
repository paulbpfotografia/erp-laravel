<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Estilos con Vite --}}
    @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="d-flex">
    {{-- Sidebar --}}
    @include('partials.nav')

    {{-- Contenido principal --}}
    <div class="main-content">
        @yield('content')
    </div>
</div>

{{-- JavaScript con Vite --}}
@vite(['resources/js/sidebar.js'])

</body>
</html>
