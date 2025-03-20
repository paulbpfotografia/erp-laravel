<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <!-- Logo o nombre de la aplicación -->
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <!-- Botón hamburguesa para móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <!-- Botón rojo con imagen y nombre del user -->
                <li class="nav-item dropdown">
                    <button type="button" class="btn btn-danger dropdown-toggle d-flex align-items-center px-3" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- Imagen de perfil -->
                        @if(Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded-circle me-2" width="35" height="35">
                        @else
                            <img src="{{ asset('storage/imagenes_usuarios/anonimo_imagen.jpg') }}" class="rounded-circle me-2" width="35" height="35">
                        @endif
                        <span>{{ Auth::user()->name }}</span>
                    </button>

                    <!-- Menú desplegable -->
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                        <li><a class="dropdown-item" href="#">Modo Oscruo</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
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
