<nav id="barra-superior" class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid">

        {{-- Botón para colapsar menú lateral en pantallas pequeñas --}}
        <button class="btn btn-outline-dark d-md-none me-2" id="boton-movil-menu" type="button">
            <i class="bi bi-list"></i>
        </button>

        {{-- Logo o nombre de la aplicación --}}
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        {{-- Botón hamburguesa para el menú superior responsive --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menú de usuario (perfil, cerrar sesión, etc.) --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <button type="button" class="btn btn-danger dropdown-toggle d-flex align-items-center px-3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded-circle me-2" width="35" height="35">
                        @else
                            <img src="{{ asset('storage/imagenes_usuarios/anonimo_imagen.jpg') }}" class="rounded-circle me-2" width="35" height="35">
                        @endif
                        <span>{{ Auth::user()->name }}</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                        <li><a class="dropdown-item" href="#">Modo Oscuro</a></li>
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
