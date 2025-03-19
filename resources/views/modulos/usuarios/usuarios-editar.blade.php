@extends('layouts.main_layout')

@section('title', 'Editar Usuario')

@section('content')


<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Editar Usuario: {{ $user->name }}</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
                @csrf
                @method('PUT')
            
                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre', $user->name) }}" required>
                </div>
            
                <!-- Correo Electrónico -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
            
                <!-- Selección de Rol -->
                <div class="mb-3">
                    <label for="rol" class="form-label">Selecciona un nuevo rol</label>
                    <select id="rol" name="rol" class="form-control">
                        <option value="Admin" {{ $rol == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Gerente" {{ $rol == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                        <option value="Empleado" {{ $rol == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                        <option value="Directivo" {{ $rol == 'Directivo' ? 'selected' : '' }}>Directivo</option>
                    </select>
                </div>
                

                <!-- Botón de Guardar Cambios -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Guardar Cambios</button>
                </div>
            </form>
            
        <div class="card-footer text-end">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>
</div>

@endsection


