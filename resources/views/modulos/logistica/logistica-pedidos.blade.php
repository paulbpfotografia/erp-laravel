@extends('layouts.main_layout')

@section('title', 'Detalles del Pedido')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0 d-flex align-items-center">
                        <i class="bi bi-receipt me-2"></i> Detalles del Pedido #{{ $order->id }}
                    </h4>
                </div>

                <div class="card-body p-4">
                    <div class="mb-3">
                        <p class="mb-1 text-uppercase text-secondary fw-semibold">ID Pedido</p>
                        <h6 class="text-dark">{{ $order->id }}</h6>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1 text-uppercase text-secondary fw-semibold">Cliente</p>
                        <h6 class="text-dark">{{ $order->customer->name }}</h6>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1 text-uppercase text-secondary fw-semibold">Fecha</p>
                        <h6 class="text-dark">{{ $order->order_date }}</h6>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1 text-uppercase text-secondary fw-semibold">Estado</p>
                        <h6 class="{{ clase_estado_pedido($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </h6>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-hover align-middle text-center shadow-sm rounded overflow-hidden">
                            <thead class="table-primary text-uppercase">
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white border-top rounded-bottom-4 text-center py-3">
                    <a href="{{ route('logistica.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-arrow-left-circle me-1"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
