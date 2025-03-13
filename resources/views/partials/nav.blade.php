<div class="bg-dark text-white p-3" style="width: 250px; height: 100vh;">
    <h4 class="text-center mb-4">ERP</h4> <!-- Título centrado del sistema -->
    <ul class="nav flex-column"> <!-- Lista de navegación vertical -->
        <!-- Opción de menú para inicio -->
        <li class="nav-item">
            <a class="nav-link text-white" href="#"> <!-- Enlace con ícono -->
                <i class="bi bi-house-door-fill"></i> PANEL DE CONTROL
            </a>
        </li>
        <!-- Opción de menú-->
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('producto.vista') }}">
                <i class="bi bi-box-fill"></i> PRODUCTO <!-- Icono + nombre -->
            </a>
        </li>
        <!-- Opción de menú-->
        <li class="nav-item">
            {{-- <a class="nav-link text-white" href="{{ route('modulos.clientes.cliente') }}"> --}}
                <i class="bi bi-person-fill"></i> CLIENTE <!-- Icono + nombre -->
            </a>
        </li>
        <!-- Opción de menú-->
        <li class="nav-item">
            {{-- <a class="nav-link text-white" href="{{ route('modulos.pedidos.pedido') }}"> --}}
                <i class="bi bi-file-earmark-binary-fill"></i> PEDIDO <!-- Icono + nombre -->
            </a>
        </li>
    </ul>
</div>
