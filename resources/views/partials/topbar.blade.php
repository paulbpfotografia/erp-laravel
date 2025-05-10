<nav id="barra-superior" class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid">

        {{-- Botón hamburguesa que controla sidebar y contenido --}}
        <button id="sidebarToggle" class="sidebar-toggle btn btn-outline-light me-2" aria-label="Mostrar/Ocultar menú">
            <i class="bi bi-list"></i>
        </button>


        {{-- Menú de usuario (perfil, cerrar sesión, etc.) --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown ">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center px-3"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded-circle me-2" width="35" height="35">
                        @else
                        <img src="{{ asset('storage/imagenes_usuarios/anonimo_imagen.jpg') }}" class="rounded-circle me-2" width="35" height="35">
                        @endif
                        <span class="text-light">{{ Auth::user()->name }}</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end bg-topbar">
                        <li>
                            <a class="dropdown-item text-light" href="{{ route('home') }}">Mi perfil</a>
                        </li>

                        {{-- Ítem: Cerrar sesión --}}
                        <li>
                            <a class="dropdown-item text-light" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        

                        {{-- Ítem: Toggle modo oscuro --}}
                        <li class="px-3 py-2">
                            <button
                                id="theme-toggle"
                                class="btn btn-sm btn-outline-secondary w-100 d-flex align-items-center justify-content-center text-light">
                                <i id="theme-icon" class="bi me-2"></i>
                                <span id="theme-text">Modo oscuro</span>
                            </button>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>

    </div>

    {{-- Script toggle tema --}}
    <script>
        (function() {
            const btn = document.getElementById('theme-toggle');
            const icon = document.getElementById('theme-icon');
            const text = document.getElementById('theme-text');
            const root = document.documentElement;
            const key = 'jplerp-theme';
            const stored = localStorage.getItem(key);
            let current = stored || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

            function apply(t) {
                root.setAttribute('data-bs-theme', t);
                localStorage.setItem(key, t);
                if (t === 'dark') {
                    icon.className = 'bi bi-sun-fill';
                    text.textContent = 'Modo Claro';
                } else {
                    icon.className = 'bi bi-moon-fill';
                    text.textContent = 'Modo Oscuro';
                }
            }

            apply(current);
            btn.addEventListener('click', () => apply(current = current === 'dark' ? 'light' : 'dark'));
        })();
    </script>
</nav>