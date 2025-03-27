<div id="menu-lateral" class="bg-dark text-white position-fixed d-flex flex-column justify-content-between vh-100"
    style="width: 250px; top: 0; left: 0; z-index: 1040;">

    {{-- Parte superior: navegación --}}
    <div>
        <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom">
            <span id="titulo-menu" class="fs-5 fw-bold">ERP</span>
            <button id="boton-toggle" class="btn btn-sm btn-outline-light d-none d-md-inline">
                <i class="bi bi-chevron-left"></i>
            </button>
        </div>

        <div class="px-2 mt-3 d-flex flex-column gap-2">
            <a href="{{ route('home') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu">
                <i class="bi bi-house-door-fill me-2"></i> <span class="texto-enlace">Inicio</span>
            </a>
            <a href="{{ route('productos.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu">
                <i class="bi bi-file-earmark-binary-fill me-2"></i> <span class="texto-enlace">Gestión de productos</span>
            </a>
            <a href="{{ route('pedidos.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu">
                <i class="bi bi-file-earmark-binary-fill me-2"></i> <span class="texto-enlace">Gestión de pedidos</span>
            </a>

            @role('Admin')
            <a href="{{ route('usuarios.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu">
                <i class="bi bi-people-fill me-2"></i> <span class="texto-enlace">Gestión de usuarios</span>
            </a>
            @endrole

            @role('Directivo|Admin')
            <a href="{{ route('informes.index') }}" class="d-flex align-items-center px-3 py-2 text-white text-decoration-none enlace-menu">
                <i class="bi bi-bar-chart-fill me-2"></i> <span class="texto-enlace">Ver informe</span>
            </a>
            @endrole
        </div>
    </div>

    {{-- Bloque de usuario con dropdown --}}
    <div class="dropdown px-3 mb-4">
        <button type="button" class="btn btn-danger dropdown-toggle w-100 d-flex align-items-center justify-content-start"
            data-bs-toggle="dropdown" aria-expanded="false" id="dropdownUser">

            {{-- Imagen redonda --}}
            @if(Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                    class="rounded-circle me-2"
                    style="width: 35px; height: 35px; object-fit: cover;"
                    >
            @else
                <img src="{{ asset('storage/imagenes_usuarios/anonimo_imagen.jpg') }}"
                    class="rounded-circle me-2"
                    style="width: 35px; height: 35px; object-fit: cover;"
                    >
            @endif

            {{-- Nombre del usuario --}}
            <span class="texto-enlace">{{ Auth::user()->name }}</span>
        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="#">Mi perfil</a></li>
            <li><a class="dropdown-item" href="#">Modo oscuro</a></li>
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
    </div>
</div>
