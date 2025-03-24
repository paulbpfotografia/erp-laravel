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
                <?php
                $estado='';
                ?>
            @if ($order->status == 'enviado')
                    <?php
                    $estado='badge bg-info';
                    ?>
            @elseif ($order->status == 'pendiente')
                    <?php
                    $estado='badge bg-danger';
                    ?>
            @elseif ($order->status == 'preparado')
                    <?php
                    $estado='badge bg-warning';
                    ?>
            @else
                    <?php
                    $estado='badge bg-success';
                    ?>
            @endif
                <p><strong>Estado:</strong> <span class="{{ $estado }}">{{ $order->status }}</span></p>
              

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
                    <td>{{ $product->pivot->quantity  *  $product->pivot->unit_price }}</td>
                  </tr>
                @endforeach

            </tbody>
        </table>


@endsection
