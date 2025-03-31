@extends('layouts.main_layout')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-4 text-center" style="width: 35rem;">
        <div class="card-header bg-primary text-white p-2">
            <h4 class="mb-0">Detalles del Usuario</h4>
        </div>
        <div class="card-body p-3">

          
            <!-- Datos del usuario -->
            <div class="text-center">
                <p><strong>ID:</strong> <span class="text-muted">{{ $order->id }}</span></p>
                <p><strong>Nombre:</strong> <span class="text-muted">{{ $order->date }}</span></p>
                <p><strong>Correo Electrónico:</strong> <span class="text-muted">{{ $order->customer_id }}</span></p>
                <p><strong>Rol:</strong> <span class="text-muted">{{ $order->order_date}}</span></p>
                <p><strong>Estado:</strong>
                    <span class="text-muted">{{ $order->order_date}}</span>
                    {{-- <span class="{{ $user->active ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                        {{ $user->active ? 'Activo' : 'Inactivo' }}
                    </span> --}}
                </p>
            </div>

            <!-- Botón para cambiar el estado del usuario -->
            {{-- <form action="{{ route('usuarios.changeActive', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                @can('activar usuarios')
                <button type="submit" class="btn btn-{{ $user->active ? 'danger' : 'success' }} btn-sm">
                    {{ $user->active ? 'Deshabilitar' : 'Habilitar' }}
                </button>
                @endcan
            </form> --}}
        </div>
        <div class="card-footer text-center p-2">
            <a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>



@endsection
