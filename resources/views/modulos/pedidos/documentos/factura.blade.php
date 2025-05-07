<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura - Pedido #{{ $order->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            color: #333;
            margin: 30px;
        }
        h1 {
            text-align: center;
            color: #198754;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 3px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
        }
        .totals {
            margin-top: 20px;
            text-align: right;
        }
        .totals p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Factura</h1>

    <!-- Datos del pedido -->
    <div class="info">
        <p><strong>N.º de pedido:</strong> {{ $order->id }}</p>
        <p><strong>Fecha del pedido:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</p>
    </div>

    <!-- Datos del cliente -->
    @if($order->customer)
        <div class="info">
            <p><strong>Cliente:</strong> {{ $order->customer->name }}</p>
            <p><strong>Email:</strong> {{ $order->customer->email }}</p>
            <p><strong>Dirección:</strong> {{ $order->customer->address }}</p>
        </div>
    @endif

    <!-- Productos -->
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Precio unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>IVA (%)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalSinIVA = 0;
                $totalIVA = 0;
            @endphp
            @foreach($order->products as $product)
                @php
                    $subtotal = $product->price * $product->pivot->quantity;
                    $iva = $subtotal * ($product->iva / 100);
                    $totalSinIVA += $subtotal;
                    $totalIVA += $iva;
                @endphp
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Sin categoría' }}</td>
                    <td>{{ number_format($product->price, 2) }} €</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ number_format($subtotal, 2) }} €</td>
                    <td>{{ $product->iva }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totales -->
    <div class="totals">
        <p><strong>Total sin IVA:</strong> {{ number_format($totalSinIVA, 2) }} €</p>
        <p><strong>IVA total:</strong> {{ number_format($totalIVA, 2) }} €</p>
        <p><strong>Total con IVA:</strong> {{ number_format($totalSinIVA + $totalIVA, 2) }} €</p>
    </div>
</body>
</html>
