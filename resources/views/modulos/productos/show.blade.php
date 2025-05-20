@extends('layouts.main_layout')

@section('title', 'Detalle de Producto')

@section('content')
<div class="container mt-5">
  <div class="bg-white p-4 rounded shadow-sm border border-light-subtle">

    {{-- 1) Encabezado: Título + Volver + Acciones --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="text-primary-emphasis fw-semibold mb-0">
        <i class="bi bi-eye me-2"></i> Detalle de Producto: {{ $product->name }}
      </h4>
      <div class="d-flex gap-2">

        <a href="{{ route('productos.index') }}"
           class="btn btn-sm btn-outline-secondary rounded-pill"
           data-bs-toggle="tooltip"
           title="Volver al listado">
          <i class="bi bi-arrow-left"></i> Volver
        </a>

        @can('editar productos')
        <a href="{{ route('productos.edit', $product) }}"
           class="btn btn-sm btn-outline-warning rounded-pill"
           data-bs-toggle="tooltip"
           title="Editar producto">
          <i class="bi bi-pencil"></i> Editar
        </a>
        @endcan

        @can('eliminar productos')
        <button type="button"
                class="btn btn-sm btn-outline-danger rounded-pill eliminarRegistroBtn"
                data-id="{{ $product->id }}"
                data-url="{{ route('productos.destroy', $product) }}"
                data-entidad="Producto"
                data-bs-toggle="tooltip"
                title="Eliminar producto">
          <i class="bi bi-trash3"></i> Eliminar
        </button>
        @endcan

      </div>
    </div>

    {{-- 2) Contenido en dos columnas --}}
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="table-responsive">
          <table class="table table-borderless mb-0">
            <tbody>
              <tr><th class="fw-semibold">Nombre</th><td>{{ $product->name }}</td></tr>
              <tr><th class="fw-semibold">Precio</th><td>{{ number_format($product->price, 2) }} €</td></tr>
              <tr><th class="fw-semibold">Categoría</th><td>{{ $product->category->name }}</td></tr>
              <tr><th class="fw-semibold">Descripción</th><td>{{ $product->description }}</td></tr>
              <tr><th class="fw-semibold">Detalles</th><td>{{ optional($product->details)->description ?? '—' }}</td></tr>
              <tr><th class="fw-semibold">Peso</th><td>{{ optional($product->specs)->weight ? optional($product->specs)->weight . ' kg' : '—' }}</td></tr>
              <tr><th class="fw-semibold">Dimensiones</th><td>{{ optional($product->specs)->dimensions ?? '—' }}</td></tr>
              <tr><th class="fw-semibold">Color</th><td>{{ optional($product->specs)->color ?? '—' }}</td></tr>
              <tr><th class="fw-semibold">Material</th><td>{{ optional($product->specs)->material ?? '—' }}</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <strong>Imagen del Producto</strong>
          </div>
          <div class="card-body d-flex justify-content-center align-items-center" style="min-height:200px;">
            @if($product->image)
            <img src="{{ asset($product->image) }}"
                 alt="{{ $product->name }}"
                 class="img-fluid rounded product-image">
            @else
            <p class="text-muted">No hay imagen disponible.</p>
            @endif
          </div>
        </div>
      </div>
    </div>

    {{-- 3) Fechas --}}
    <div class="mt-4 text-muted small">
      Creado: {{ optional($product->created_at)->format('d/m/Y H:i') ?? '—' }}
      &nbsp;|&nbsp;
      Actualizado: {{ optional($product->updated_at)->format('d/m/Y H:i') ?? '—' }}
    </div>

  </div>
</div>
@endsection
