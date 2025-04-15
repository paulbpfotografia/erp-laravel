@extends('layouts.main_layout')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">

            <!-- Cabecera del Usuario -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary-emphasis">
                    <i class="bi bi-person-fill me-2"></i> Usuario #{{ $user->id }}
                </h4>
                <span class="badge px-3 py-2 rounded-pill fs-6
                    {{ $user->active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                    <i class="bi bi-circle-fill me-1 small"></i>
                    {{ $user->active ? 'Activo' : 'Inactivo' }}
                </span>
            </div>

            <!-- Imagen de Perfil -->
            <div class="text-center mb-4">
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}"
                         class="img-fluid rounded-circle shadow-lg"
                         style="width: 120px; height: 120px; object-fit: cover;">
                @else
                    <img src="{{ asset('resources/default/imagenes_usuarios/anonimo_imagen.jpg') }}"
                         class="img-fluid rounded-circle shadow-lg"
                         style="width: 120px; height: 120px; object-fit: cover;">
                @endif
            </div>

            <!-- Datos del Usuario -->
            <div class="text-center mb-4">
                <p class="h5 fw-semibold">{{ $user->name }}</p>
                <p class="text-muted mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="text-muted mb-1"><strong>Rol:</strong>
                    @foreach($user->roles as $role)
                        {{ $role->name }}@if(!$loop->last), @endif
                    @endforeach
                </p>
                <p class="text-muted"><strong>Permisos:</strong>
                    @foreach($user->getAllPermissions() as $permission)
                        {{ $permission->name }}@if(!$loop->last), @endif
                    @endforeach
                </p>
            </div>

            <!-- Cambiar Estado del Usuario -->
            <div class="d-flex justify-content-center gap-4 mb-4">
                <form action="{{ route('usuarios.changeActive', $user->id) }}" method="POST" class="w-auto">
                    @csrf
                    @method('PATCH')
                    @can('activar usuarios')
                        <button type="submit" class="btn btn-{{ $user->active ? 'danger' : 'success' }} btn-sm w-auto">
                            {{ $user->active ? 'Deshabilitar' : 'Habilitar' }}
                        </button>
                    @endcan
                </form>
            </div>

            <!-- Botón Volver -->
            <div class="text-end mb-4">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left-circle me-1"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
