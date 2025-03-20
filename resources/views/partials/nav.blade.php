<div class="bg-dark text-white p-3" style="width: 250px; height: 100vh;">
    <h4 class="text-center mb-4">ERP</h4> <!-- Título centrado del sistema -->
    <ul class="nav flex-column"> <!-- Lista de navegación vertical -->

        <!-- Opción de menú para inicio -->
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-house-door-fill"></i> PANEL DE CONTROL
            </a>
        </li>

        <!-- Opción de menú para Productos -->
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('productos.index') }}">
                <i class="bi bi-box-fill"></i> PRODUCTO
            </a>
        </li>

        <!-- Opción de menú para Clientes -->
        <li class="nav-item">
            <a class="nav-link text-white disabled">
                <i class="bi bi-person-fill"></i> CLIENTE
            </a>
        </li>

        <!-- Opción de menú para Pedidos -->
        <li class="nav-item">
            <a class="nav-link text-white disabled">
                <i class="bi bi-file-earmark-binary-fill"></i> PEDIDO
            </a>
        </li>
     
     
        <!-- Opción de menú para crear usuarios-->
        @role('Admin')
      

        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('usuarios.index') }}">
                <i class="bi bi-people-fill"></i> GESTIÓN DE USUARIOS
            </a>
        </li>
        @endrole
    </ul>
</div>
