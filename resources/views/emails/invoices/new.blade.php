<x-mail::message>
# Se adjunta factura

Hola {{ $order->customer->name }},

Gracias por su compra. Adjunto encontrará la factura en PDF correspondiente a su pedido **#{{ $order->id }}**, generado el {{ $order->created_at->format('d/m/Y') }}.

---

## Detalles del pedido

<x-mail::table>
| Producto               | Cantidad | Precio unitario | Subtotal     |
|:-----------------------|:--------:|----------------:|-------------:|
@foreach($order->products as $item) {{--Recorre cada producto e incluye datos de la tabla intermedia (quantity - group price)  --}}
    @php
        $qty       = $item->pivot->quantity; //Cantidad de unidades de ese producto en la orden
        $subtotal  = $item->pivot->group_price; //Importe de las unidades (guardado en group_price)
        $unitPrice = $qty > 0 ? $subtotal / $qty : 0; //precio por unidad
    @endphp
| {{ $item->name }}      |   {{ $qty }}    | €{{ number_format($unitPrice, 2) }}       | €{{ number_format($subtotal, 2) }} |
@endforeach
| **Total**              |          |                 | **€{{ number_format($order->products->sum(fn($i) => $i->pivot->group_price), 2) }}** |
</x-mail::table>

---

<x-mail::button :url="url('/pedidos/' . $order->id)">
Ver pedido en su cuenta
</x-mail::button>


¡Gracias por confiar en nosotros!

Saludos cordiales,<br>
{{ config('app.name') }}
</x-mail::message>
