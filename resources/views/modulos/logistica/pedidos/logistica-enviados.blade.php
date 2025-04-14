@extends('layouts.main_layout')

@section('title', 'Gestión de pedidos')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-semibold text-primary-emphasis">Pedidos por preparar</h2>

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
                                {{ $order->status === 'preparado' ? 'bg-primary-subtle text-primary' : '' }}">
                                <i class="bi bi-circle-fill me-1 small"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('logistica.show', $order) }}"
                               class="btn btn-sm btn-outline-secondary rounded-pill"
                               data-bs-toggle="tooltip"
                               title="Ver detalles del pedido">
                                <i class="bi bi-eye"></i>
                                Ver
                            </a>
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
</div>
@endsection
