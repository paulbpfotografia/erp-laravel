@extends('layouts.main_layout')

@section('title', 'Gestión Usuarios')

@section('content')

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <!-- Botón Registrar Usuario -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuarios">
                Registrar Usuario
            </button>
        </div>

        <div class="box-body">
            <div class="container mt-4">
                
                <!-- Usuarios Activos -->
                <h2 class="mb-3">Usuarios Activos</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center align-middle">
                        <thead class="thead-light">
                            <tr class="bg-primary text-white">
                                <th class="fw-bold">Nombre</th>
                                <th class="fw-bold">Email</th>
                                <th class="fw-bold">Rol</th>
                                <th class="fw-bold">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if($user->active)
                                    <tr>
                                      
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->first()->name }}</td>

                                        <!-- Acciones -->
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                
                                              <!-- Botón Eliminar -->
                                                    <button type="button"
                                                    class="btn btn-sm btn-danger"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Eliminar usuario">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    </button>

                                                    <!-- Botón Editar -->
                                                    <button type="button"
                                                    class="btn btn-sm btn-warning"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Editar usuario">
                                                    <i class="bi bi-pencil-fill"></i>
                                                    </button>

                                                    <!-- Botón Ver Usuario -->
                                                    <a href="{{ route('usuarios.show', $user->id) }}"
                                                    class="btn btn-sm btn-primary"
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
                </div> <!-- Fin de tabla -->

                <hr class="my-4">

                <!-- Usuarios Inactivos -->
                <h2 class="mb-3">Usuarios Inactivos</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center align-middle">
                        <thead class="thead-light">
                            <tr class="bg-secondary text-white">
                                <th class="fw-bold">Nombre</th>
                                <th class="fw-bold">Email</th>
                                <th class="fw-bold">Rol</th>
                                <th class="fw-bold">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if(!$user->active)
                                    <tr>
                                        <!-- Mostrar la imagen del usuario -->
                                     
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->first()->name }}</td>

                                        <!-- Acciones -->
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                
                                 <!-- Botón Eliminar -->
                                                        <button type="button"
                                                        class="btn btn-sm btn-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Eliminar usuario">
                                                        <i class="bi bi-trash3-fill"></i>
                                                        </button>

                                                        <!-- Botón Editar -->
                                                        <button type="button"
                                                        class="btn btn-sm btn-warning"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Editar usuario">
                                                        <i class="bi bi-pencil-fill"></i>
                                                        </button>

                                                        <!-- Botón Ver Usuario -->
                                                        <a href="{{ route('usuarios.show', $user->id) }}"
                                                        class="btn btn-sm btn-primary"
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
                </div> <!--FIN DE LA TABLA-->
            </div>
        </div>
    </div>
</section>



<!-- MODAL AGREGAR USUARIO -->
<div class="modal fade" id="modalAgregarUsuarios" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white rounded-top">
                <h4 class="modal-title" id="modalUsuariosAgregarLabel">Registro de Usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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
