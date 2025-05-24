<x-mail::message>
# ¡Nuevo Producto Disponible!

Tenemos un nuevo producto que podría interesarte:

**Nombre:** {{ $product->name }}

**Descripción:** {{ $product->description ?? 'Sin detalles disponible.' }}

**Precio:** ${{ number_format($product->price, 2) }}

@if ($product->image)
<img src="{{ asset($product->image) }}" alt="Imagen del producto" width="300">
@endif

<x-mail::button :url="url('/productos/' . $product->id)">
Ver Producto
</x-mail::button>

Gracias por confiar en nosotros,<br>
{{ config('app.name') }}
</x-mail::message>
