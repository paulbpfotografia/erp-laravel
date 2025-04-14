@extends('layouts.main_layout')

@section('title', 'Preparar pedido')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <h4 class="fw-bold mb-4 text-primary-emphasis">
                <i class="bi bi-box-seam me-2"></i> Preparar pedido #{{ $order->id }}
            </h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('logistica.pedidos.preparar', $order) }}" method="POST">
                @csrf

                <ul class="list-group list-group-flush mb-4">
                    @foreach ($order->products as $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $product->name }}</strong><br>
                                <small class="text-muted">Cantidad: {{ $product->pivot->quantity }}</small>
                            </div>
                            <div>
                                @if (!$product->pivot->prepared)
                                    <!-- Solo mostrar el checkbox si no está preparado -->
                                    <input type="checkbox"
                                           name="productos_preparados[]"
                                           value="{{ $product->id }}"
                                           id="product_{{ $product->id }}">
                                    <label for="product_{{ $product->id }}" class="ms-1">Preparar</label>
                                @else
                                    <!-- Mostrar "Ya preparado" si el producto está marcado como preparado -->
                                    <span class="text-success fw-semibold">
                                        <i class="bi bi-check-circle-fill me-1"></i> Ya preparado
                                    </span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i> Guardar preparación
                    </button>
                </div>
            </form>

            <div class="mt-4 text-end">
                <a href="{{ route('logistica.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle me-1"></i> Volver
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
