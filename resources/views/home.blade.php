@extends('layouts.main_layout')

@section('title', 'Home')

@section('content')

<div class="container py-4"> {{-- padding para separar del topbar --}}

    <h1 class="text-center display-5 mb-4">Bienvenido al ERP, {{ $user->name }}</h1>

    {{-- Instrucciones --}}
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark fw-bold">
                    INSTRUCCIONES PARA NUEVOS USUARIOS
                </div>
                <div class="card-body">
                    <p>dddddddddddddddddd</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Perfil --}}
    <div class="row justify-content-center mb-5">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow">
                <div class="card-header fw-bold">Mi perfil</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item fw-bold">
                            Nombre: <span class="fw-normal">{{ $user->name }}</span>
                        </li>
                        <li class="list-group-item fw-bold">
                            Correo electrónico: <span class="fw-normal">{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item fw-bold">
                            Registrado desde: <span class="fw-normal">{{ $user->created_at }}</span>
                        </li>
                        <li class="list-group-item fw-bold">
                            Rol: <span class="fw-normal">{{ $user->roles->first()->name ?? 'Sin rol asignado' }}</span>
                        </li>
                        <li class="list-group-item fw-bold">
                            Permisos:
                            <ul class="mt-2">
                                @foreach ($user->roles as $rol)
                                    @foreach ($rol->permissions as $permiso)
                                        <li>{{ $permiso->name }}</li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
