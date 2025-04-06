@extends('layouts.main_layout')

@section('title', 'Iniciar sesión')


{{-- Ocultamos la vista del nav. Esta condición está escrita en main_layout class="container py-5 mb-5"--}}
@php
    $hidenav = true;
@endphp


@section('content')
<div class="container d-flex flex-column justify-content-center" style="min-height: calc(100vh - 100px);">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Iniciar Sesión</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
