@extends('layouts.main_layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Informe de Ventas</h2>
    
    <!-- Contenedor del gráfico -->
    <canvas id="miGrafico" width="400" height="200"></canvas>
</div>

<!-- Incluir el .JS compilado por Vite-->
@vite('resources/js/informes.js')

@endsection
