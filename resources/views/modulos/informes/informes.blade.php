@extends('layouts.main_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Informe de Ventas</h2>

    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Dashboard Overview</h4>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-calendar-alt me-2"></i>This Month
                    </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Week</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4">
            <!-- Sales Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <span class="badge bg-success trend-badge">
                                    <i class="fas fa-arrow-up me-1"></i>12.5%
                                </span>
                        </div>
                        <h6 class="text-muted mb-2">Total Sales</h6>
                        <h4 class="mb-3">$24,589</h4>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stat-icon bg-success bg-opacity-10 text-success">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="badge bg-danger trend-badge">
                                    <i class="fas fa-arrow-down me-1"></i>5.2%
                                </span>
                        </div>
                        <h6 class="text-muted mb-2">Active Users</h6>
                        <h4 class="mb-3">14,789</h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                <i class="fas fa-box"></i>
                            </div>
                            <span class="badge bg-success trend-badge">
                                    <i class="fas fa-arrow-up me-1"></i>8.4%
                                </span>
                        </div>
                        <h6 class="text-muted mb-2">New Orders</h6>
                        <h4 class="mb-3">1,589</h4>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card stat-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="stat-icon bg-info bg-opacity-10 text-info">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <span class="badge bg-success trend-badge">
                                    <i class="fas fa-arrow-up me-1"></i>15.7%
                                </span>
                        </div>
                        <h6 class="text-muted mb-2">Revenue</h6>
                        <h4 class="mb-3">$45,289</h4>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">Recent Activity</h5>
                            <button class="btn btn-light btn-sm">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item border-0 d-flex align-items-center px-0">
                                <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">New order received</h6>
                                    <p class="text-muted small mb-0">Order #123456 from John Doe</p>
                                </div>
                                <small class="text-muted">Just now</small>
                            </div>
                            <div class="list-group-item border-0 d-flex align-items-center px-0">
                                <div class="avatar-sm bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-user-plus text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">New user registered</h6>
                                    <p class="text-muted small mb-0">User ID: #987654</p>
                                </div>
                                <small class="text-muted">2 min ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Contenedor del gráfico -->
    <canvas id="miGrafico" width="400" height="200"></canvas>
</div>


<!-- Incluir el .JS compilado por Vite-->
@vite('resources/js/informes.js')

@endsection
