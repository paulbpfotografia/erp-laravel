@extends('layouts.main_layout')

@section('title', 'Gestión de pedidos')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary-emphasis">Pedidos</h2>

        @can('crear pedidos')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarPedidos">
            <i class="bi bi-plus-circle me-1"></i> Crear Pedido
        </button>
        @endcan
    </div>

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
                                @can('eliminar pedidos')
                                <button type="button"
                                    class="btn btn-sm btn-danger eliminarRegistroBtn"
                                    data-id="{{ $order->id }}"
                                    data-url="{{ route('pedidos.destroy', $order->id) }}"
                                    data-entidad="Pedido"
                                    data-bs-toggle="tooltip"
                                    title="Eliminar pedido">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                                @endcan

                                @can('editar pedidos')
                                <a href="{{ route('pedidos.edit', $order) }}"
                                   class="btn btn-sm btn-warning"
                                   data-bs-toggle="tooltip"
                                   title="Editar pedido">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
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

    <hr class="my-4">
</div>




@endsection
