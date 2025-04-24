@extends('layouts.main_layout')

@section('title', 'Crear Pedido')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-4 rounded shadow-sm border border-light-subtle">

        <!-- Título y botón volver -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary-emphasis fw-semibold mb-0">
                <i class="bi bi-cart-plus me-2"></i> Registro de Pedido
            </h4>
            <a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf

            <!-- Cliente y transportista en una fila -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="customer_id" class="form-label fw-semibold">Cliente <span class="text-danger">*</span></label>
                    <select name="customer_id" class="form-select" required>
                        <option value="" disabled selected>Seleccione un cliente</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="carrier_id" class="form-label fw-semibold">Transportista</label>
                    <select name="carrier_id" class="form-select">
                        <option value="" disabled selected>Seleccione un transportista</option>
                        @foreach ($carriers as $carrier)
                            <option value="{{ $carrier->id }}">{{ $carrier->name }}</option>
                        @endforeach
                        <option value="0">Vehículo propio de la empresa</option>
                    </select>
                </div>
            </div>

            <hr class="mb-4">

            <!-- Productos agrupados -->
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
                                    <div class="row align-items-center mb-3">
                                        <div class="col-auto">
                                            <input type="checkbox" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                                        </div>
                                        <div class="col">
                                            <span class="fw-semibold">{{ $product->name }}</span>
                                            <small class="text-muted"> (ID: {{ $product->id }})</small><br>
                                            <small class="text-muted">Precio: {{ number_format($product->price, 2) }} €</small><br>
                                            <small class="text-muted">Stock disponible: {{ $product->stock->available_quantity ?? 0 }}</small>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="products[{{ $product->id }}][quantity]"
                                                   class="form-control"
                                                   placeholder="Cantidad"
                                                   min="1"
                                                   max="{{ $product->stock->available_quantity ?? 0 }}">
                                            <input type="hidden" name="products[{{ $product->id }}][unit_price]" value="{{ $product->price }}">
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

            <!-- Botón de envío -->
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success px-4 py-2">
                    <i class="bi bi-check-circle me-1"></i> Confirmar Pedido
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
