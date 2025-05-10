<footer class="footer bg-dark text-light border-top py-3">
    <div class="container">
        <div class="row align-items-center">

            {{-- 1) Nuestra oficina --}}
            <div class="col-auto me-5">
                <a href="https://www.google.com/maps/place/C.+de+S.+Ram%C3%B3n,+102,+30510+Yecla,+Murcia/@38.6134991,-1.1126882,16z/data=!3m1!4b1!4m15!1m8!3m7!1s0xc42e3783261bc8b:0xa6ec2c940768a3ec!2zRXNwYcOxYQ!3b1!8m2!3d40.463667!4d-3.74922!16zL20vMDZta2o!3m5!1s0xd63fdb1271bfa0b:0x23928de8a5110871!8m2!3d38.6134991!4d-1.110523!16s%2Fg%2F11csgv7l8g?hl=es&entry=ttu&g_ep=EgoyMDI1MDUwNS4wIKXMDSoASAFQAw%3D%3D" target="_blank"
                    class="btn btn-sm btn-outline-light ms-2">
                    Nuestra Oficina - Ver en Google Maps
                </a>
            </div>

            {{-- 2) Contáctanos --}}
            <div class="col-auto me-5">
                <span class="fw-semibold">CONTÁCTANOS</span>
                <i class="bi bi-envelope-fill ms-2"></i>
                <a href="mailto:soporte@jplerp.com"
                    class="text-light text-decoration-none ms-1">
                    soporte@jplerp.com
                </a>
            </div>

            

            {{-- 4) Versión (empujada al extremo derecho) --}}
            <div class="col-auto ms-auto">
                <small class="text-white">
                    &copy; {{ date('Y') }} {{ config('app.name') }} v{{ config('app.version','1.0.0') }}
                </small>
            </div>

        </div>
    </div>


</footer>
