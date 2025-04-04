@extends('layouts.main_layout')
@section('title', 'Detalles del Producto')

@section('content')
<section class="content container mt-5">
    <div class="box">
        <div class="box-header with-border mb-4">
            <h2>Detalles del Producto: {{ $product->name }}</h2>
        </div>

        <!-- Fila con dos columnas: Info Principal + Imagen -->
        <div class="row mb-4">
            <!-- Columna 1: Tarjeta con Info Principal -->
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <strong>Información Principal</strong>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre del Producto:</strong> {{ $product->name }}</p>
                        <p><strong>Descripción:</strong> {{ $product->description }}</p>
                        <p><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
                        <p><strong>Categoría:</strong> {{ $product->category->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Columna 2: Tarjeta con Imagen -->
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <strong>Imagen</strong>
                    </div>
                    <div class="card-body text-center">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="Imagen del Producto"
                                 class="img-thumbnail mt-2"
                                 style="max-width: 100%; height: auto;">
                        @else
                            <p>No hay imagen disponible.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Acordeón con detalles, especificaciones y reseñas -->
        <div class="accordion" id="productAccordion">
            <!-- Bloque 1: Detalles adicionales -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingDetails">
                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseDetails"
                            aria-expanded="false"
                            aria-controls="collapseDetails">
                        Detalles del Producto
                    </button>
                </h2>
                <div id="collapseDetails"
                     class="accordion-collapse collapse"
                     aria-labelledby="headingDetails"
                     data-bs-parent="#productAccordion">
                    <div class="accordion-body">
                        @if(isset($product->details))
                            <p><strong>Marca:</strong> {{ $product->details->brand }}</p>
                            <p><strong>Envío:</strong> {!! nl2br(e($product->details->shipping_info)) !!}</p>
                            <p><strong>Política de Devolución:</strong> {!! nl2br(e($product->details->return_policy)) !!}</p>
                            <p><strong>Garantía:</strong> {{ $product->details->warranty }}</p>
                        @else
                            <p>No hay detalles adicionales registrados para este producto.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bloque 2: Especificaciones técnicas -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSpecs">
                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseSpecs"
                            aria-expanded="false"
                            aria-controls="collapseSpecs">
                        Especificaciones Técnicas
                    </button>
                </h2>
                <div id="collapseSpecs"
                     class="accordion-collapse collapse"
                     aria-labelledby="headingSpecs"
                     data-bs-parent="#productAccordion">
                    <div class="accordion-body">
                        @if(isset($product->specs))
                            <p><strong>Peso:</strong> {{ $product->specs->weight }} kg</p>
                            <p><strong>Dimensiones:</strong> {{ $product->specs->dimensions }}</p>
                            <p><strong>Color:</strong> {{ $product->specs->color }}</p>
                            <p><strong>Material:</strong> {{ $product->specs->material }}</p>
                        @else
                            <p>No hay especificaciones técnicas registradas para este producto.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bloque 3: Reseñas -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingReviews">
                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseReviews"
                            aria-expanded="false"
                            aria-controls="collapseReviews">
                        Reseñas
                    </button>
                </h2>
                <div id="collapseReviews"
                     class="accordion-collapse collapse"
                     aria-labelledby="headingReviews"
                     data-bs-parent="#productAccordion">
                    <div class="accordion-body">
                        @if(isset($product->reviews) && $product->reviews->count() > 0)
                            @foreach($product->reviews as $review)
                                <div class="border rounded p-2 mb-3">
                                    <p>
                                        <strong>Cliente:</strong>
                                        {{ optional($review->customer)->name ?? 'Desconocido' }}
                                    </p>
                                    <p>
                                        <strong>Valoración:</strong>
                                        {{ $review->rating }} / 5
                                    </p>
                                    <p><strong>Comentario:</strong> {{ $review->comment }}</p>
                                </div>
                            @endforeach
                        @else
                            <p>No hay reseñas para este producto.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div> <!-- Fin del acordeón -->
    </div>
</section>
@endsection
