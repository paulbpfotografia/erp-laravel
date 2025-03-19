@extends('layouts.main_layout')

@section('title', 'Gestión Usuarios')

@section('content')

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <!-- Botón Registrar Usuario con margen para dar espacio -->
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
                                                <button type="button" class="btn btn-sm btn-danger eliminarRegistroBtn"
                                                    data-id="{{ $user->id }}"
                                                    data-url="{{ route('usuarios.destroy', $user->id) }}"
                                                    data-entidad="Usuario">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>

                                            
                                                <!-- Botón Editar -->
                                                <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                

                                                <!-- Botón Ver Usuario -->
                    
                                                <a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-sm btn-primary">
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
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->first()->name }}</td>

                                        <!-- Acciones -->
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                
                                                <!-- Botón Eliminar -->
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>

                                                <!-- Botón Editar -->
                                                <button type="button" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>

                                                <!-- Botón Ver Usuario -->
                                                <a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-sm btn-primary">
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
                <form method="POST" action="{{ route('usuarios.registrar.store') }}">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required>
                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirmación de Contraseña -->
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required>
                    </div>

                    <!-- Selección de Rol -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="" disabled selected>Seleccione un rol</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Botón de Registrar -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            Registrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>









@endsection
