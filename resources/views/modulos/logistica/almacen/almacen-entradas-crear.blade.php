@extends('layouts.main_layout')

@section('title', 'Registrar entrada de stock')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-semibold text-primary-emphasis">Registrar nueva entrada</h2>

    {{-- Botón de volver atrás --}}
    <div class="mb-3">
        <a href="{{ route('logistica.almacen.entradas') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left-circle me-1"></i> Volver al listado
        </a>
    </div>

    <form action="{{ route('logistica.almacen.entradas.guardar') }}" method="POST" class="border rounded p-4 shadow-sm bg-white">
        @csrf

        <div class="mb-3">
            <label for="product_id" class="form-label fw-semibold">Producto</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="">Seleccione un producto</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label fw-semibold">Cantidad</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required value="{{ old('quantity') }}">
            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label fw-semibold">Razón de entrada</label>
            <input type="text" name="reason" id="reason" class="form-control" required value="{{ old('reason') }}">
            @error('reason') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success rounded-pill px-4">
                <i class="bi bi-box-arrow-in-down me-1"></i> Registrar entrada
            </button>
        </div>
    </form>
</div>
@endsection
