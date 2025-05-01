{{-- resources/views/modulos/clientes/show.blade.php --}}
@extends('layouts.main_layout')

@section('title', 'Detalle Cliente')

@section('content')
<div class="container mt-5">
    {{-- Panel detallado --}}
    <div class="bg-white p-4 rounded shadow-sm border border-light-subtle">

        {{-- 1) Encabezado: título + botón Volver --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary-emphasis fw-semibold mb-0">
                <i class="bi bi-eye-fill me-2"></i> Detalle de Cliente
            </h4>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- 2) Tabla de detalles --}}
        <div class="table-responsive">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <th class="fw-semibold w-25">ID</th>
                        <td>{{ $customer->id }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Nombre</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">NIF</th>
                        <td>{{ $customer->nif ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Dirección</th>
                        <td>{{ $customer->address }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Teléfono</th>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Email</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Provincia</th>
                        <td>{{ $customer->province->name }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Creado</th>
                        <td>{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Modificado</th>
                        <td>{{ $customer->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- 3) Botones de acción (Editar / Eliminar) --}}
        <div class="mt-4 d-flex gap-2">
            @can('editar clientes')
            <a href="{{ route('clientes.edit', $customer) }}"
               class="btn btn-warning">
                <i class="bi bi-pencil-fill me-1"></i> Editar
            </a>
            @endcan

            @can('eliminar clientes')
            <button type="button"
                    class="btn btn-danger eliminarRegistroBtn"
                    data-id="{{ $customer->id }}"
                    data-url="{{ route('clientes.destroy', $customer) }}"
                    data-entidad="Cliente">
                <i class="bi bi-trash3-fill me-1"></i> Eliminar
            </button>
            @endcan
        </div>
    </div>
</div>
@endsection
