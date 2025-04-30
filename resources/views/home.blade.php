@extends('layouts.main_layout')

@section('title', 'Inicio')

@section('content')
<div class="container py-5">

    {{-- Bienvenida tipo hero --}}
    <div class="bg-white rounded-4 shadow-sm p-5 mb-5 text-center border border-light-subtle">
        <h1 class="fw-bold mb-3" style="font-size: 2.5rem;">¡Bienvenido/a, {{ $user->name }}!</h1>
        <p class="text-muted mb-0" style="font-size: 1.1rem;">Este es tu panel de inicio. Usa el menú lateral para acceder a las funcionalidades disponibles según tu rol.</p>
    </div>

    {{-- Bloque de instrucciones --}}
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="border-start border-4 border-warning bg-white shadow-sm rounded-3 p-4">
                <h5 class="fw-bold mb-3 text-warning"><i class="bi bi-lightbulb-fill me-2"></i>Primeros pasos</h5>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Usa el menú lateral para navegar entre secciones.</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Las funciones visibles dependen de tu rol.</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Si algo no funciona, contacta con el administrador.</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Perfil de usuario --}}
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="bg-white shadow-sm rounded-3 p-4 border border-light-subtle">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div>
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

</div>
@endsection
