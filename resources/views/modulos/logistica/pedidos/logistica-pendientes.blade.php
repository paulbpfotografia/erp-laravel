@extends('layouts.main_layout')

@section('title', 'Gestión de pedidos')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-semibold text-primary-emphasis">Pedidos por preparar</h2>

    <!-- Filtros -->
    <form method="GET" class="row g-2 align-items-end mb-4">
        <div class="col-md-6">
            <label for="buscar" class="form-label mb-0 fw-semibold">Buscar pedido</label>
            <input type="text" name="buscar" id="buscar" value="{{ request('buscar') }}" class="form-control"
                   placeholder="ID pedido, ID cliente o nombre cliente">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search me-1"></i> Filtrar
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('logistica.pendientes') }}" class="btn btn-outline-secondary w-100">
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
                    <th class="fw-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($orders as $order)
                    <tr class="transition hover-bg-light">
                        <td class="text-secondary">{{ $order->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge px-3 py-2 rounded-pill
                                {{ $order->status === 'pendiente' ? 'bg-warning-subtle text-warning' : '' }}
                                {{ $order->status === 'enviado' ? 'bg-info-subtle text-info' : '' }}
                                {{ $order->status === 'entregado' ? 'bg-success-subtle text-success' : '' }}
                                {{ $order->status === 'preparado' ? 'bg-primary-subtle text-primary' : '' }}
                                {{ $order->status === 'cancelado' ? 'bg-danger-subtle text-danger' : '' }}">
                                <i class="bi bi-circle-fill me-1 small"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('logistica.show', $order) }}"
                                   class="btn btn-sm btn-outline-secondary rounded-pill"
                                   data-bs-toggle="tooltip"
                                   title="Ver detalles del pedido">
                                    <i class="bi bi-eye"></i> Ver
                                </a>

                                <a href="{{ route('logistica.pedidos.verPreparacion', $order) }}"
                                   class="btn btn-sm btn-success rounded-pill"
                                   data-bs-toggle="tooltip"
                                   title="Preparar pedido">
                                    <i class="bi bi-box-seam"></i> Preparar
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted">No hay pedidos en esta categoría.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    @if ($orders->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
        <div class="text-muted small">
            Mostrando {{ $orders->firstItem() }} a {{ $orders->lastItem() }} de {{ $orders->total() }} resultados
        </div>
        <div>
            {{ $orders->onEachSide(1)->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
