@extends('layouts.main_layout')

@section('title', 'Historial de entradas')

@section('content')
<div class="container mt-5">

    <!-- Título -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-primary-emphasis">Entradas de stock</h2>
    </div>
    <!-- Botón de nueva entrada -->
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('logistica.almacen.entradas.crear') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Registrar entrada
    </a>
</div>

    <!-- Filtros -->
    <form method="GET" class="row g-2 align-items-end mb-4">
        <div class="col-md-4">
            <label for="product_name" class="form-label mb-0 fw-semibold">Buscar por producto</label>
            <input type="text" name="product_name" id="product_name" value="{{ request('product_name') }}"
                   class="form-control" placeholder="">
        </div>
        <div class="col-md-4">
            <label for="reason" class="form-label mb-0 fw-semibold">Filtrar por razón</label>
            <input type="text" name="reason" id="reason" value="{{ request('reason') }}"
                   class="form-control" placeholder="">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search me-1"></i> Filtrar
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('logistica.almacen.entradas') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-x-circle me-1"></i> Limpiar
            </a>
        </div>
    </form>

    <!-- Tabla -->
    <div class="table-responsive rounded shadow-sm border border-light-subtle">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-light text-uppercase small text-muted border-bottom border-2">
                <tr>
                    <th class="fw-semibold">Fecha</th>
                    <th class="fw-semibold">Producto</th>
                    <th class="fw-semibold">Cantidad</th>
                    <th class="fw-semibold">Razón</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($entradas as $entrada)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($entrada->move_date)->format('d/m/Y H:i') }}</td>
                        <td>{{ $entrada->product->name ?? '—' }}</td>
                        <td>{{ $entrada->quantity }}</td>
                        <td>{{ $entrada->reason }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted">No se han registrado entradas que coincidan con el filtro.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
        <div class="text-muted small">
            Mostrando {{ $entradas->firstItem() }} a {{ $entradas->lastItem() }} de {{ $entradas->total() }} resultados
        </div>
        <div>
            {{ $entradas->withQueryString()->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
