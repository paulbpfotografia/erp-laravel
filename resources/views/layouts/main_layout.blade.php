<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        {{-- Carga de estilos y scripts con Vite --}}
        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])

         <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Iconos de Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

        {{-- SweetAlert2 (CDN) --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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





<script>
    const Toast = Swal.mixin({
    toast: true,
    position: "center",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    customClass: {
                popup: "colored-toast",
            }
    });

</script>


@if(session('message'))
    <script>
        Toast.fire({
            icon: {!! json_encode(session('icono', 'success')) !!},
            title: {!! json_encode(session('message')) !!}
        });
    </script>
@endif



</body>
</html>
