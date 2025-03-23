@extends('layouts.main_layout')

@section('title', 'Editar Usuario')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Editar Usuario: {{ $user->name }}</h4>
        </div>
        <div class="card-body p-4">

            @include('partials.formulario', [
                'accion' => route('usuarios.update', $user->id),
                'metodo' => 'PUT',
                'campos' => [
                    ['nombre' => 'name', 'etiqueta' => 'Nombre', 'tipo' => 'text', 'requerido' => true],

                    ['nombre' => 'email', 'etiqueta' => 'Correo Electrónico', 'tipo' => 'email', 'requerido' => true],
                    [
                        'nombre' => 'rol',
                        'etiqueta' => 'Rol',
                        'tipo' => 'select',
                        'opciones' => $roles->pluck('name', 'name')->toArray(), //Extraemos los roles como array para el select, y asignamos lo mismo en clave y en valor
                        'requerido' => true
                    ]
                ],
                'valores' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'rol' => $user->roles->first()->name ?? ''
                ],
                'textoBoton' => 'Guardar Cambios'
            ])

        </div>
        <div class="card-footer text-end">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>
</div>

@endsection
