{{-- resources/views/productos/create.blade.php --}}
@extends('layouts.main_layout')

@section('title', 'Crear Producto')

@section('content')
<div class="container mt-5">
    {{-- Panel principal --}}
    <div class="bg-white p-4 rounded shadow-sm border border-light-subtle">

        {{-- 1) Encabezado: título y botón Volver --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary-emphasis fw-semibold mb-0">
                <i class="bi bi-plus-circle me-2"></i> Registrar Producto
            </h4>
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- 2) Formulario de creación --}}
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- 2.1) Campos en grid responsivo --}}
            <div class="row g-3">
                {{-- Nombre --}}
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre del Producto</label>
                    <input type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Precio --}}
                <div class="col-md-6">
                    <label for="price" class="form-label">Precio (€)</label>
                    <input type="number"
                        step="0.01"
                        id="price"
                        name="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price') }}"
                        required>
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Descripción corta --}}
                <div class="col-12">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea id="description"
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Detalles extendidos --}}
                <div class="col-12">
                    <label for="detail_description" class="form-label">Detalles del Producto</label>
                    <textarea id="detail_description"
                        name="detail_description"
                        class="form-control @error('detail_description') is-invalid @enderror"
                        rows="3">{{ old('detail_description') }}</textarea>
                    @error('detail_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Categoría --}}
                <div class="col-md-6">
                    <label for="category_id" class="form-label">Categoría</label>
                    <select id="category_id"
                        name="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
                        required>
                        <option value="" disabled selected>Seleccione categoría</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Cliente envió correo --}}
                <div class="mb-3">
                    <label class="form-label">Enviar notificación a:</label>

                    {{-- Opción "Todos" --}}
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox"
                            id="customer_all" name="customers[]" value="all"
                            {{ in_array('all', old('customers', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="customer_all">
                            Todos los clientes
                        </label>
                    </div>

                    {{-- Caja con scroll --}}
                    <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                        @foreach(\App\Models\Customer::orderBy('name')->get() as $customer)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                name="customers[]" value="{{ $customer->id }}"
                                id="customer_{{ $customer->id }}"
                                {{ in_array($customer->id, old('customers', [])) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="customer_{{ $customer->id }}">
                                <strong>{{ $customer->name }}</strong><br>
                                <span class="text-muted">{{ $customer->email }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>

                    @error('customers')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Peso --}}
                <div class="col-md-6">
                    <label for="weight" class="form-label">Peso (kg)</label>
                    <input type="text"
                        id="weight"
                        name="weight"
                        class="form-control @error('weight') is-invalid @enderror"
                        value="{{ old('weight') }}">
                    @error('weight')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Dimensiones --}}
                <div class="col-md-6">
                    <label for="dimensions" class="form-label">Dimensiones (ej: 10x20x30 cm)</label>
                    <input type="text"
                        id="dimensions"
                        name="dimensions"
                        class="form-control @error('dimensions') is-invalid @enderror"
                        value="{{ old('dimensions') }}">
                    @error('dimensions')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Color --}}
                <div class="col-md-6">
                    <label for="color" class="form-label">Color</label>
                    <input type="text"
                        id="color"
                        name="color"
                        class="form-control @error('color') is-invalid @enderror"
                        value="{{ old('color') }}">
                    @error('color')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Material --}}
                <div class="col-md-6">
                    <label for="material" class="form-label">Material</label>
                    <input type="text"
                        id="material"
                        name="material"
                        class="form-control @error('material') is-invalid @enderror"
                        value="{{ old('material') }}">
                    @error('material')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Imagen --}}
                <div class="col-md-6">
                    <label for="image" class="form-label">Imagen del Producto</label>
                    <input type="file"
                        id="image"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- 3) Botón de envío --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-check-circle me-1"></i> Crear Producto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
