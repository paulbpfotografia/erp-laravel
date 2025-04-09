@extends('layouts.main_layout')

@section('title', 'Iniciar sesión')

@php
    $hidenav = true;
    $hidefooter = true; //Para que el footer no se muestre en la vista de login
@endphp

@section('content')
<!-- Estilos específicos para la vista de login -->
<style>
    /* Fondo elegante con degradado oscuro */
    .login-background {
        background: linear-gradient(135deg, #2c3e50, #000);
        min-height: 100vh;
    }

    /* Estilos para la tarjeta de login */
    .login-card {
        background: #1c1e21;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
    }
    .login-card .card-header {
        background: transparent;
        border-bottom: none;
    }
    .login-card .card-header h2 {
        color: #ffffff;
    }
    .login-card .card-body {
        padding: 2rem;
    }

    /* Estilos para los inputs y labels */
    .login-form label {
        color: #cccccc;
    }
    .login-form input {
        background: #2c2f33;
        border: 1px solid #444;
        color: #fff;
    }
    .login-form input:focus {
        border-color:rgb(76, 33, 232);
        box-shadow: none;
    }
    
    /* Botón con degradado y sombra */
    .btn-primary {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #5a0eb8, #1f64e7);
    }
</style>

<div class="login-background d-flex align-items-center">
    <div class="container-fluid p-0 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100 py-5">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card login-card text-white">
                    <div class="card-header text-center">
                        <h2 class="fw-bold mb-0">Iniciar sesión</h2>
                        <p class="mb-0" style="font-size: 1rem;">Ingresa tus credenciales para acceder</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                            </div>

                            {{-- Mostrar errores de validación --}}
                            @if ($errors->any())
                                <div class="alert alert-danger mt-3">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Mostrar mensaje de sesión cerrada --}}
                            @if (session('message'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Ingresar</button>
                        </form>
                        <div class="mt-4 text-center">
                            <p class="mb-0">¿No tienes una cuenta? <a href="#!" class="text-info fw-bold">Regístrate</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
