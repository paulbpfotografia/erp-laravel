{{-- Barra superior (navbar) --}}
<nav id="barra-superior" class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid">
        {{-- Botón para colapsar menú lateral en móviles --}}
        <button class="btn btn-outline-dark d-md-none me-2" id="boton-movil-menu">
            <i class="bi bi-list"></i>
        </button>

        {{-- Nombre del sistema o logo --}}
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            {{ config('app.name', 'ERP') }}
        </a>

        {{-- Botón para colapsar navbar en móviles --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarOpciones"
            aria-controls="navbarOpciones" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Contenido colapsable: perfil de usuario --}}
        <div class="collapse navbar-collapse justify-content-end" id="navbarOpciones">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="menuUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded-circle me-2" width="35" height="35" alt="Avatar">
                        @else
                            <img src="{{ asset('storage/imagenes_usuarios/anonimo_imagen.jpg') }}" class="rounded-circle me-2" width="35" height="35" alt="Avatar">
                        @endif
                        <span class="fw-semibold">{{ Auth::user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="menuUsuario">
                        <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                        <li><a class="dropdown-item" href="#">Modo Oscuro</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Menú lateral --}}
<div id="menu-lateral" class="bg-dark text-white position-fixed vh-100" style="width: 250px; top: 60px; left: 0; z-index: 1040;">
    {{-- Encabezado del menú lateral --}}
    <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom">
        <span id="titulo-menu" class="fs-5 fw-bold">ERP</span>
        <button id="boton-toggle" class="btn btn-sm btn-outline-light d-none d-md-inline">
            <i class="bi bi-chevron-left"></i>
        </button>
    </div>

    {{-- Enlaces del menú --}}
    <div class="px-2 mt-4 d-flex flex-column gap-2">
        <a href="{{ route('home') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu" data-bs-toggle="tooltip" title="Inicio">
            <i class="bi bi-house-door-fill me-2"></i> <span class="texto-enlace">Inicio</span>
        </a>

        <a href="{{ route('productos.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu" data-bs-toggle="tooltip" title="Gestión de productos">
            <i class="bi bi-file-earmark-binary-fill me-2"></i> <span class="texto-enlace">Gestión de productos</span>
        </a>

        <a href="{{ route('pedidos.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu" data-bs-toggle="tooltip" title="Gestión de pedidos">
            <i class="bi bi-file-earmark-binary-fill me-2"></i> <span class="texto-enlace">Gestión de pedidos</span>
        </a>

        @role('Admin')
        <a href="{{ route('usuarios.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu" data-bs-toggle="tooltip" title="Gestión de usuarios">
            <i class="bi bi-people-fill me-2"></i> <span class="texto-enlace">Gestión de usuarios</span>
        </a>
        @endrole

        @role('Directivo|Admin')
        <a href="{{ route('informes.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu" data-bs-toggle="tooltip" title="Ver informe">
            <i class="bi bi-bar-chart-fill me-2"></i> <span class="texto-enlace">Ver informe</span>
        </a>
        @endrole
    </div>
</div>
