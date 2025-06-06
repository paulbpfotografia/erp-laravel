{{-- resources/views/modulos/clientes/show.blade.php --}}
@extends('layouts.main_layout')

@section('title', 'Detalle Cliente')

@section('content')
<div class="container mt-5">
    {{-- Panel detallado --}}
    <div class="bg-white p-4 rounded shadow-sm border border-light-subtle">

            {{-- 1) Encabezado: título + botón Volver --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary-emphasis fw-semibold mb-0">
                <i class="bi bi-eye me-2"></i> Detalle de Cliente
            </h4>
            <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>


        {{-- 2) Tabla de detalles --}}
        <div class="table-responsive">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr>
                        <th class="fw-semibold w-25">ID</th>
                        <td>{{ $customer->id }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Nombre</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">NIF</th>
                        <td>{{ $customer->nif ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Dirección</th>
                        <td>{{ $customer->address }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Teléfono</th>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Email</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Provincia</th>
                        <td>{{ $customer->province->name }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Creado</th>
                        <td>{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="fw-semibold">Modificado</th>
                        <td>{{ $customer->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Sección: Pedidos realizados --}}
        <h3 class="mt-5">Pedidos realizados</h3>

        @if($customer->orders->isEmpty())
        <div class="alert alert-info">
            Este cliente aún no ha realizado ningún pedido.
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th># Pedido</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Transportista</th>
                        <th>Total (con IVA)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer->orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->carrier?->name ?? '—' }}</td>
                        <td>{{ number_format($order->total_con_iva ?? $order->total, 2) }} €</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif


        {{-- 3) Botones de acción (Editar / Eliminar) --}}
        <div class="mt-4 d-flex gap-2">
            @can('editar clientes')
            <a href="{{ route('clientes.edit', $customer) }}"
            class="btn btn-sm btn-outline-warning rounded-pill">
                <i class="bi bi-pencil"></i> Editar
            </a>
            @endcan

            @can('eliminar clientes')
            <button type="button"
                    class="btn btn-sm btn-outline-danger rounded-pill eliminarRegistroBtn"
                    data-id="{{ $customer->id }}"
                    data-url="{{ route('clientes.destroy', $customer) }}"
                    data-entidad="Cliente">
                <i class="bi bi-trash3"></i> Eliminar
            </button>
            @endcan
        </div>

        {{-- → Grafica --}}
        <div class="row gy-4">

            <div class="col-md-6">
                <h5>Productos por categoría</h5>
                <canvas
                    id="categoriesChart"
                    data-categories='@json($categoriesData)'
                    height="200"></canvas>
            </div>
        </div>


    </div>
</div>

@endsection
{{-- Al final de la vista: cargamos el JS que inicializa ambos gráficos --}}
@push('scripts')

@endpush
