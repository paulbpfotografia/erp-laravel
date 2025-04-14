@extends('layouts.main_layout')

@section('title', 'Gestión de pedidos')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Pedidos por preparar</h2>

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle shadow-sm rounded overflow-hidden text-center">
            <thead class="table-primary text-uppercase">
                <tr>
                    <th class="fw-bold">ID</th>
                    <th class="fw-bold">Fecha de creación</th>
                    <th class="fw-bold">Estado</th>
                    <th class="fw-bold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            <span class="{{ clase_estado_pedido($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @can('cambiar estado pedido')
                                    <a href="{{ route('logistica.show', $order) }}"
                                       class="btn btn-sm btn-primary"
                                       data-bs-toggle="tooltip"
                                       data-bs-placement="top"
                                       title="Ver detalles del pedido">
                                       <i class="bi bi-truck"></i>
                                    </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <hr class="my-4">
</div>
@endsection
