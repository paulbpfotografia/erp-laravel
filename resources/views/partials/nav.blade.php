<nav class="sidebar d-flex flex-column flex-shrink-0 position-fixed" id="sidebar">

    <!-- Botón de toggle -->
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fas fa-chevron-left"></i>
    </button>

    <div class="p-4 text-center">
        <h4 class="logo-text fw-bold mb-0 text-white">ERP</h4>
        <p class="text-muted small hide-on-collapse">Dashboard</p>
    </div>

    <div class="nav flex-column">
        <a href="{{ route('home') }}" class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fas fa-home me-3"></i>
            <span class="hide-on-collapse">Inicio</span>
        </a>

        <a href="{{ route('productos.index') }}" class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('productos.*') ? 'active' : '' }}">
            <i class="fas fa-cogs me-3"></i>
            <span class="hide-on-collapse">Gestión de productos</span>
        </a>

        <a href="{{ route('pedidos.index') }}" class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('pedidos.*') ? 'active' : '' }}">
            <i class="fas fa-box me-3"></i>
            <span class="hide-on-collapse">Gestión de pedidos</span>
        </a>

        @role('Admin')
        <a href="{{ route('usuarios.index') }}" class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
            <i class="fas fa-users me-3"></i>
            <span class="hide-on-collapse">Gestión de usuarios</span>
        </a>
        @endrole

        @role('Directivo|Admin')
        <a href="{{ route('informes.index') }}" class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('informes.*') ? 'active' : '' }}">
            <i class="fas fa-chart-line me-3"></i>
            <span class="hide-on-collapse">Ver informe</span>
        </a>
        @endrole
    </div>

    <!-- Perfil del usuario -->
    <div class="profile-section mt-auto p-4">
        <div class="d-flex align-items-center">
            {{-- Imagen del usuario --}}
            @if(Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded-circle" style="height: 60px; width: 60px; object-fit: cover;">
            @else
                <img src="{{ asset('storage/imagenes_usuarios/anonimo_imagen.jpg') }}" class="rounded-circle" style="height: 60px; width: 60px; object-fit: cover;">
            @endif

            {{-- Información del usuario --}}
            <div class="ms-3 profile-info">
                <h6 class="text-white mb-0">{{ Auth::user()->name }}</h6>
                <small class="text-muted">{{ Auth::user()->roles->first()->name ?? 'Sin rol asignado' }}</small>
            </div>
        </div>
    </div>



</nav>
