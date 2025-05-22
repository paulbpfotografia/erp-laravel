<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,body {
            overscroll-behavior: none;
        }

        body {
            background: linear-gradient(to bottom right,rgb(34, 49, 82),rgb(73, 104, 149),rgb(62, 85, 123));
            min-height: 100vh;
            background-attachment: fixed;
            background-size: cover;
        }
        .card-login {
            backdrop-filter: blur(10px);
            background: rgba(0, 0, 0, 0.6);
            border: none;
            border-radius: 1rem;
        }
        .btn-gradient {
            background: linear-gradient(45deg, #8e44ad, #3498db);
            color: #fff;
            border: none;
        }
        .btn-gradient:hover {
            background: linear-gradient(45deg, #732d91, #2980b9);
        }
        .form-control, .form-control:focus {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border: none;
        }
        .form-label {
            color: #ddd;
        }
        .link-light:hover {
            color: #fff;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="card card-login p-4 shadow-lg" style="width: 100%; max-width: 400px;">
        <h3 class="text-center text-white mb-3">Iniciar Sesión</h3>
        <p class="text-center text-light mb-4">Ingresa tus credenciales para acceder</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-gradient py-2">Ingresar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
