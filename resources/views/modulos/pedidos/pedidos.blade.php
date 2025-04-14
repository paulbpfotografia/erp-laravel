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

<!-- MODAL AGREGAR PEDIDO -->
<div class="modal fade" id="modalAgregarPedidos" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white rounded-top">
                <h4 class="modal-title" id="modalPedidosAgregarLabel">
                    <i class="bi bi-cart-plus me-2"></i> Registro de Pedido
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('pedidos.store') }}" method="POST">
                    @csrf

                    <!-- Cliente -->
                    <div class="mb-3">
                        <label for="customer_id" class="form-label fw-semibold">Cliente</label>
                        <select name="customer_id" class="form-select" required>
                            <option value="" disabled selected>Seleccione un cliente</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Productos agrupados por categoría -->
                    <div class="accordion" id="accordionCategorias">
                        @foreach ($categories as $category)
                            @php
                                $collapseId = 'collapseCategoria' . $category->id;
                                $headingId = 'headingCategoria' . $category->id;
                            @endphp

                            <div class="accordion-item border-0 shadow-sm mb-3 rounded-3">
                                <h2 class="accordion-header" id="{{ $headingId }}">
                                    <button class="accordion-button collapsed fw-semibold" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#{{ $collapseId }}"
                                            aria-expanded="false"
                                            aria-controls="{{ $collapseId }}">
                                        {{ $category->name }}
                                    </button>
                                </h2>

                                <div id="{{ $collapseId }}" class="accordion-collapse collapse"
                                     aria-labelledby="{{ $headingId }}" data-bs-parent="#accordionCategorias">
                                    <div class="accordion-body">
                                        @forelse ($category->products as $product)
                                            <div class="row align-items-center mb-2">
                                                <div class="col-auto">
                                                    <input type="checkbox" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                                                </div>
                                                <div class="col">
                                                    <span class="fw-semibold">{{ $product->name }}</span>
                                                    <small class="text-muted"> (ID: {{ $product->id }})</small><br>
                                                    <small class="text-muted">Precio: {{ number_format($product->price, 2) }} €</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" name="products[{{ $product->id }}][quantity]"
                                                           class="form-control"
                                                           placeholder="Cantidad"
                                                           max="{{ $product->stock }}">
                                                </div>
                                                <input type="hidden" name="products[{{ $product->id }}][unit_price]" value="{{ $product->price }}">
                                            </div>
                                        @empty
                                            <p class="text-muted">No hay productos en esta categoría.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón de enviar -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-1"></i> Crear Pedido
                        </button>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Cerrar
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
