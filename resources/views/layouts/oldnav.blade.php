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
      :root {
    --sidebar-width: 280px;
    --sidebar-width-collapsed: 80px;
}

body {
    overflow-x: hidden;
}

.sidebar {
    width: var(--sidebar-width);
    height: 100vh;
    background: linear-gradient(135deg, #1a1c2e 0%, #16181f 100%);
    transition: all 0.3s ease;
}

.sidebar.collapsed {
    width: var(--sidebar-width-collapsed);
}

.sidebar-link {
    color: #a0a3bd;
    transition: all 0.2s ease;
    border-radius: 8px;
    margin: 4px 16px;
    white-space: nowrap;
    overflow: hidden;
}

.sidebar-link:hover {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
}

.sidebar-link.active {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.1);
}

.logo-text {
    background: linear-gradient(45deg, #6b8cff, #8b9fff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: opacity 0.3s ease;
}

.notification-badge {
    background: #ff6b6b;
    padding: 2px 6px;
    border-radius: 6px;
    font-size: 0.7rem;
}

.profile-section {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.main-content {
    margin-left: var(--sidebar-width);
    background-color: #f8f9fa;
    min-height: 100vh;
    padding: 20px;
    transition: all 0.3s ease;
}

.collapsed~.main-content {
    margin-left: var(--sidebar-width-collapsed);
}

.toggle-btn {
    position: absolute;
    right: -15px;
    top: 20px;
    background: white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    border: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    z-index: 100;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.collapsed .toggle-btn {
    transform: rotate(180deg);
}

.collapsed .hide-on-collapse {
    opacity: 0;
    visibility: hidden;
}

.collapsed .logo-text {
    opacity: 0;
}

.collapsed .profile-info {
    opacity: 0;
}

.collapsed .sidebar-link {
    text-align: center;
    padding: 1rem !important;
    margin: 4px 8px;
}

.collapsed .sidebar-link i {
    margin: 0 !important;
}

.profile-info {
    transition: opacity 0.2s ease;
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



<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');
    }
</script>

</body>
</html>


