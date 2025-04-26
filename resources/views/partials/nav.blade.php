<nav class="sidebar d-flex flex-column flex-shrink-0 position-fixed" id="sidebar">

    <!-- Botón de toggle -->
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fas fa-chevron-left"></i>
    </button>



    <div class="p-2 text-center">
        <h4 class="logo-text fw-bold mb-0 text-white">ERP</h4>
        <p class="text-muted small hide-on-collapse">Dashboard</p>

        <!-- Enlace de Salir -->
        @auth
        <a href="{{ route('logout') }}"
            class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('logout') ? 'active' : '' }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-3"></i>
            <span class="hide-on-collapse">Salir</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    @endauth

    <div class="d-flex flex-column flex-grow-1">
        <div class="nav flex-column">
            <a href="{{ route('home') }}" class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-home me-3"></i>
                <span class="hide-on-collapse">Inicio</span>
            </a>

            <a href="{{ route('productos.index') }}" class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                <i class="fas fa-cogs me-3"></i>
                <span class="hide-on-collapse">Gestión de productos</span>
            </a>


            @role('Directivo|Administrativo|Admin|Gerente')
            <div class="sidebar-item">

                 <!-- Menú principal: Gestión de pedidos -->
    <a class="sidebar-link text-decoration-none p-3 d-flex justify-content-between align-items-center {{ request()->routeIs('pedidos.*') ? 'active' : '' }}"
        data-bs-toggle="collapse"
        href="#submenuGestionPedidos"
        role="button"
        aria-expanded="{{ request()->routeIs('pedidos.*') ? 'true' : 'false' }}"
        aria-controls="submenuGestionPedidos">
         <div>
             <i class="fas fa-box me-3"></i>
             <span>Gestión de pedidos</span>
         </div>
         <i class="fas fa-chevron-down"></i>
     </a>

     <!-- Submenú: Pedidos -->
     <div class="collapse ps-3 {{ request()->routeIs('pedidos.*') ? 'show' : '' }}" id="submenuGestionPedidos">
         <a href="{{ route('pedidos.index') }}" class="sidebar-link text-decoration-none d-block py-2 ps-3 {{ request()->routeIs('pedidos.index') ? 'active' : '' }}">
             Todos los Pedidos
         </a>
         <a href="{{ route('pedidos.create') }}" class="sidebar-link text-decoration-none d-block py-2 ps-3 {{ request()->routeIs('pedidos.create') ? 'active' : '' }}">
             Crear Pedido
         </a>
     </div>

 </div>
            @endrole




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


            @role('Directivo|Logistica|Admin')
            <div class="sidebar-item">

                <!-- Menú principal: Almacén y Logística -->
                <a class="sidebar-link text-decoration-none p-3 d-flex justify-content-between align-items-center {{ request()->routeIs('logistica.*') ? 'active' : '' }}"
                   data-bs-toggle="collapse"
                   href="#submenuLogistica"
                   role="button"
                   aria-expanded="false"
                   aria-controls="submenuLogistica">
                    <div>
                        <i class="fas fa-warehouse me-3"></i>
                        <span>Almacén y Logística</span>
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </a>

                <!-- Submenú general -->
                <div class="collapse ps-3 {{ request()->routeIs('logistica.*') ? 'show' : '' }}" id="submenuLogistica">

                    <!-- Submenú: Pedidos -->
                    <a class="sidebar-link text-decoration-none d-flex justify-content-between align-items-center py-2 ps-3"
                       data-bs-toggle="collapse"
                       href="#submenuPedidos"
                       role="button"
                       aria-expanded="false"
                       aria-controls="submenuPedidos">
                        <span>Pedidos</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="collapse ps-3 {{ request()->routeIs('logistica.pendientes') || request()->routeIs('logistica.enviados') || request()->routeIs('logistica.entregados') || request()->routeIs('logistica.preparados') || request()->routeIs('logistica.index') ? 'show' : '' }}" id="submenuPedidos">
                        <a href="{{ route('logistica.index') }}" class="sidebar-link d-block py-2 text-decoration-none">
                            Todos los Pedidos
                        </a>
                        <a href="{{ route('logistica.pendientes') }}" class="sidebar-link d-block py-2 text-decoration-none">
                            Pendientes
                        </a>
                        <a href="{{ route('logistica.enviados') }}" class="sidebar-link d-block py-2 text-decoration-none">
                            Enviados
                        </a>
                        <a href="{{ route('logistica.entregados') }}" class="sidebar-link d-block py-2 text-decoration-none">
                            Entregados
                        </a>
                        <a href="{{ route('logistica.preparados') }}" class="sidebar-link d-block py-2 text-decoration-none">
                            Preparados
                        </a>
                    </div>

                    <!-- Submenú: Almacén -->
                    <a class="sidebar-link text-decoration-none d-flex justify-content-between align-items-center py-2 ps-3"
                       data-bs-toggle="collapse"
                       href="#submenuAlmacen"
                       role="button"
                       aria-expanded="false"
                       aria-controls="submenuAlmacen">
                        <span>Almacén</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="collapse ps-3" id="submenuAlmacen">
                        <a href="#" class="sidebar-link d-block py-2 text-decoration-none">
                            Inventario
                        </a>
                        <a href="#" class="sidebar-link d-block py-2 text-decoration-none">
                            Entradas
                        </a>
                        <a href="#" class="sidebar-link d-block py-2 text-decoration-none">
                            Salidas
                        </a>
                        <a href="#" class="sidebar-link d-block py-2 text-decoration-none">
                            Proveedores
                        </a>
                    </div>

                </div>
            </div>
            @endrole


        </div>

        <!-- Perfil del usuario -->
        @auth
        <div class="profile-section hide-on-collapse mt-auto p-4">
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
        @endauth
    </div>


</nav>
