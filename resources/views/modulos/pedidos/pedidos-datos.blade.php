@extends('layouts.main_layout')

@section('title', 'Detalle del pedido')

@section('content')
@php use Illuminate\Support\Facades\Storage; @endphp
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-body px-4 py-5">

            <!-- Cabecera del pedido -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0 text-primary-emphasis">
                    <i class="bi bi-receipt me-2"></i> Pedido #{{ $order->id }}
                </h4>

                <div class="d-flex align-items-center gap-3">
                    <span class="badge px-3 py-2 rounded-pill fs-6
                        {{ $order->status === 'pendiente' ? 'bg-warning-subtle text-warning' : '' }}
                        {{ $order->status === 'enviado' ? 'bg-info-subtle text-info' : '' }}
                        {{ $order->status === 'entregado' ? 'bg-success-subtle text-success' : '' }}
                        {{ $order->status === 'preparado' ? 'bg-primary-subtle text-primary' : '' }}
                        {{ $order->status === 'cancelado' ? 'bg-danger-subtle text-danger' : '' }}">
                        <i class="bi bi-circle-fill me-1 small"></i>
                        {{ ucfirst($order->status) }}
                    </span>

                    @can('editar pedidos')
                        @if(in_array($order->status, ['pendiente', 'preparado']))
                            <a href="{{ route('pedidos.edit', $order) }}" class="btn btn-sm btn-warning rounded-pill">
                                <i class="bi bi-pencil-fill me-1"></i> Editar pedido
                            </a>
                        @endif
                    @endcan
                </div>
            </div>

            <!-- Fecha -->
            <div class="mb-4">
                <p class="mb-0"><strong>Fecha del pedido:</strong>
                    <span class="text-muted">{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</span>
                </p>
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

            <!-- Productos -->
            <h5 class="text-primary-emphasis mb-3">Productos del pedido</h5>

            @if($order->products->isEmpty())
                <p class="text-muted">Este pedido no tiene productos.</p>
            @else
                @php $totalPedido = 0; @endphp

                <ul class="list-group list-group-flush mb-4">
                    @foreach ($order->products as $product)
                        @php
                            $subtotal = calcular_total_pedido_por_producto($product->price, $product->pivot->quantity);
                            $totalPedido += $subtotal;
                        @endphp
                        <li class="list-group-item px-4 py-3 d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1 fw-semibold">{{ $product->name }}</h6>
                                <small class="text-muted d-block">Categoría: {{ $product->category->name ?? 'Sin categoría' }}</small>
                                <small class="text-muted d-block">Precio unitario: {{ number_format($product->price, 2) }} €</small>
                                <small class="text-muted d-block">Cantidad: {{ $product->pivot->quantity }}</small>
                            </div>
                            <div class="text-end">
                                <span class="fw-semibold text-primary">
                                    {{ number_format($subtotal, 2) }} €
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <!-- Total pedido con desglose de IVA -->
                @php
                    $totalIVA = $order->products->sum(function($p) {
                        return $p->pivot->quantity * $p->price * ($p->iva / 100);
                    });
                    $totalConIVA = $order->total + $totalIVA;
                @endphp

                <div class="text-end mt-3">
                    <p class="mb-1"><strong>Subtotal (sin IVA):</strong> {{ number_format($order->total, 2) }} €</p>
                    <p class="mb-1"><strong>IVA total:</strong> {{ number_format($totalIVA, 2) }} €</p>
                    <p class="fs-5 fw-semibold">
                        <span class="badge bg-success-subtle text-success-emphasis px-4 py-3 rounded-pill shadow-sm">
                            Total con IVA: {{ number_format($totalConIVA, 2) }} €
                        </span>
                    </p>
                </div>

                <!-- Documentación del pedido -->
                @if(in_array($order->status, ['preparado', 'enviado', 'entregado']))
                    <div class="mt-4">
                        <h6 class="text-primary-emphasis fw-semibold mb-3">
                            <i class="bi bi-folder-fill me-2"></i> Documentación del pedido
                        </h6>

                        <div class="d-flex gap-3 flex-wrap">
                            @php
                                $albaranPath = 'albaranes/pedido_' . $order->id . '.pdf';
                            @endphp

                            @if(Storage::disk('public')->exists($albaranPath))
                                <a href="{{ route('pedidos.albaran', $order) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Descargar albarán
                                </a>
                            @endif

                            @if($order->status === 'entregado')
                                @php
                                    $facturaPath = 'facturas/pedido_' . $order->id . '.pdf';
                                @endphp

                                @if(Storage::disk('public')->exists($facturaPath))
                                    <a href="{{ route('pedidos.factura', $order) }}" class="btn btn-sm btn-outline-dark rounded-pill">
                                        <i class="bi bi-file-earmark-text-fill me-1"></i> Descargar factura
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            @endif

            <!-- Botón volver -->
            <div class="mt-5 text-end">
                <a href="{{ route('pedidos.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                    <i class="bi bi-arrow-left-circle me-1"></i> Volver
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
