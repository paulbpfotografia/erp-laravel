<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Estilos con Vite --}}
    @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    {{-- SweetAlert2 (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Estilo del SideNav --}}
    <style>
        #menu-lateral {
            transition: width 0.3s ease;
            width: 250px;
            position: fixed;
            top: 60px;
            left: 0;
            height: calc(100vh - 60px);
            z-index: 1040;
            overflow-x: hidden;
            background-color: #343a40;
        }

        .menu-colapsado {
            width: 60px !important;
        }

        .menu-colapsado .texto-enlace,
        .menu-colapsado #titulo-menu {
            display: none !important;
        }

        .menu-colapsado .me-2 {
            margin-right: 0 !important;
        }

        #barra-superior {
            z-index: 1050;
            height: 60px;
        }

        #contenido-principal {
            transition: margin-left 0.3s;
            margin-top: 60px;
            margin-left: 250px;
        }

        @media (max-width: 768px) {
            #menu-lateral {
                width: 60px;
            }

            #contenido-principal {
                margin-left: 60px !important;
            }
        }
    </style>
</head>

<body>

    {{-- Barra superior --}}
    @if(!isset($hidenav))
        @include('partials.topbar')
    @endif

    <div class="d-flex" style="min-height: 100vh;">
        {{-- Menú lateral --}}
        @if(!isset($hidenav))
            @include('partials.nav')
        @endif

        {{-- Contenido principal --}}
        <div id="contenido-principal" class="flex-grow-1 p-3">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Toast personalizado --}}
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

    {{-- Mensajes de éxito --}}
    @if(session('message'))
    <script>
        Toast.fire({
            icon: {!! json_encode(session('icono', 'success')) !!},
            title: {!! json_encode(session('message')) !!}
        });
    </script>
    @endif

    {{-- Mensajes de error --}}
    @if(session('error'))
    <script>
        Toast.fire({
            icon: {!! json_encode(session('icono', 'error')) !!},
            title: {!! json_encode(session('error')) !!}
        });
    </script>
    @endif

    {{-- Eliminar registros --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".eliminarRegistroBtn").forEach(boton => {
                boton.addEventListener("click", function () {
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
                            let form = document.createElement("form");
                            form.method = "POST";
                            form.action = url;
                            form.style.display = "none";

                            let csrfInput = document.createElement("input");
                            csrfInput.type = "hidden";
                            csrfInput.name = "_token";
                            csrfInput.value = "{{ csrf_token() }}";

                            let methodInput = document.createElement("input");
                            methodInput.type = "hidden";
                            methodInput.name = "_method";
                            methodInput.value = "DELETE";

                            form.appendChild(csrfInput);
                            form.appendChild(methodInput);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });

            // Activar tooltips normales
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(el => {
                new bootstrap.Tooltip(el);
            });
        });
    </script>

    {{-- Script para dirigir el comportamiento del menu lateral --}}
    <script>
        const botonToggle = document.getElementById('boton-toggle');
        const botonMenuMovil = document.getElementById('boton-movil-menu');
        const menuLateral = document.getElementById('menu-lateral');
        const contenidoPrincipal = document.getElementById('contenido-principal');
        const iconoToggle = botonToggle?.querySelector('i');

        function ajustarContenido() {
            if (menuLateral.classList.contains('menu-colapsado')) {
                contenidoPrincipal.style.marginLeft = '60px';
                iconoToggle?.classList.replace('bi-chevron-left', 'bi-chevron-right');
                activarTooltipsEnIconos();
            } else {
                contenidoPrincipal.style.marginLeft = '250px';
                iconoToggle?.classList.replace('bi-chevron-right', 'bi-chevron-left');
                desactivarTooltipsEnIconos();
            }
        }

        function activarTooltipsEnIconos() {
            document.querySelectorAll('#menu-lateral .enlace-menu').forEach(enlace => {
                let texto = enlace.querySelector('.texto-enlace')?.textContent?.trim();
                if (texto) {
                    enlace.setAttribute('data-bs-toggle', 'tooltip');
                    enlace.setAttribute('data-bs-placement', 'right');
                    enlace.setAttribute('title', texto);
                }
            });
            const tooltipTriggerList = document.querySelectorAll('#menu-lateral [data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(el => {
                new bootstrap.Tooltip(el);
            });
        }

        function desactivarTooltipsEnIconos() {
            document.querySelectorAll('#menu-lateral .enlace-menu').forEach(enlace => {
                enlace.removeAttribute('data-bs-toggle');
                enlace.removeAttribute('data-bs-placement');
                enlace.removeAttribute('title');
                bootstrap.Tooltip.getInstance(enlace)?.dispose();
            });
        }

        // Toggle con botón en escritorio
        if (botonToggle) {
            botonToggle.addEventListener('click', () => {
                menuLateral.classList.toggle('menu-colapsado');
                ajustarContenido();
            });
        }

        // Toggle con botón en móvil
        if (botonMenuMovil) {
            botonMenuMovil.addEventListener('click', () => {
                menuLateral.classList.toggle('menu-colapsado');
                ajustarContenido();
            });
        }

        // Aplicar colapsado automático según tamaño de pantalla
        function aplicarColapsadoPorPantalla() {
            if (window.innerWidth < 768) {
                menuLateral.classList.add('menu-colapsado');
            } else {
                menuLateral.classList.remove('menu-colapsado');
            }
            ajustarContenido();
        }

        document.addEventListener('DOMContentLoaded', aplicarColapsadoPorPantalla);
        window.addEventListener('resize', aplicarColapsadoPorPantalla);
    </script>

</body>
</html>
