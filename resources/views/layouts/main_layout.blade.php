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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        #menu-lateral {
            transition: width 0.3s ease;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
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

        #contenido-principal {
            transition: margin-left 0.3s;
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
    <div class="d-flex" style="min-height: 100vh;">

        @if(!isset($hidenav))
            @include('partials.nav')
        @endif

        @include('partials.topbar')

        <div id="contenido-principal" class="flex-grow-1 p-3">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

    @if(session('error'))
    <script>
        Toast.fire({
            icon: {!! json_encode(session('icono', 'error')) !!},
            title: {!! json_encode(session('error')) !!}
        });
    </script>
    @endif

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

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(el => {
                new bootstrap.Tooltip(el);
            });
        });

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

        if (botonToggle) {
            botonToggle.addEventListener('click', () => {
                menuLateral.classList.toggle('menu-colapsado');
                ajustarContenido();
            });
        }

        if (botonMenuMovil) {
            botonMenuMovil.addEventListener('click', () => {
                menuLateral.classList.toggle('menu-colapsado');
                ajustarContenido();
            });
        }

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
