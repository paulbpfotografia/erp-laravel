@extends('layouts.main_layout')

@section('title', 'Iniciar sesión')


{{-- Ocultamos la vista del nav. Esta condición está escrita en main_layout --}}
@php
    $hidenav = true;
@endphp

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Iniciar sesión') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" class="form-control" name="email" required>
                                    {{-- MENSAJE DE ERROR EN EL LOGIN. Los capturamos todos --}}
                                    @if ($errors->any())
                                    <br>
                                    <div class="alert alert-danger text-center">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }} <br>
                                        @endforeach
                                    </div>
                                @endif
                                
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    </form>
                </div>
                
                {{-- Mensaje de Sesión cerrada. --}}
                    @if (session('message')) 

                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                        
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
