@extends('layouts.main_layout')

@section('title', 'Inventario de almacén')

@section('content')
<div class="container mt-5">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary-emphasis">Inventario de productos</h2>
    </div>

    <!-- Filtros -->
    <form method="GET" class="row g-2 align-items-end mb-4">
        <div class="col-md-4">
            <label for="product_id" class="form-label mb-0 fw-semibold">Buscar producto</label>
            <input type="text" name="product_id" id="product_id" value="{{ request('product_id') }}"
                   class="form-control" placeholder="Buscar por ID o nombre">
        </div>
        <div class="col-md-4">
            <label for="category_id" class="form-label mb-0 fw-semibold">Filtrar por categoría</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="">Todas</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
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
            <a href="{{ route('logistica.almacen.inventario') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-x-circle me-1"></i> Limpiar
            </a>
        </div>
    </form>

    <!--  productos -->
    <div class="table-responsive rounded shadow-sm border border-light-subtle">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-light text-uppercase small text-muted border-bottom border-2">
                <tr>
                    <th class="fw-semibold">ID</th>
                    <th class="fw-semibold">Producto</th>
                    <th class="fw-semibold">Categoría</th>
                    <th class="fw-semibold">Stock disponible</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($products as $product)
                    @php $stock = $product->stock?->available_quantity ?? 0; @endphp
                    <tr class="transition hover-bg-light">
                        <td class="text-secondary">{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '—' }}</td>
                        <td>
                            <span class="badge px-3 py-2 rounded-pill
                                {{ $stock < 25 ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' }}">
                                <i class="bi bi-box"></i> {{ $stock }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted">No hay productos que coincidan con el filtro.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Parte Paginación -->
    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
        <div class="text-muted small">
            Mostrando {{ $products->firstItem() }} a {{ $products->lastItem() }} de {{ $products->total() }} resultados
        </div>
        <div>
            {{ $products->withQueryString()->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
