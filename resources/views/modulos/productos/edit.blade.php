@extends('layouts.main_layout')

@section('title', 'Editar Producto')

@section('content')

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h2>Editar Producto: {{ $product->name }}</h2>
        </div>

        <div class="box-body">
            <form action="{{ route('productos.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nombre del Producto -->
                <div class="form-group">
                    <label for="name">Nombre del Producto</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                </div>

                <!-- Descripción del Producto -->
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ $product->description }}</textarea>
                </div>

                <!-- Precio del Producto -->
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                </div>

                <!-- Categoría del Producto -->
                <div class="form-group">
                    <label for="category_id">Categoría</label>
                    <select class="form-control" id="category_id" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Imagen del Producto -->
                <div class="form-group">
                    <label for="image">Imagen</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del Producto" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            </form>
        </div>
    </div>
</section>

@endsection
