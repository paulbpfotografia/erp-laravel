@extends('layouts.main_layout')

@section('title', 'Gestión de clientes')

@section('content')
<div class="container mt-5">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary-emphasis">Clientes</h2>

        @can('crear clientes')
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Crear Cliente
        </a>
        @endcan
    </div>

    <!-- Filtros -->
    <form method="GET" class="row g-2 align-items-end mb-4">
        <div class="col-md-4">
            <label for="buscar" class="form-label mb-0 fw-semibold">Buscar cliente</label>
            <input type="text"
                   name="buscar"
                   id="buscar"
                   value="{{ request('buscar') }}"
                   class="form-control"
                   placeholder="Nombre del cliente">
        </div>
        <div class="col-md-4">
            <label for="province_id" class="form-label mb-0 fw-semibold">Filtrar por provincia</label>
            <select name="province_id"
                    id="province_id"
                    class="form-select">
                <option value="">Todas</option>
                @foreach($provinces as $prov)
                <option value="{{ $prov->id }}"
                    {{ request('province_id') == $prov->id ? 'selected' : '' }}>
                    {{ $prov->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search me-1"></i> Filtrar
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-x-circle me-1"></i> Limpiar
            </a>
        </div>
    </form>

    <!-- Tabla de clientes -->
    <div class="table-responsive rounded shadow-sm border border-light-subtle">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-light text-uppercase small text-muted border-bottom border-2">
                <tr>
                    <th class="fw-semibold">ID</th>
                    <th class="fw-semibold">Nombre</th>
                    <th class="fw-semibold">NIF</th>
                    <th class="fw-semibold">Teléfono</th>
                    <th class="fw-semibold">Email</th>
                    <th class="fw-semibold">Provincia</th>
                    <th class="fw-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse($customers as $cliente)
                <tr>
                    <td class="text-secondary">{{ $cliente->id }}</td>
                    <td>{{ $cliente->name }}</td>
                    <td>{{ $cliente->nif }}</td>
                    <td>{{ $cliente->phone }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->province->name }}</td>
                    <td>
                       <div class="d-flex justify-content-center gap-2">

    @can('ver clientes')
    <a href="{{ route('clientes.show', $cliente) }}"
       class="btn btn-sm btn-outline-secondary rounded-pill"
       data-bs-toggle="tooltip"
       title="Ver detalles del cliente">
        <i class="bi bi-eye"></i> Ver
    </a>
    @endcan

    @can('editar clientes')
    <a href="{{ route('clientes.edit', $cliente) }}"
       class="btn btn-sm btn-outline-warning rounded-pill"
       data-bs-toggle="tooltip"
       title="Editar cliente">
        <i class="bi bi-pencil"></i> Editar
    </a>
    @endcan

    @can('eliminar clientes')
    <button type="button"
            class="btn btn-sm btn-outline-danger rounded-pill eliminarRegistroBtn"
            data-id="{{ $cliente->id }}"
            data-url="{{ route('clientes.destroy', $cliente) }}"
            data-entidad="Cliente"
            data-bs-toggle="tooltip"
            title="Eliminar cliente">
        <i class="bi bi-trash3"></i> Eliminar
    </button>
    @endcan

</div>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-muted">No hay clientes disponibles.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
        <div class="text-muted small">
            Mostrando {{ $customers->firstItem() }} a {{ $customers->lastItem() }} de {{ $customers->total() }} resultados
        </div>
        <div>
            {{ $customers->withQueryString()->onEachSide(1)->links() }}
        </div>
    </div>

</div>
@endsection
