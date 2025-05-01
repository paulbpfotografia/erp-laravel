{{-- resources/views/layouts/nav.blade.php --}}
<nav id="sidebar"
    class="sidebar d-flex flex-column flex-shrink-0 position-fixed">

    {{-- Paso 1: Toggle persistente por click --}}
    <button class="toggle-btn" onclick="toggleSidebar()" aria-label="Colapsar menú">
        <i class="fas fa-chevron-left"></i>
    </button>

    {{-- Paso 2: Logo y título --}}
    <div class="p-2 text-center">
        <h4 class="logo-text fw-bold mb-0 text-white">ERP</h4>
        {{-- Este texto se oculta al colapsar --}}
        <p class="text-muted small hide-on-collapse">Dashboard</p>
    </div>

    {{-- Paso 3: Enlace de Salir (logout) --}}
    @auth
    <div class="px-2">
        <a href="{{ route('logout') }}"
            class="sidebar-link text-decoration-none p-3 d-flex align-items-center {{ request()->routeIs('logout') ? 'active' : '' }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-3"></i>
            <span class="hide-on-collapse">Salir</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    @endauth

    {{-- Paso 4: Contenedor de enlaces, crece y permite scroll --}}
    <div class="d-flex flex-column flex-grow-1 overflow-auto">

        {{-- Sección 1: Inicio --}}
        <ul class="nav flex-column list-unstyled mb-3">
            <li class="sidebar-section">
                <a href="{{ route('home') }}"
                    class="sidebar-link text-decoration-none d-flex align-items-center p-3 {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home me-3"></i>
                    <span class="hide-on-collapse">Inicio</span>
                </a>
            </li>
        </ul>


        {{-- Sección : Gestión de productos (con submenú) --}}
        @role('Directivo|Administrativo|Admin|Gerente')
        <ul class="nav flex-column list-unstyled mb-3">
            <li class="sidebar-section">
                {{-- Enlace padre colapsable --}}
                <a class="sidebar-link text-decoration-none d-flex justify-content-between align-items-center p-3 {{ request()->routeIs('productos.*') ? 'active' : '' }}"
                    data-bs-toggle="collapse"
                    href="#submenuGestionProductos"
                    role="button"
                    aria-expanded="{{ request()->routeIs('productos.*') ? 'true' : 'false' }}"
                    aria-controls="submenuGestionProductos">
                    <div>
                        
                        <i class="bi bi-boxes"></i>
                        <span class="hide-on-collapse">Gestión de productos</span>
                    </div>
                    <i class="fas fa-chevron-down hide-on-collapse"></i>
                </a>
                {{-- Submenú --}}
                <div class="collapse ps-4 {{ request()->routeIs('productos.*') ? 'show' : '' }}" id="submenuGestionProductos">
                    @can('ver productos')
                    <a href="{{ route('productos.index') }}"
                        class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('productos.index') ? 'active' : '' }}">
                        Productos
                    </a>
                    @endcan

                    @can('crear productos')
                    <a href="{{ route('productos.create') }}"
                        class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('productos.create') ? 'active' : '' }}">
                        Crear Producto
                    </a>
                    @endcan
                </div>
            </li>
        </ul>
        @endrole


        {{-- Sección : Gestión de clientes (con submenú) --}}
        @role('Directivo|Administrativo|Admin|Gerente')
        <ul class="nav flex-column list-unstyled mb-3">
            <li class="sidebar-section">

                {{-- Enlace padre colapsable --}}
                <a class="sidebar-link text-decoration-none d-flex justify-content-between align-items-center p-3 {{ request()->routeIs('clientes.*') ? 'active' : '' }}"
                    data-bs-toggle="collapse"
                    href="#submenuGestionClientes"
                    role="button"
                    aria-expanded="{{ request()->routeIs('clientes.*') ? 'true' : 'false' }}"
                    aria-controls="submenuGestionClientes">
                    <div>
                        <i class="fas fa-user-friends me-3"></i>
                        <span class="hide-on-collapse">Gestión de Clientes</span>
                    </div>
                    <i class="fas fa-chevron-down hide-on-collapse"></i>
                </a>
                {{-- Submenú --}}
                <div class="collapse ps-4 {{ request()->routeIs('clientes.*') ? 'show' : '' }}" id="submenuGestionClientes">
                    @can('ver clientes')
                    <a href="{{ route('clientes.index') }}"
                        class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('clientes.index') ? 'active' : '' }}">
                        Clientes
                    </a>
                    @endcan

                    @can('crear clientes')
                    <a href="{{ route('clientes.create') }}"
                        class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('clientes.create') ? 'active' : '' }}">
                        Crear Cliente
                    </a>
                    @endcan
                </div>
            </li>
        </ul>
        @endrole



        {{-- Sección 3: Gestión de pedidos (con submenú) --}}
        @role('Directivo|Administrativo|Admin|Gerente')
        <ul class="nav flex-column list-unstyled mb-3">
            <li class="sidebar-section">

                {{-- Enlace padre colapsable --}}
                <a class="sidebar-link text-decoration-none d-flex justify-content-between align-items-center p-3 {{ request()->routeIs('pedidos.*') ? 'active' : '' }}"
                    data-bs-toggle="collapse"
                    href="#submenuGestionPedidos"
                    role="button"
                    aria-expanded="{{ request()->routeIs('pedidos.*') ? 'true' : 'false' }}"
                    aria-controls="submenuGestionPedidos">
                    <div>
                        <i class="fas fa-box me-3"></i>
                        <span class="hide-on-collapse">Pedidos</span>
                    </div>
                    {{-- Siempre mostramos icono de flecha --}}
                    <i class="fas fa-chevron-down hide-on-collapse"></i>
                </a>
                {{-- Submenú --}}
                <div class="collapse ps-4 {{ request()->routeIs('pedidos.*') ? 'show' : '' }}" id="submenuGestionPedidos">
                    @can('ver pedidos')
                    <a href="{{ route('pedidos.index') }}"
                        class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('pedidos.index') ? 'active' : '' }}">
                        Todos los Pedidos
                    </a>
                    @endcan

                    @can('crear pedidos')
                    <a href="{{ route('pedidos.create') }}"
                        class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('pedidos.create') ? 'active' : '' }}">
                        Crear Pedido
                    </a>
                    @endcan
                </div>
            </li>
        </ul>
        @endrole

        {{-- Sección 4: Gestión de usuarios --}}
        @role('Admin')
        <ul class="nav flex-column list-unstyled mb-3">
            <li class="sidebar-section">
                <a href="{{ route('usuarios.index') }}"
                    class="sidebar-link text-decoration-none d-flex align-items-center p-3 {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                    <i class="fas fa-users me-3"></i>
                    <span class="hide-on-collapse">Gestión de usuarios</span>
                </a>
            </li>
        </ul>
        @endrole

        {{-- Sección 5: Informes --}}
        @role('Directivo|Admin')
        <ul class="nav flex-column list-unstyled mb-3">
            <li class="sidebar-section">
                <a href="{{ route('informes.index') }}"
                    class="sidebar-link text-decoration-none d-flex align-items-center p-3 {{ request()->routeIs('informes.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-3"></i>
                    <span class="hide-on-collapse">Ver informes</span>
                </a>
            </li>
        </ul>
        @endrole

        {{-- Sección 6: Almacén y Logística (anidado) --}}
        @role('Directivo|Logistica|Admin')
        <ul class="nav flex-column list-unstyled mb-3">
            <li class="sidebar-section">
                <div class="section-title hide-on-collapse px-3 text-uppercase small mb-2">
                    Almacén y Logística
                </div>
                {{-- Enlace padre --}}
                <a class="sidebar-link text-decoration-none d-flex justify-content-between align-items-center p-3 {{ request()->routeIs('logistica.*') ? 'active' : '' }}"
                    data-bs-toggle="collapse"
                    href="#submenuLogistica"
                    role="button"
                    aria-expanded="{{ request()->routeIs('logistica.*') ? 'true' : 'false' }}"
                    aria-controls="submenuLogistica">
                    <div>
                        <i class="fas fa-warehouse me-3"></i>
                        <span class="hide-on-collapse">Logística</span>
                    </div>
                    <i class="fas fa-chevron-down hide-on-collapse"></i>
                </a>
                {{-- Submenú general --}}
                <div class="collapse ps-4 {{ request()->routeIs('logistica.*') ? 'show' : '' }}" id="submenuLogistica">
                    {{-- Sub-submenú Pedidos --}}
                    <a class="sidebar-link d-flex justify-content-between align-items-center py-2 ps-3"
                        data-bs-toggle="collapse"
                        href="#submenuLogisticaPedidos"
                        role="button"
                        aria-expanded="{{ request()->routeIs('logistica.*') ? 'true' : 'false' }}"
                        aria-controls="submenuLogisticaPedidos">
                        <span>Pedidos</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="collapse ps-4 {{ request()->routeIs('logistica.*') ? 'show' : '' }}" id="submenuLogisticaPedidos">
                        <a href="{{ route('logistica.index') }}"
                            class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('logistica.index') ? 'active' : '' }}">
                            Todos los Pedidos
                        </a>
                        <a href="{{ route('logistica.pendientes') }}"
                            class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('logistica.pendientes') ? 'active' : '' }}">
                            Pendientes
                        </a>
                        <a href="{{ route('logistica.enviados') }}"
                            class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('logistica.enviados') ? 'active' : '' }}">
                            Enviados
                        </a>
                        <a href="{{ route('logistica.entregados') }}"
                            class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('logistica.entregados') ? 'active' : '' }}">
                            Entregados
                        </a>
                        <a href="{{ route('logistica.preparados') }}"
                            class="sidebar-link d-block text-decoration-none py-2 {{ request()->routeIs('logistica.preparados') ? 'active' : '' }}">
                            Preparados
                        </a>
                    </div>

                    {{-- Sub-submenú Almacén --}}
                    <a class="sidebar-link d-flex justify-content-between align-items-center py-2 ps-3"
                        data-bs-toggle="collapse"
                        href="#submenuAlmacen"
                        role="button"
                        aria-expanded="false"
                        aria-controls="submenuAlmacen">
                        <span>Almacén</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="collapse ps-4" id="submenuAlmacen">
                        <a href="#" class="sidebar-link d-block text-decoration-none py-2">Inventario</a>
                        <a href="#" class="sidebar-link d-block text-decoration-none py-2">Entradas</a>
                        <a href="#" class="sidebar-link d-block text-decoration-none py-2">Salidas</a>
                        <a href="#" class="sidebar-link d-block text-decoration-none py-2">Proveedores</a>
                    </div>
                </div>
            </li>
        </ul>
        @endrole

        {{-- Paso 5: Perfil del usuario, siempre al final --}}
        @auth
        <div class="profile-section hide-on-collapse mt-auto p-4">
            <div class="d-flex align-items-center">
                @if(Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                    class="rounded-circle"
                    style="height:60px; width:60px; object-fit:cover;">
                @else
                <img src="{{ asset('storage/imagenes_usuarios/anonimo_imagen.jpg') }}"
                    class="rounded-circle"
                    style="height:60px; width:60px; object-fit:cover;">
                @endif

                <div class="ms-3 profile-info">
                    <h6 class="text-white mb-0">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">
                        {{ Auth::user()->roles->first()->name ?? 'Sin rol asignado' }}
                    </small>
                </div>
            </div>
        </div>
        @endauth

    </div>
</nav>
