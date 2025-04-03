@extends('layouts.main_layout')

@section('title', 'Gestión de pedidos')

@section('content')


    <div class="box">
        @can('crear pedidos')
        <div class="box-header with-border">
            <!-- Botón Registrar Pedido -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarPedidos">
                Crear Pedido
            </button>
        </div>
        @endcan


        <div class="box-body">
            <div class="container mt-4">

                <h2 class="mb-3">Pedidos</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center align-middle">
                        <thead class="thead-light">
                            <tr class="bg-primary text-white">
                                <th class="fw-bold">ID</th>
                                <th class="fw-bold">Fecha de creación</th>
                                <th class="fw-bold">Estado</th>
                                <th class="fw-bold">Total Pedido</th>
                                <th class="fw-bold">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                    <tr>

                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td><span class="{{ clase_estado_pedido($order->status) }}">
                                            {{ ucfirst($order->status) }}
                                        </span></td>

                                        <td>{{ $order->total }}</td>


                                        <!-- Acciones -->
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                <!-- Botón Eliminar -->
                                                @can('eliminar pedidos')
                                                <button type="button"
                                                    class="btn btn-sm btn-danger eliminarRegistroBtn"
                                                    data-id="{{ $order->id }}"
                                                    data-url="{{ route('pedidos.destroy', $order->id) }}"
                                                    data-entidad="Pedido"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Eliminar pedido">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            @endcan

                                            @can('editar pedidos')
                                                <a href="{{ route('pedidos.edit', $order) }}"
                                                   class="btn btn-sm btn-warning"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="Editar pedido">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                            @endcan

                                            @can('ver pedidos')
                                                <a href="{{ route('pedidos.show', $order) }}"
                                                   class="btn btn-sm btn-primary"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="Ver detalles del pedido">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                            @endcan



                                            </div>
                                        </td>
                                    </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- Fin de tabla -->

                <hr class="my-4">
            </div>
        </div>
    </div>
</section>









@endsection
