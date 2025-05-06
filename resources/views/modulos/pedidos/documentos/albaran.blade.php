<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Albarán - Pedido #{{ $order->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            color: #333;
            margin: 30px;
        }
        h1 {
            text-align: center;
            color: #0d6efd;
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
        .firma-bloque{
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }
        .caja-firma {
            width: 45%;
        }
        .firma-linea {
            margin-top: 60px;
            border-top: 1px solid #000;
            width: 100%;
        }
        .fecha-firma {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Albarán de entrega</h1>

    <!-- Información del pedido -->
    <div class="info">
        <p><strong>N.º de pedido:</strong> {{ $order->id }}</p>
        <p><strong>Fecha del pedido:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</p>
    </div>

    <!-- Información del cliente -->
    @if($order->customer)
        <div class="info">
            <p><strong>Cliente:</strong> {{ $order->customer->name }}</p>
            <p><strong>Email:</strong> {{ $order->customer->email }}</p>
            <p><strong>Dirección:</strong> {{ $order->customer->address }}</p>
        </div>
    @endif

    <!-- Información del transportista -->
    @if($order->carrier)
        <div class="info">
            <p><strong>Transportista:</strong> {{ $order->carrier->name }}</p>
            <p><strong>Teléfono:</strong> {{ $order->carrier->phone }}</p>
        </div>
    @endif

    <!-- Productos -->
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
                <tr>
                    <td>
                        {{ $product->name }}<br>
                        <small class="text-muted">
                            Categoría: {{ $product->category->name ?? 'Sin categoría' }}
                        </small>
                    </td>
                    <td>{{ $product->pivot->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Firmas -->
    <div class="firma-bloque">
        <div class="caja-firma">
            <p><strong>Recibido por (cliente):</strong></p>
            <div class="signature-line"></div>
        </div>

        <div class="signature-box">
            <p><strong>Entregado por (transportista):</strong></p>
            <div class="firma-linea"></div>
        </div>
    </div>

    <div class="fecha-firma">
        <p><strong>Fecha de recepción:</strong> _____________________</p>
    </div>
</body>
</html>
