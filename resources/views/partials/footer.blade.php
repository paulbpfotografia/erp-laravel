<footer class="footer py-4 bg-dark text-light border-top">
    <div class="container">
        <div class="row gy-4 align-items-start">

            {{-- 1) Logo y nombre --}}
            <div class="col-lg-4 col-md-6 text-center text-md-start">
                <a href="{{ route('home') }}" class="d-inline-flex align-items-center text-decoration-none text-light">
                    <img src="{{ asset('images/logo3.png') }}" alt="{{ config('app.name') }}" height="50">
                </a>
                <p class="small mb-0">{{ config('app.tagline', 'Solución integral para tu empresa') }}</p>
            </div>

            {{-- 2) Accesos rápidos
            <div class="col-lg-2 col-md-6 text-center">
                <h6 class="text-uppercase mb-2">Accesos rápidos</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('pedidos.index') }}" class="text-light text-decoration-none">Pedidos</a></li>
                    <li><a href="{{ route('productos.index') }}" class="text-light text-decoration-none">Productos</a></li>
                    <li><a href="{{ route('informes.index') }}" class="text-light text-decoration-none">Informes</a></li>
                </ul>
            </div> --}}

            {{-- 3) Suscripción al boletín
      <div class="col-lg-3 col-md-6 text-center">
        <h6 class="text-uppercase mb-2">Mantente informado</h6>
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex justify-content-center">
            @csrf
            <input type="email" name="email" class="form-control form-control-sm me-2" style="max-width: 180px;" placeholder="Tu correo" required>
            <button class="btn btn-sm btn-primary">OK</button>
            </form>
            <p class="small mt-2">Recibe novedades y mejoras directamente en tu bandeja.</p>
        </div> --}}

        {{-- 4) Mapa de ubicación --}}
        <div class="col-lg-4 col-md-6 text-center text-md-start position-relative" style="max-width: 100%;">
            <h6 class="text-uppercase mb-2">Nuestra oficina</h6>
            <a href="https://www.google.com/maps/place/30510+Yecla,+Murcia,+Espa%C3%B1a/@38.6111959,-1.166448,13z/data=!4m15!1m8!3m7!1s0xc42e3783261bc8b:0xa6ec2c940768a3ec!2zRXNwYcOxYQ!3b1!8m2!3d40.463667!4d-3.74922!16zL20vMDZta2o!3m5!1s0xd63fe8abfbd68ad:0x8dd1398801ea17c!8m2!3d38.6124929!4d-1.1111083!16zL20vMDc0cDVz?hl=es&entry=ttu&g_ep=EgoyMDI1MDUwNS4wIKXMDSoASAFQAw%3D%3D"
                target="_blank"
                class="stretched-link"
                style="z-index: 2;"></a>
            <iframe
                src="https://www.google.com/maps/embed?pb=TU_EMBED_CODE"
                width="100%" height="120" style="border:0; pointer-events: none;"  allowfullscreen="" loading="lazy">
            </iframe>
            <div class="mt-2">
                <a
                    href="https://www.google.com/maps/place/30510+Yecla,+Murcia,+Espa%C3%B1a/@38.6111959,-1.166448,13z/data=!4m15!1m8!3m7!1s0xc42e3783261bc8b:0xa6ec2c940768a3ec!2zRXNwYcOxYQ!3b1!8m2!3d40.463667!4d-3.74922!16zL20vMDZta2o!3m5!1s0xd63fe8abfbd68ad:0x8dd1398801ea17c!8m2!3d38.6124929!4d-1.1111083!16zL20vMDc0cDVz?hl=es&entry=ttu&g_ep=EgoyMDI1MDUwNS4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank"
                    class="btn btn-sm btn-outline-light">
                    Ver en Google Maps
                </a>
            </div>
        </div>


        {{-- 5) Contacto, versión y toggle --}}
        <div class="col-lg-4 col-md-6 text-center text-md-end ">
            <h6 class="text-uppercase mb-2">Contáctanos</h6>
            <p class="small mb-1">
                <i class="bi bi-envelope"></i>
                <a href="mailto:soporte@jplerp.com" class="text-light text-decoration-none">soporte@jplerp.com</a>
            </p>
            <button id="theme-toggle" class="btn btn-sm btn-outline-light mb-2">
                <i id="theme-icon" class="bi"></i> <span id="theme-text"></span>
            </button>
            <p class="small mb-1">&copy; {{ date('Y') }} {{ config('app.name') }}. Versión {{ config('app.version', '1.0.0') }}</p>
            @auth
            <p class="small mb-0">Hola, <strong>{{ auth()->user()->name }}</strong></p>
            @endauth
        </div>

    </div>
    </div>

    {{-- Script toggle tema (externalízalo si prefieres) --}}
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
</footer>
