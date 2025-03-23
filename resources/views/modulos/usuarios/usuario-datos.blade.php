@extends('layouts.main_layout')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-4 text-center" style="width: 35rem;">
        <div class="card-header bg-primary text-white p-2">
            <h4 class="mb-0">Detalles del Usuario</h4>
        </div>
        <div class="card-body p-3">

            <!-- Imagen del usuario con tamaño ajustado -->
            <div class="mb-3">
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}"
                        class="img-thumbnail rounded-circle shadow"
                        style="width: 120px; height: 120px; object-fit: cover;">
                @else
                {{-- <img src="{{ asset('storage/imagenes_usuarios/anonimo_imagen.jpg') }}"  --}}
                <img src="{{ asset('resources/default/imagenes_usuarios/anonimo_imagen.jpg') }}" 
                class="img-thumbnail rounded-circle shadow"
                style="width: 120px; height: 120px; object-fit: cover;">
                @endif
            </div>

            <!-- Datos del usuario -->
            <div class="text-center">
                <p><strong>ID:</strong> <span class="text-muted">{{ $user->id }}</span></p>
                <p><strong>Nombre:</strong> <span class="text-muted">{{ $user->name }}</span></p>
                <p><strong>Correo Electrónico:</strong> <span class="text-muted">{{ $user->email }}</span></p>
                <p><strong>Rol:</strong> <span class="text-muted">{{ $user->roles->first()->name }}</span></p>
                <p><strong>Estado:</strong>
                    <span class="{{ $user->active ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                        {{ $user->active ? 'Activo' : 'Inactivo' }}
                    </span>
                </p>
            </div>

            <!-- Botón para cambiar el estado del usuario -->
            <form action="{{ route('usuarios.changeActive', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                @can('activar usuarios')
                <button type="submit" class="btn btn-{{ $user->active ? 'danger' : 'success' }} btn-sm">
                    {{ $user->active ? 'Deshabilitar' : 'Habilitar' }}
                </button>
                @endcan
            </form>
        </div>
        <div class="card-footer text-center p-2">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>
@endsection
