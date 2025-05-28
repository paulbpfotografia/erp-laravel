@extends('layouts.main_layout')

@section('title', 'Editar Pedido')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-4 rounded shadow-sm border border-light-subtle">

        <!-- Cabecera -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary-emphasis fw-semibold mb-0">
                <i class="bi bi-pencil-square me-2"></i> Editar Pedido #{{ $order->id }}
            </h4>
            <a href="{{ route('pedidos.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        <!-- Estado actual -->
        <div class="mb-4">
            <span class="badge px-3 py-2 rounded-pill fs-6
                {{ $order->status === 'pendiente' ? 'bg-warning-subtle text-warning' : '' }}
                {{ $order->status === 'preparado' ? 'bg-primary-subtle text-primary' : '' }}
                {{ $order->status === 'cancelado' ? 'bg-danger-subtle text-danger' : '' }}">
                <i class="bi bi-circle-fill me-1 small"></i> {{ ucfirst($order->status) }}
            </span>
        </div>

        <!-- Formulario de edición -->
        <form action="{{ route('pedidos.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <h5 class="fw-semibold mb-3 text-primary-emphasis">
                <i class="bi bi-box-seam me-2"></i> Productos del pedido
            </h5>

            <div class="accordion" id="accordionCategorias">
                @foreach ($categories as $category)
                    @php
                        $collapseId = 'collapseCategoria' . $category->id;
                        $headingId = 'headingCategoria' . $category->id;
                    @endphp

                    <div class="accordion-item border-0 shadow-sm mb-3 rounded-3">
                        <h2 class="accordion-header" id="{{ $headingId }}">
                            <button class="accordion-button collapsed fw-semibold text-dark" type="button"
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
                                    @php
                                        $enPedido = $order->products->contains($product);
                                        $cantidad = $enPedido ? $order->products->find($product->id)->pivot->quantity : '';
                                    @endphp
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            @if(!$enPedido)
                                                <input type="checkbox" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                                            @endif
                                        </div>
                                        <div class="col">
                                            <span class="fw-semibold">{{ $product->name }}</span>
                                            <small class="text-muted"> (ID: {{ $product->id }})</small><br>
                                            <small class="text-muted">Precio: {{ number_format($product->price, 2) }} €</small><br>
                                            <small class="text-muted">Stock disponible: {{ $product->stock->available_quantity ?? 0 }}</small>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number"
                                                   name="{{ $enPedido ? 'productos[' . $product->id . '][cantidad]' : 'nuevos[' . $product->id . ']' }}"
                                                   class="form-control"
                                                   placeholder="Cantidad"
                                                   value="{{ old('productos.' . $product->id . '.cantidad', $cantidad) }}"
                                                   min="0"
                                                   max="{{ $product->stock->available_quantity ?? 0 }}">
                                            @if($enPedido)
                                                <input type="hidden" name="productos[{{ $product->id }}][unit_price]" value="{{ $product->price }}">
                                            @else
                                                <input type="hidden" name="products[{{ $product->id }}][unit_price]" value="{{ $product->price }}">
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No hay productos en esta categoría.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Botón de guardar -->
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-sm btn-success rounded-pill px-4">
                    <i class="bi bi-check-circle me-1"></i> Guardar Cambios
                </button>
            </div>
        </form>

        <!-- Botón cancelar pedido -->
        @can('editar pedidos')
            @if(in_array($order->status, ['pendiente', 'preparado']))
                <form action="{{ route('pedidos.cancel', $order) }}" method="POST" class="mt-4"
                      onsubmit="return confirm('¿Estás seguro de que deseas cancelar este pedido?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                        <i class="bi bi-x-circle-fill me-1"></i> Cancelar pedido
                    </button>
                </form>
            @endif
        @endcan
    </div>
</div>
@endsection
