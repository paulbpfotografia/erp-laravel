@extends('layouts.main_layout')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Detalles del Usuario</h3>
        </div>
        <div class="card-body p-4">
            <div class="mb-3">
                <label class="fw-bold">ID:</label>
                <p>{{ $user->id }}</p>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Nombre:</label>
                <p>{{ $user->name }}</p>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Correo Electrónico:</label>
                <p>{{ $user->email }}</p>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Rol:</label>
                <p>{{ $user->roles->first()->name }}</p>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Estado:</label>
                <p class="{{ $user->active ? 'text-success' : 'text-danger' }}">
                    {{ $user->active ? 'Activo' : 'Inactivo' }}
                </p>
            </div>

            <!-- Botón para cambiar el estado del usuario -->
            <form action="{{ route('usuarios.changeActive', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-{{ $user->active ? 'danger' : 'success' }}">
                    {{ $user->active ? 'Deshabilitar' : 'Habilitar' }}
                </button>
            </form>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
