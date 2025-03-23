@extends('layouts.main_layout')

@section('title', 'Gestión de productos')

@section('content')

<section class="content">
    <div class="box">
        @can('crear productos')
        <div class="box-header with-border">
            <!-- Botón Registrar Producto -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
                Crear Producto
            </button>
        </div>
        @endcan

        <div class="box-body">
            <div class="container mt-4">
                <h2 class="mb-3">Productos</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center align-middle">
                        <thead class="thead-light">
                            <tr class="bg-primary text-white">
                                <th class="fw-bold">ID</th>
                                <th class="fw-bold">Nombre</th>
                                <th class="fw-bold">Descripción</th>
                                <th class="fw-bold">Precio</th>
                                <th class="fw-bold">Categoría</th>
                                <th class="fw-bold">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Formulario de eliminación -->
                                        <!-- Botón Eliminar -->
                                        @can('eliminar productos')
                                        <button type="button" class="btn btn-sm btn-danger eliminarRegistroBtn"
                                            data-id="{{ $product->id }}"
                                            data-url="{{ route('productos.destroy', $product->id) }}"
                                            data-entidad="Productos">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                        @endcan


                                        <!-- Botón Editar -->
                                        @can('editar productos')
                                        <a href="{{ route('productos.edit', $product) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        @endcan

                                        <!-- Botón Ver -->
                                        @can('ver productos')
                                        <a href="{{ route('productos.show', $product) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- Fin de tabla -->
            </div>
        </div>
    </div>
</section>

<!-- Modal Agregar Producto -->
<div class="modal fade" id="modalAgregarProducto" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white rounded-top">
                <h4 class="modal-title" id="modalProductoAgregarLabel">Registrar Producto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Nombre del Producto -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Producto</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <!-- Descripción del Producto -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <!-- Precio del Producto -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <!-- Categoría -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoría</label>
                        <select name="category_id" class="form-control" required>
                            <option value="" disabled selected>Seleccione una categoría</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Imagen del Producto -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen del Producto</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Crear Producto</button>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection
