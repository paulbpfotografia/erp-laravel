@extends('layouts.main_layout')

@section('title', 'Inicio')

@section('content')
<div class="container py-5">

    {{-- Bienvenida tipo hero --}}
    <section class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-5 text-center border border-light-subtle">
        <h1 class="fw-bold mb-3 fs-2 fs-md-1">¡Bienvenido/a, {{ $user->name }}!</h1>
        <p class="text-muted mb-0 fs-5">Accede a tus funcionalidades desde el menú lateral según tu rol.</p>
    </section>

    {{-- Instrucciones --}}
    <section class="row justify-content-center mb-4">
        <div class="col-12 col-lg-10">
            <div class="card border-start border-4 border-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-warning fw-bold mb-3"><i class="bi bi-lightbulb-fill me-2"></i>Primeros pasos</h5>
                    <ul class="list-unstyled text-muted mb-0">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Usa el menú lateral para navegar entre secciones.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Las funciones visibles dependen de tu rol.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Si algo no funciona, contacta con el administrador.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Perfil de usuario --}}
    <section class="row justify-content-center mb-5">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row align-items-center mb-4 gap-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 2rem;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="text-center text-md-start">
                            <h5 class="mb-1 fw-bold">{{ $user->name }}</h5>
                            <span class="text-muted">{{ $user->email }}</span>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="bg-light rounded-2 p-3 h-100">
                                <small class="text-muted">Fecha de registro</small>
                                <div class="fw-semibold">{{ $user->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-light rounded-2 p-3 h-100">
                                <small class="text-muted">Rol asignado</small>
                                <div class="fw-semibold">{{ $user->roles->first()->name ?? 'Sin rol asignado' }}</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bg-light rounded-2 p-3">
                                <small class="text-muted">Permisos</small>
                                <ul class="mb-0 ps-3 mt-2">
                                    @forelse ($user->roles as $rol)
                                        @foreach ($rol->permissions as $permiso)
                                            <li>{{ $permiso->name }}</li>
                                        @endforeach
                                    @empty
                                        <li class="text-muted">Sin permisos asignados.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- To-do list --}}
    <section class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-list-check me-2"></i>Mis tareas personales</h5>

                    {{-- Nueva tarea --}}
                    <form method="POST" action="{{ route('todos.store') }}" class="mb-4">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="task" class="form-control" placeholder="Escribe una nueva tarea..." required>
                            <button class="btn btn-primary" type="submit"><i class="bi bi-plus-circle me-1"></i> Añadir</button>
                        </div>
                    </form>

                    {{-- Lista de tareas --}}
                    @if ($user->todos->count())
                        <ul class="list-group">
                            @foreach ($user->todos as $todo)
                                <li class="list-group-item d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="d-flex align-items-center flex-grow-1 me-2">
                                        <form method="POST" action="{{ route('todos.toggle', $todo->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm {{ $todo->completed ? 'btn-success' : 'btn-outline-secondary' }} me-3" title="Marcar como completada">
                                                <i class="bi {{ $todo->completed ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                                            </button>
                                        </form>

                                        <span class="fs-6 {{ $todo->completed ? 'text-decoration-line-through text-muted' : '' }}">
                                            {{ $todo->task }}
                                        </span>
                                    </div>

                                    <form method="POST" action="{{ route('todos.destroy', $todo->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-light text-muted mb-0">No tienes tareas pendientes.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
