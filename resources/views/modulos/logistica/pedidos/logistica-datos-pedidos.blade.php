@extends('layouts.main_layout')

@section('title', 'Detalle del pedido')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-body px-4 py-5">

            <!-- Cabecera del pedido -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0 text-primary-emphasis">
                    <i class="bi bi-receipt me-2"></i> Pedido #{{ $order->id }}
                </h4>

                <span class="badge px-3 py-2 rounded-pill fs-6
                    {{ $order->status === 'pendiente' ? 'bg-warning-subtle text-warning' : '' }}
                    {{ $order->status === 'enviado' ? 'bg-info-subtle text-info' : '' }}
                    {{ $order->status === 'entregado' ? 'bg-success-subtle text-success' : '' }}
                    {{ $order->status === 'preparado' ? 'bg-primary-subtle text-primary' : '' }}">
                    <i class="bi bi-circle-fill me-1 small"></i>
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Fecha -->
            <div class="mb-4">
                <p class="mb-0"><strong>Fecha del pedido:</strong> <span class="text-muted">{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</span></p>
            </div>

            <!-- Información del cliente -->
            @if($order->customer)
            <div class="mb-5">
                <h5 class="text-primary-emphasis mb-3">Datos del cliente</h5>
                <div class="border rounded p-3 bg-light">
                    <p class="mb-1"><strong>ID Cliente:</strong> {{ $order->customer->id }}</p>
                    <p class="mb-1"><strong>Nombre:</strong> {{ $order->customer->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->customer->email }}</p>
                </div>
            </div>
            @endif

            <!-- Información del transportista -->
            @if($order->carrier)
            <div class="mb-5">
                <h5 class="text-primary-emphasis mb-3">Transportista</h5>
                <div class="border rounded p-3 bg-light">
                    <p class="mb-1"><strong>Nombre:</strong> {{ $order->carrier->name }}</p>
                    <p class="mb-1"><strong>Teléfono:</strong> {{ $order->carrier->phone }}</p>
                </div>
            </div>
            @endif

            <!-- Productos -->
            <h5 class="text-primary-emphasis mb-3">Productos del pedido</h5>

            @if($order->products->isEmpty())
                <p class="text-muted">Este pedido no tiene productos.</p>
            @else
                <ul class="list-group list-group-flush mb-4">
                    @foreach ($order->products as $product)
                        <li class="list-group-item px-4 py-3 d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1 fw-semibold">{{ $product->name }}</h6>
                                <small class="text-muted d-block">Categoría: {{ $product->category->name ?? 'Sin categoría' }}</small>
                                <small class="text-muted d-block">Cantidad: {{ $product->pivot->quantity }}</small>
                            </div>
                            <div class="text-end">
                                @if (!$product->pivot->prepared)
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @else
                                    <span class="badge bg-success text-white">Preparado</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>

                <!-- Resumen del pedido -->
                <div class="border rounded p-3 bg-light mb-4">
                    <h6 class="fw-bold text-primary-emphasis mb-3">
                        <i class="bi bi-truck me-2"></i> Resumen del pedido
                    </h6>
                    <p class="mb-1"><strong>Total de productos:</strong> {{ $order->products->sum(fn($p) => $p->pivot->quantity) }}</p>
                    <p class="mb-1"><strong>Peso total:</strong>
                        {{ number_format($order->total_weight ?? $order->products->sum(fn($p) => $p->pivot->quantity * ($p->specs->weight ?? 0)), 2) }} kg
                    </p>
                    <p class="mb-0"><strong>Volumen total:</strong>
                        {{ number_format($order->total_volume ?? $order->products->sum(fn($p) => $p->pivot->quantity * ($p->specs->packaged_volume ?? 0)), 3) }} m³
                    </p>
                </div>
            @endif

            <!--Descargar Albarçan -->

            @if($order->status === 'preparado')
                @php
                    $albaranPath = 'albaranes/pedido_' . $order->id . '.pdf';
                @endphp

                @if(Storage::disk('public')->exists($albaranPath))
                    <div class="text-end mb-4">
                        <a href="{{ route('orders.download-albaran', $order) }}" class="btn btn-outline-primary">
                            <i class="bi bi-file-earmark-pdf-fill me-1"></i> Descargar albarán
                        </a>
                    </div>
                @endif
            @endif


            <!--volver -->
            <div class="mt-5 text-end">
                <a href="{{ route('logistica.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle me-1"></i> Volver
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
