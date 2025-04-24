@extends('layouts.main_layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Pedido</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('pedidos.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Fecha --}}
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha del pedido</label>
            <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror"
                   value="{{ old('fecha', $order->fecha) }}">
            @error('fecha')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Estado --}}
        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                <option value="pendiente" {{ old('status', $order->status) === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="preparado" {{ old('status', $order->status) === 'preparado' ? 'selected' : '' }}>Preparado</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>
@endsection
