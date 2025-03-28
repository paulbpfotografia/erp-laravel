


@extends('layouts.main_layout')

@section('title', 'Iniciar sesión')

{{-- Ocultamos la vista del nav. Esta condición está escrita en main_layout --}}
@php
    $hidenav = true;
@endphp

@section('content')
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Iniciar sesión</h2>
                            <p class="text-white-50 mb-5">Introduce tu correo y contraseña para acceder</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                                    <label class="form-label" for="email">Correo Electrónico</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                                    <label class="form-label" for="password">Contraseña</label>
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

                                <button type="submit" class="btn btn-outline-light btn-lg px-5 mt-4">Ingresar</button>
                            </form>

                            {{-- Puedes quitar esto si no usas redes sociales --}}
                            <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                            </div>

                        </div>

                        <div>
                            <p class="mb-0">¿No tienes una cuenta? <a href="#!" class="text-white-50 fw-bold">Regístrate</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection










