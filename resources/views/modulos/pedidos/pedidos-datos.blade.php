@extends('layouts.main_layout')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-4 text-center" style="width: 35rem;">
        <div class="card-header bg-primary text-white p-2">
            <h4 class="mb-0">Detalles del pedido {{ $order->id }}</h4>
        </div>
        <div class="card-body p-3">


            <!-- Datos del usuario -->
            <div class="text-center">
                <p><strong>ID Pedido:</strong> <span class="text-muted">{{ $order->id }}</span></p>
                <p><strong>Nombre:</strong> <span class="text-muted">{{ $order->customer->name }}</span></p>
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
                @foreach ($collection as $item)

                @endforeach






@endsection
