@extends('layouts.main_layout')

@section('title', 'Gestión de clientes')

@section('content')
<div class="container mt-5">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary-emphasis">Clientes</h2>
        @can('crear clientes')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente">
            <i class="bi bi-plus-circle me-1"></i> Crear Cliente
        </button>
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
                    <th class="fw-semibold">Dirección</th>
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
                    <td>{{ $cliente->address }}</td>
                    <td>{{ $cliente->phone }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->province->name }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            @can('eliminar clientes')
                            <button type="button"
                                    class="btn btn-sm btn-danger eliminarRegistroBtn"
                                    data-id="{{ $cliente->id }}"
                                    data-url="{{ route('clientes.destroy', $cliente) }}"
                                    data-entidad="Cliente"
                                    data-bs-toggle="tooltip"
                                    title="Eliminar cliente">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                            @endcan

                            @can('editar clientes')
                            <a href="{{ route('clientes.edit', $cliente) }}"
                               class="btn btn-sm btn-warning"
                               data-bs-toggle="tooltip"
                               title="Editar cliente">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            @endcan

                            @can('ver clientes')
                            <a href="{{ route('clientes.show', $cliente) }}"
                               class="btn btn-sm btn-outline-primary"
                               data-bs-toggle="tooltip"
                               title="Ver detalles">
                                <i class="bi bi-eye-fill"></i>
                            </a>
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

    <!-- Modal Agregar Cliente -->
    <div class="modal fade" id="modalAgregarCliente" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg border-0 rounded-4">
                <div class="modal-header bg-primary text-white rounded-top">
                    <h4 class="modal-title">Registrar Cliente</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('clientes.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIF</label>
                                <input type="text" name="nif" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Dirección</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Provincia</label>
                                <select name="province_id" class="form-select" required>
                                    <option value="" selected disabled>Seleccione provincia</option>
                                    @foreach($provinces as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Crear Cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

