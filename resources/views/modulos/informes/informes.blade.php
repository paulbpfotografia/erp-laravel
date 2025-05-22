@extends('layouts.main_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Informe de Ventas</h2>

    <div class="container py-4">

   <!-- Encabezado -->
<div class="mb-4">
    <h4 class="mb-0">Resumen del Panel</h4>
</div>


        <!-- Filtro por año -->
        <form method="GET" action="{{ route('informes.index') }}" class="mb-4">
            <div class="row align-items-center g-2">
                <div class="col-auto">
                    <label for="year" class="form-label mb-0">Filtrar por año:</label>
                </div>
                <div class="col-auto">
                    <select name="year" id="year" class="form-select" onchange="this.form.submit()">
                        @for ($y = now()->year; $y >= 2024; $y--)
                            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </form>

        <!-- Tarjetas estadísticas -->
<div class="row justify-content-center g-4 mb-4">
    <!-- Ventas totales -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
                <h6 class="text-muted mb-2">Ventas totales</h6>
                <h4 class="mb-3">€{{ $totalSales }}</h4>
                <div class="progress">
                    <div class="progress-bar bg-primary" style="width: 75%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pedidos totales -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card stat-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-bag-fill"></i>
                    </div>
                </div>
                <h6 class="text-muted mb-2">Pedidos totales</h6>
                <h4 class="mb-3">{{ $totalOrders }}</h4>
                <div class="progress">
                    <div class="progress-bar bg-success" style="width: 65%"></div>
                </div>
            </div>
        </div>
    </div>
</div>




        <!-- Sección de gráficos -->
        <div class="row mb-4">
            <!-- Pedidos por mes -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">Pedidos por mes</h5>
                        <canvas id="miGrafico" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Productos por categoría -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">Categorías con más productos vendidos</h5>
                        <canvas id="graficoCategorias" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top 10 productos -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">Top 10 productos más vendidos</h5>
                        <div style="position: relative; height: 350px; width: 100%;">
                            <canvas id="topProductsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estado de los pedidos -->
            <div class="col-12 col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center">Estado de los pedidos</h5>
                        <div style="position: relative; height: 350px; width: 100%;">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- JS de informes -->
@vite('resources/js/informes.js')
@endsection
