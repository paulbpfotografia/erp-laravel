@extends('layouts.main_layout')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-semibold text-primary-emphasis">Gestión de Usuarios</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        @can('crear usuarios')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuarios">
            <i class="bi bi-plus-circle me-1"></i> Registrar Usuario
        </button>
        @endcan
    </div>

    <div class="table-responsive rounded shadow-sm border border-light-subtle">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-light text-uppercase small text-muted border-bottom border-2">
                <tr>
                    <th class="fw-semibold">Nombre</th>
                    <th class="fw-semibold">Email</th>
                    <th class="fw-semibold">Rol</th>
                    <th class="fw-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($users as $user)
                    @if($user->active)
                    <tr class="transition hover-bg-light">
                        <td class="text-secondary">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->first()->name }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @can('eliminar usuarios')
                                <button type="button"
                                        class="btn btn-sm btn-danger eliminarRegistroBtn"
                                        data-id="{{ $user->id }}"
                                        data-url="{{ route('usuarios.destroy', $user->id) }}"
                                        data-entidad="Usuario"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Eliminar usuario">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                                @endcan

                                @can('editar usuarios')
                                <a href="{{ route('usuarios.edit', $user) }}"
                                   class="btn btn-sm btn-warning"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Editar usuario">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                @endcan

                                @can('ver usuarios')
                                <a href="{{ route('usuarios.show', $user) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Ver detalles del usuario">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <hr class="my-4">

    <!-- Inactivos -->
    <h3 class="mb-3 text-muted">Usuarios Inactivos</h3>
    <div class="table-responsive rounded shadow-sm border border-light-subtle">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-light text-uppercase small text-muted border-bottom border-2">
                <tr>
                    <th class="fw-semibold">Nombre</th>
                    <th class="fw-semibold">Email</th>
                    <th class="fw-semibold">Rol</th>
                    <th class="fw-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($users as $user)
                    @if(!$user->active)
                    <tr class="transition hover-bg-light">
                        <td class="text-secondary">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->first()->name }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Eliminar usuario">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>

                                <button type="button"
                                        class="btn btn-sm btn-warning"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Editar usuario">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                <a href="{{ route('usuarios.show', $user->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Ver detalles del usuario">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<!-- Modal de agregar usuario -->
<div class="modal fade" id="modalAgregarUsuarios" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white rounded-top">
                <h4 class="modal-title" id="modalUsuariosAgregarLabel">Registro de Usuario</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                @include('partials.formulario', [
                    'accion' => route('usuarios.registrar.store'),
                    'metodo' => 'POST',
                    'campos' => [
                        ['nombre' => 'name', 'etiqueta' => 'Nombre', 'tipo' => 'text', 'requerido' => true],
                        ['nombre' => 'email', 'etiqueta' => 'Correo Electrónico', 'tipo' => 'email', 'requerido' => true],
                        ['nombre' => 'password', 'etiqueta' => 'Contraseña', 'tipo' => 'password', 'requerido' => true],
                        ['nombre' => 'password_confirmation', 'etiqueta' => 'Confirmar Contraseña', 'tipo' => 'password', 'requerido' => true],
                        ['nombre' => 'image', 'etiqueta' => 'Foto de Perfil', 'tipo' => 'file', 'requerido' => false],
                        ['nombre' => 'role', 'etiqueta' => 'Rol', 'tipo' => 'select', 'opciones' => $roles->pluck('name', 'name')->toArray()]
                    ],
                    'valores' => [],
                    'textoBoton' => 'Registrar Usuario'
                ])
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

@endsection
