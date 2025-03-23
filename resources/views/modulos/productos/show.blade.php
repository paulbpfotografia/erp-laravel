@extends('layouts.main_layout')

@section('title', 'Detalles del Producto')

@section('content')

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h2>Detalles del Producto: {{ $product->name }}</h2>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label>Nombre del Producto:</label>
                <p>{{ $product->name }}</p>
            </div>

            <div class="form-group">
                <label>Descripción:</label>
                <p>{{ $product->description }}</p>
            </div>

            <div class="form-group">
                <label>Precio:</label>
                <p>${{ number_format($product->price, 2) }}</p>
            </div>

            <div class="form-group">
                <label>Categoría:</label>
                <p>{{ $product->category->name }}</p>
            </div>

            <div class="form-group">
                <label>Imagen:</label>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del Producto" class="img-thumbnail mt-2" width="150">
                @else
                    <p>No hay imagen disponible.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
