@extends('layouts.main_layout')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container mt-7 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-4 text-center" style="width: 35rem;">
        <div class="card-header bg-primary text-white p-2">
            <h4 class="mb-0">Detalles del pedido {{ $order->id }}</h4>
        </div>
        <div class="card-body p-3 m-4">


            <!-- Datos del pedido -->
            <div class="text-center">
                <p><strong>ID Pedido:</strong> <span class="text-muted">{{ $order->id }}</span></p>
                <p><strong>Nombre:</strong> <span class="text-muted">{{ $order->customer->name }}</span></p>
                <p><strong>CIF:</strong> <span class="text-muted">{{ $order->customer->cif }}</span></p>
                <p><strong>Fecha:</strong> <span class="text-muted">{{ $order->order_date }}</span></p>
                <p><strong>Estado:</strong>
                    <span class="{{ clase_estado_pedido($order->status) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                <table class="table table-bordered border-primary">
                    <thead>
                      <tr>
                        <th scope="col">ID producto</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                     

                @foreach ($order->products as $product)
                
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ calcular_total_pedido_por_producto($product->pivot->unit_price,$product->pivot->quantity) }}</td>
                </td>
                  </tr>
                @endforeach

            </tbody>
        </table>

        <div class="card">hola</div>


@endsection
