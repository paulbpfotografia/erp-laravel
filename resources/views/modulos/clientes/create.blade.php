{{-- resources/views/modulos/clientes/create.blade.php --}}
@extends('layouts.main_layout')

@section('title', 'Crear Cliente')

@section('content')
<div class="container mt-5">
    {{-- Panel blanco con padding, bordes redondeados y sombra --}}
    <div class="bg-white p-4 rounded shadow-sm border border-light-subtle">

        {{-- Paso 1: Título con icono y botón de volver --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary-emphasis fw-semibold mb-0">
                <i class="bi bi-person-plus me-2"></i> Registro de Cliente
            </h4>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Paso 2: Formulario de creación --}}
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            {{-- Paso 2.1: Grupo de campos en fila responsive --}}
            <div class="row g-3">
                {{-- Nombre --}}
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           class="form-control"
                           required>
                </div>

                {{-- NIF --}}
                <div class="col-md-6">
                    <label for="nif" class="form-label">NIF</label>
                    <input type="text"
                           name="nif"
                           id="nif"
                           value="{{ old('nif') }}"
                           class="form-control">
                </div>

                {{-- Dirección --}}
                <div class="col-12">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text"
                           name="address"
                           id="address"
                           value="{{ old('address') }}"
                           class="form-control"
                           required>
                </div>

                {{-- Teléfono --}}
                <div class="col-md-4">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text"
                           name="phone"
                           id="phone"
                           value="{{ old('phone') }}"
                           class="form-control"
                           required>
                </div>

                {{-- Email --}}
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           class="form-control"
                           required>
                </div>

                {{-- Provincia --}}
                <div class="col-md-4">
                    <label for="province_id" class="form-label">Provincia</label>
                    <select name="province_id"
                            id="province_id"
                            class="form-select"
                            required>
                        <option value="" disabled selected>Seleccione provincia</option>
                        @foreach($provinces as $prov)
                            <option value="{{ $prov->id }}"
                                {{ old('province_id') == $prov->id ? 'selected' : '' }}>
                                {{ $prov->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Paso 3: Botón de envío, alineado a la derecha --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success px-4 py-2">
                    <i class="bi bi-check-circle me-1"></i> Crear Cliente
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
