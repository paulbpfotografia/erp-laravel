<nav id="sidebar" class="sidebar">
    <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
        <!-- Logo -->
        <a href="{{ route('home') }}"
            class="d-inline-flex align-items-center text-decoration-none text-light mb-2">
            <img src="{{ asset('images/logo2.jpeg') }}"
                alt="{{ config('app.name') }}"
                class="rounded-circle"
                style="max-height: 120px;">
        </a>

    </div>

    {{-- 3) MENÚ PRINCIPAL --}}
    <ul class="sidebar-menu justify-content-center align-items-center px-3 py-4">
        {{-- Inicio --}}
        <li class="mb-2">
            <a href="{{ route('home') }}" class="d-flex align-items-center sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="bi bi-house-fill"></i>
                <span>Inicio</span>
            </a>
        </li>

        {{-- Gestión de productos (submenú) --}}
        @role('Directivo|Logistica|Administrativo|Admin|Gerente')
        <li class="mb-2">
            <a class="d-flex justify-content-between align-items-center sidebar-link {{ request()->routeIs('productos.*') ? 'active' : '' }}"
                data-bs-toggle="collapse" href="#submenuGestionProductos" role="button"
                aria-expanded="{{ request()->routeIs('productos.*') ? 'true' : 'false' }}"
                aria-controls="submenuGestionProductos">
                <div class="d-flex align-items-center">
                    <i class="bi bi-boxes"></i>
                    <span>Productos</span>
                </div>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse ps-4 {{ request()->routeIs('productos.*') ? 'show' : '' }}" id="submenuGestionProductos">
                @can('ver productos')
                <a href="{{ route('productos.index') }}" class="d-block sidebar-sublink {{ request()->routeIs('productos.index') ? 'active' : '' }}">
                    Productos
                </a>
                @endcan
                @can('crear productos')
                <a href="{{ route('productos.create') }}" class="d-block sidebar-sublink {{ request()->routeIs('productos.create') ? 'active' : '' }}">
                    Crear Producto
                </a>
                @endcan
            </div>
        </li>
        @endrole

        {{-- Gestión de clientes (submenú) --}}
        @role('Directivo|Logistica|Administrativo|Admin|Gerente')
        <li class="mb-2">
            <a class="d-flex justify-content-between align-items-center sidebar-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}"
                data-bs-toggle="collapse"
                href="#submenuClientes"
                role="button"
                aria-expanded="{{ request()->routeIs('clientes.*') ? 'true' : 'false' }}"
                aria-controls="submenuClientes">
                <div class="d-flex align-items-center">
                    <i class="bi bi-people-fill"></i>
                    <span>Clientes</span>
                </div>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse ps-4 {{ request()->routeIs('clientes.*') ? 'show' : '' }}" id="submenuClientes">
                @can('ver clientes')
                <a href="{{ route('clientes.index') }}"
                    class="d-block sidebar-sublink {{ request()->routeIs('clientes.index') ? 'active' : '' }}">
                    Todos los clientes
                </a>
                @endcan

                @can('crear clientes')
                <a href="{{ route('clientes.create') }}"
                    class="d-block sidebar-sublink {{ request()->routeIs('clientes.create') ? 'active' : '' }}">
                    Crear cliente
                </a>
                @endcan
            </div>
        </li>
        @endrole


        {{-- Gestión de pedidos (submenú) --}}
        @role('Directivo|Administrativo|Admin|Gerente')
        <li class="mb-2">
            <a class="d-flex justify-content-between align-items-center sidebar-link {{ request()->routeIs('pedidos.*') ? 'active' : '' }}"
                data-bs-toggle="collapse"
                href="#submenuPedidos"
                role="button"
                aria-expanded="{{ request()->routeIs('pedidos.*') ? 'true' : 'false' }}"
                aria-controls="submenuPedidos">
                <div class="d-flex align-items-center">
                    <i class="bi bi-cart3"></i>
                    <span>Pedidos</span>
                </div>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse ps-4 {{ request()->routeIs('pedidos.*') ? 'show' : '' }}" id="submenuPedidos">
                @can('ver pedidos')
                <a href="{{ route('pedidos.index') }}"
                    class="d-block sidebar-sublink {{ request()->routeIs('pedidos.index') ? 'active' : '' }}">
                    Todos los pedidos
                </a>
                @endcan

                @can('crear pedidos')
                <a href="{{ route('pedidos.create') }}"
                    class="d-block sidebar-sublink {{ request()->routeIs('pedidos.create') ? 'active' : '' }}">
                    Crear pedido
                </a>
                @endcan
            </div>
        </li>
        @endrole


        {{-- Gestión de usuarios --}}
        @role('Admin')
        <li class="mb-2">
            <a href="{{ route('usuarios.index') }}"
                class="d-flex align-items-center sidebar-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Usuarios</span>
            </a>
        </li>
        @endrole



        {{-- Informes --}}
        @role('Directivo|Admin')
        <li class="mb-2">
            <a href="{{ route('informes.index') }}"
                class="d-flex align-items-center sidebar-link {{ request()->routeIs('informes.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i>
                <span>Informes</span>
            </a>
        </li>
        @endrole


        {{-- Logística (submenú) --}}
        @role('Directivo|Logistica|Admin')
        <li class="mb-2">
            <a class="d-flex justify-content-between align-items-center sidebar-link {{ request()->routeIs('logistica.*') ? 'active' : '' }}"
                data-bs-toggle="collapse"
                href="#submenuLogistica"
                role="button"
                aria-expanded="{{ request()->routeIs('logistica.*') ? 'true' : 'false' }}"
                aria-controls="submenuLogistica">
                <div class="d-flex align-items-center">
                    <i class="bi bi-truck"></i>
                    <span>Logística</span>
                </div>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse ps-4 {{ request()->routeIs('logistica.*') ? 'show' : '' }}" id="submenuLogistica">
                {{-- Visión general --}}
                <a href="{{ route('logistica.index') }}"
                    class="d-block sidebar-sublink {{ request()->routeIs('logistica.index') ? 'active' : '' }}">
                    Visión general
                </a>

                {{-- Sub-submenú: Pedidos --}}
                <a class="d-flex justify-content-between align-items-center sidebar-sublink py-2 ps-3 {{ (request()->routeIs('logistica.pendientes') || request()->routeIs('logistica.enviados') || request()->routeIs('logistica.entregados') || request()->routeIs('logistica.preparados') ) ? 'active' : '' }}"
                    data-bs-toggle="collapse"
                    href="#submenuLogisticaPedidos"
                    role="button"
                    aria-expanded="{{ (request()->routeIs('logistica.*')) ? 'true' : 'false' }}"
                    aria-controls="submenuLogisticaPedidos">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i> <!-- aquí eliges el icono -->
                        <span>Pedidos</span>
                    </div>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="collapse ps-4 {{ (request()->routeIs('logistica.pendientes') || request()->routeIs('logistica.enviados') || request()->routeIs('logistica.entregados') || request()->routeIs('logistica.preparados') ) ? 'show' : '' }}" id="submenuLogisticaPedidos">
                    <a href="{{ route('logistica.index') }}" class="d-block sidebar-sublink py-2 {{ request()->routeIs('logistica.index') ? 'active' : '' }}">
                        Todos los pedidos
                    </a>
                    <a href="{{ route('logistica.pendientes') }}" class="d-block sidebar-sublink py-2 {{ request()->routeIs('logistica.pendientes') ? 'active' : '' }}">
                        Pendientes
                    </a>
                    <a href="{{ route('logistica.enviados') }}" class="d-block sidebar-sublink py-2 {{ request()->routeIs('logistica.enviados') ? 'active' : '' }}">
                        Enviados
                    </a>
                    <a href="{{ route('logistica.entregados') }}" class="d-block sidebar-sublink py-2 {{ request()->routeIs('logistica.entregados') ? 'active' : '' }}">
                        Entregados
                    </a>
                    <a href="{{ route('logistica.preparados') }}" class="d-block sidebar-sublink py-2 {{ request()->routeIs('logistica.preparados') ? 'active' : '' }}">
                        Preparados
                    </a>
                </div>

                {{-- Sub-submenú: Almacén --}}
                {{-- Sub-submenú: Almacén --}}
                <a class="d-flex justify-content-between align-items-center sidebar-sublink py-2 ps-3 {{ request()->routeIs('logistica.almacen.*') ? 'active' : '' }}"
                    data-bs-toggle="collapse"
                    href="#submenuAlmacen"
                    role="button"
                    aria-expanded="{{ request()->routeIs('logistica.almacen.*') ? 'true' : 'false' }}"
                    aria-controls="submenuAlmacen">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-building-fill-up"></i>
                        <span>Almacén</span>
                    </div>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="collapse ps-4 {{ request()->routeIs('logistica.almacen.*') ? 'show' : '' }}" id="submenuAlmacen">
                    <a href="{{ route('logistica.almacen.inventario') }}"
                        class="d-block sidebar-sublink py-2 {{ request()->routeIs('logistica.almacen.inventario') ? 'active' : '' }}">
                        Inventario
                    </a>
                    <a href="{{ route('logistica.almacen.entradas') }}"
                        class="d-block sidebar-sublink py-2 {{ request()->routeIs('logistica.almacen.entradas') ? 'active' : '' }}">
                        Entradas
                    </a>
                    <a href="{{ route('logistica.almacen.salidas') }}"
                        class="d-block sidebar-sublink py-2 {{ request()->routeIs('logistica.almacen.salidas') ? 'active' : '' }}">
                        Salidas
                    </a>
                </div>

            </div>



        </li>
        @endrole


        {{-- Paso 5: Perfil del usuario, siempre al final 
        @auth
        <div class="profile-section mt-auto justify-content-center align-items-center px-3 p-4">
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
                    <h6 class="text-white mb-0">
                        {{ Auth::user()->roles->first()->name ?? 'Sin rol asignado' }}
                    </h6>
                </div>
            </div>
        </div>
        @endauth --}}


        </div>
    </ul>

</nav>
