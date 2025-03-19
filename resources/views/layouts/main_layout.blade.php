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



{{-- Scripts --}}



{{-- Script para las alertas con mensajes --}}
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

   <!-- Condicional para mostrar alertas mensajes -->
   @if(session('message'))
   <script>
       Toast.fire({
           icon: {!! json_encode(session('icono', 'success')) !!},
           title: {!! json_encode(session('message')) !!}
       });
   </script>
@endif

   <!-- Condicional para mostrar alertas errores -->
@if(session('error'))
<script>
    Toast.fire({
        icon: {!! json_encode(session('icono', 'error')) !!},
        title: {!! json_encode(session('error')) !!}
    });
</script>
@endif



{{-- Script para alertas de confirmación de borrado. Recoge los datos cuando le das al botón eliminar --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".eliminarRegistroBtn").forEach(boton => {
            boton.addEventListener("click", function() {
                let registroId = this.getAttribute("data-id");
                let url = this.getAttribute("data-url"); 
                let registro = this.getAttribute("data-entidad"); 
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: `Vas a eliminar este ${registro}. No podrás revertir esto.`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "green",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Crearemos un formulario dinámico para enviar el DELETE con la URL que capturamos en el botón
                        let form = document.createElement("form");
                        form.method = "POST";
                        form.action = url;
                        form.style.display = "none";

                        // Agregamos el token
                        let csrfInput = document.createElement("input");
                        csrfInput.type = "hidden";
                        csrfInput.name = "_token";
                        csrfInput.value = "{{ csrf_token() }}";

                        // Agregamos el método DELETE
                        let methodInput = document.createElement("input");
                        methodInput.type = "hidden";
                        methodInput.name = "_method";
                        methodInput.value = "DELETE";

                        form.appendChild(csrfInput);
                        form.appendChild(methodInput);
                        document.body.appendChild(form);
                        form.submit(); // Enviamos el formulario automaticamente

                        Swal.fire({
                            title: "Eliminado!",
                            text: `El ${registro} ha sido eliminado correctamente.`,
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>





</body>
</html>
