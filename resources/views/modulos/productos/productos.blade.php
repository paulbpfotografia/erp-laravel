@extends('layouts.main_layout')

@section('title', 'Gestión de productos')

@section('content')
<div class="container mt-5">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary-emphasis">Productos</h2>

        @can('crear productos')
        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
            <i class="bi bi-plus-circle me-1"></i> Crear Producto
        </button>
        @endcan
    </div>

    <!-- Filtros -->
    <form method="GET" class="row g-2 align-items-end mb-4">
        <div class="col-md-4">
            <label for="buscar" class="form-label mb-0 fw-semibold">Buscar producto</label>
            <input type="text"
                name="buscar"
                id="buscar"
                value="{{ request('buscar') }}"
                class="form-control"
                placeholder="Nombre del producto">
        </div>

        <div class="col-md-4">
            <label for="categoria_id" class="form-label mb-0 fw-semibold">Filtrar por categoría</label>
            <select name="categoria_id"
                id="categoria_id"
                class="form-select">
                <option value="">Todas</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search me-1"></i> Filtrar
            </button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-x-circle me-1"></i> Limpiar
            </a>
        </div>
    </form>

    <!-- Tabla de productos -->
    <div class="table-responsive rounded shadow-sm border border-light-subtle">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-light text-uppercase small text-muted border-bottom border-2">
                <tr>
                    <th class="fw-semibold">ID</th>
                    <th class="fw-semibold">Nombre</th>
                    <th class="fw-semibold">Descripción</th>
                    <th class="fw-semibold">Precio</th>
                    <th class="fw-semibold">Categoría</th>
                    <th class="fw-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($products as $product)
                <tr>
                    <td class="text-secondary">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ number_format($product->price, 2) }} €</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            @can('ver productos')
                            <a href="{{ route('productos.show', $product) }}"
                               class="btn btn-sm btn-outline-secondary rounded-pill"
                               data-bs-toggle="tooltip"
                               title="Ver detalles del producto">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            @endcan

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
                                    data-url="{{ route('productos.destroy', $product->id) }}"
                                    data-entidad="Producto"
                                    data-bs-toggle="tooltip"
                                    title="Eliminar producto">
                                <i class="bi bi-trash3"></i> Eliminar
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted">No hay productos disponibles.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
        <div class="text-muted small">
            Mostrando {{ $products->firstItem() }} a {{ $products->lastItem() }} de {{ $products->total() }} resultados
        </div>
        <div>
            {{ $products->withQueryString()->onEachSide(1)->links() }}
        </div>
    </div>

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

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Producto</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoría</label>
                            <select name="category_id" class="form-select" required>
                                <option value="" disabled selected>Seleccione una categoría</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="detail_description" class="form-label">Detalles del Producto</label>
                            <textarea name="detail_description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Especificaciones Técnicas</label>
                            <input type="text" name="weight" class="form-control mb-2" placeholder="Peso (kg)">
                            <input type="text" name="dimensions" class="form-control mb-2" placeholder="Dimensiones (ej: 10x20x30 cm)">
                            <input type="text" name="color" class="form-control mb-2" placeholder="Color">
                            <input type="text" name="material" class="form-control mb-2" placeholder="Material">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen del Producto</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary rounded-pill mt-3">
                            <i class="bi bi-check-circle me-1"></i> Crear Producto
                        </button>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger rounded-pill" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cerrar
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
