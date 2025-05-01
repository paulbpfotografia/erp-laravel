{{-- resources/views/modulos/productos/edit.blade.php --}}
@extends('layouts.main_layout')

@section('title', 'Editar Producto')

@section('content')
<div class="container mt-5">
    {{-- Panel con fondo blanco, sombra y bordes redondeados --}}
    <div class="bg-white p-4 rounded shadow-sm border border-light-subtle">

        {{-- 1) Encabezado: título dinámico + botón Volver --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary-emphasis fw-semibold mb-0">
                <i class="bi bi-pencil-fill me-2"></i> Editar Producto: {{ $product->name }}
            </h4>
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- 2) Formulario de edición --}}
        <form action="{{ route('productos.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- 2.1) Campos organizados en grid responsive --}}
            <div class="row g-3">
                {{-- Nombre --}}
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre del Producto</label>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $product->name) }}"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div class="col-12">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea id="description"
                              name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="3">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Precio --}}
                <div class="col-md-4">
                    <label for="price" class="form-label">Precio (€)</label>
                    <input type="number"
                           step="0.01"
                           id="price"
                           name="price"
                           class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price', $product->price) }}"
                           required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Categoría --}}
                <div class="col-md-4">
                    <label for="category_id" class="form-label">Categoría</label>
                    <select id="category_id"
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            required>
                        <option value="" disabled>Seleccione categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Imagen --}}
                <div class="col-md-4">
                    <label for="image" class="form-label">Imagen del Producto</label>
                    <input type="file"
                           id="image"
                           name="image"
                           class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if($product->image)
                        <img src="{{ asset($product->image) }}"
                             alt="{{ $product->name }}"
                             class="img-thumbnail mt-2"
                             style="max-width: 150px;">
                    @endif
                </div>
            </div>

            {{-- 3) Botón de enviar, alineado a la derecha --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-check-circle me-1"></i> Actualizar Producto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
