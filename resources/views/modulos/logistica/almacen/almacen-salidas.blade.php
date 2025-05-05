@extends('layouts.main_layout')

@section('title', 'Salidas de stock')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-semibold text-primary-emphasis">Listado de salidas de stock</h2>

    {{-- Formulario de filtros --}}
    <form method="GET" class="row g-2 align-items-end mb-4">
        <div class="col-md-4">
            <label for="product_id" class="form-label mb-0 fw-semibold">Filtrar por producto</label>
            <select name="product_id" id="product_id" class="form-select">
                <option value="">Todos</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="fecha" class="form-label mb-0 fw-semibold">Filtrar por fecha</label>
            <input type="date" name="fecha" id="fecha" value="{{ request('fecha') }}" class="form-control">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search me-1"></i> Filtrar
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('logistica.almacen.salidas') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-x-circle me-1"></i> Limpiar
            </a>
        </div>
    </form>

    {{-- Tabla de resultados --}}
    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Motivo</th>
                    <th class="text-end">Pedido asociado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($salidas as $salida)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($salida->move_date)->format('d/m/Y H:i') }}</td>
                        <td>{{ $salida->product->name ?? 'Producto eliminado' }}</td>
                        <td>{{ $salida->quantity }}</td>
                        <td>{{ $salida->reason }}</td>
                        <td class="text-end">
                            @if ($salida->order_id)
                                <a href="{{ route('pedidos.show', $salida->order_id) }}" class="btn btn-sm btn-outline-primary">
                                    Pedido #{{ $salida->order_id }}
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">No se encontraron salidas con los filtros aplicados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-3">
        {{ $salidas->links() }}
    </div>
</div>
@endsection
