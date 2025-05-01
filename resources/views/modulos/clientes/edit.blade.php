{{-- resources/views/modulos/clientes/edit.blade.php --}}
@extends('layouts.main_layout')

@section('title', 'Editar Cliente')

@section('content')
<div class="container mt-5">
    {{-- Panel con sombra, bordes redondeados y fondo blanco --}}
    <div class="bg-white p-4 rounded shadow-sm border border-light-subtle">

        {{-- 1) Encabezado: título + botón Volver --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary-emphasis fw-semibold mb-0">
                <i class="bi bi-pencil-fill me-2"></i> Editar Cliente
            </h4>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- 2) Formulario de edición --}}
        <form action="{{ route('clientes.update', $customer) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- 2.1) Campos organizados en filas responsive --}}
            <div class="row g-3">
                {{-- Nombre --}}
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $customer->name) }}"
                           class="form-control @error('name') is-invalid @enderror"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NIF --}}
                <div class="col-md-6">
                    <label for="nif" class="form-label">NIF</label>
                    <input type="text"
                           id="nif"
                           name="nif"
                           value="{{ old('nif', $customer->nif) }}"
                           class="form-control @error('nif') is-invalid @enderror">
                    @error('nif')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Dirección --}}
                <div class="col-12">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text"
                           id="address"
                           name="address"
                           value="{{ old('address', $customer->address) }}"
                           class="form-control @error('address') is-invalid @enderror"
                           required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Teléfono --}}
                <div class="col-md-4">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text"
                           id="phone"
                           name="phone"
                           value="{{ old('phone', $customer->phone) }}"
                           class="form-control @error('phone') is-invalid @enderror"
                           required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $customer->email) }}"
                           class="form-control @error('email') is-invalid @enderror"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Provincia --}}
                <div class="col-md-4">
                    <label for="province_id" class="form-label">Provincia</label>
                    <select id="province_id"
                            name="province_id"
                            class="form-select @error('province_id') is-invalid @enderror"
                            required>
                        <option value="" disabled>Seleccione provincia</option>
                        @foreach($provinces as $prov)
                            <option value="{{ $prov->id }}"
                                {{ old('province_id', $customer->province_id) == $prov->id ? 'selected' : '' }}>
                                {{ $prov->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('province_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- 3) Botón de actualización, alineado a la derecha --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-check-circle me-1"></i> Actualizar Cliente
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
