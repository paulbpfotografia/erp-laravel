<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- Estilos y scripts procesados por Vite --}}
    @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])

    <!-- Bootstrap Icons y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="{{ isset($hidenav) && $hidenav ? 'no-sidebar' : '' }} d-flex flex-column min-vh-100">

    {{-- Contenido principal con o sin sidebar --}}
    <main class="flex-fill d-flex">
        @if (empty($hidenav))
            @include('partials.nav')
        @endif

        <div class="main-content flex-fill">
            @yield('content')
        </div>
    </main>

    @include('partials.footer')

    {{-- Mensajes flash con SweetAlert o Toast --}}
    @if(session('message') || session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toast.fire({
                    icon: @json(session('icono', session('error') ? 'error' : 'success')),
                    title: @json(session('message') ?? session('error'))
                });
            });
        </script>
    @endif

</body>
</html>
