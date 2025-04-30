@extends('layouts.main_layout')

@section('title', 'Gestión de pedidos')

@section('content')
<div class="container mt-5">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary-emphasis">Pedidos</h2>

        @can('crear pedidos')
        <a href="{{ route('pedidos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Crear Pedido
        </a>
        @endcan
    </div>

    <!-- Filtros -->
    <form method="GET" class="row g-2 align-items-end mb-4">
        <div class="col-md-4">
            <label for="buscar" class="form-label mb-0 fw-semibold">Buscar pedido</label>
            <input type="text" name="buscar" id="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Buscar por ID o cliente">
        </div>
        <div class="col-md-4">
            <label for="estado" class="form-label mb-0 fw-semibold">Filtrar por estado</label>
            <select name="estado" id="estado" class="form-select">
                <option value="">Todos</option>
                <option value="pendiente" {{ request('estado') === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="preparado" {{ request('estado') === 'preparado' ? 'selected' : '' }}>Preparado</option>
                <option value="enviado" {{ request('estado') === 'enviado' ? 'selected' : '' }}>Enviado</option>
                <option value="entregado" {{ request('estado') === 'entregado' ? 'selected' : '' }}>Entregado</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search me-1"></i> Filtrar
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-x-circle me-1"></i> Limpiar
            </a>
        </div>
    </form>

    <!-- Tabla de pedidos -->
    <div class="table-responsive rounded shadow-sm border border-light-subtle">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-light text-uppercase small text-muted border-bottom border-2">
                <tr>
                    <th class="fw-semibold">ID</th>
                    <th class="fw-semibold">Fecha</th>
                    <th class="fw-semibold">Estado</th>
                    <th class="fw-semibold">Total</th>
                    <th class="fw-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($orders as $order)
                    <tr>
                        <td class="text-secondary">{{ $order->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge px-3 py-2 rounded-pill
                                {{ $order->status === 'pendiente' ? 'bg-warning-subtle text-warning' : '' }}
                                {{ $order->status === 'enviado' ? 'bg-info-subtle text-info' : '' }}
                                {{ $order->status === 'entregado' ? 'bg-success-subtle text-success' : '' }}
                                {{ $order->status === 'preparado' ? 'bg-primary-subtle text-primary' : '' }}">
                                <i class="bi bi-circle-fill me-1 small"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ number_format($order->total, 2) }} €</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                {{-- @can('eliminar pedidos')
                                <button type="button"
                                    class="btn btn-sm btn-danger eliminarRegistroBtn"
                                    data-id="{{ $order->id }}"
                                    data-url="{{ route('pedidos.destroy', $order->id) }}"
                                    data-entidad="Pedido"
                                    data-bs-toggle="tooltip"
                                    title="Eliminar pedido">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                                @endcan --}}

                                @can('editar pedidos')
                                @if(in_array($order->status, ['pendiente', 'preparado']))
                                    <a href="{{ route('pedidos.edit', $order) }}"
                                       class="btn btn-sm btn-warning"
                                       data-bs-toggle="tooltip"
                                       title="Editar pedido">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                @endif
                            @endcan


                                @can('ver pedidos')
                                <a href="{{ route('pedidos.show', $order) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   data-bs-toggle="tooltip"
                                   title="Ver detalles del pedido">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">No hay pedidos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
<div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
    <div class="text-muted small">
        Mostrando {{ $orders->firstItem() }} a {{ $orders->lastItem() }} de {{ $orders->total() }} resultados
    </div>
    <div>
        {{ $orders->withQueryString()->onEachSide(1)->links() }}
    </div>
</div>

<hr class="my-3">


    <hr class="my-4">
</div>


@endsection
