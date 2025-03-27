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



<!-- MODAL AGREGAR PEDIDO -->
<div class="modal fade" id="modalAgregarPedidos" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white rounded-top">
                <h4 class="modal-title" id="modalPedidosAgregarLabel">Registro de Pedido</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('pedidos.store') }}" method="POST">
                    @csrf

                    <!-- LISTADO DE CLIENTES -->
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Cliente</label>
                        <select name="customer_id" class="form-control" required>
                            <option value="" disabled selected>Seleccione un cliente</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ACCORDION DE CATEGORÍAS Y PRODUCTOS -->
                    <div class="accordion" id="accordionCategorias">
                        @foreach ($categories as $category)
                            @php
                                $collapseId = 'collapseCategoria' . $category->id;
                                $headingId = 'headingCategoria' . $category->id;
                            @endphp

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="{{ $headingId }}">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#{{ $collapseId }}"
                                            aria-expanded="false"
                                            aria-controls="{{ $collapseId }}">
                                        {{ $category->name }}
                                    </button>
                                </h2>

                                <div id="{{ $collapseId }}" class="accordion-collapse collapse"
                                     aria-labelledby="{{ $headingId }}" data-bs-parent="#accordionCategorias">
                                    <div class="accordion-body">
                                        @foreach ($category->products as $product)
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <!-- Checkbox para seleccionar el producto -->
                                                <input type="checkbox" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">

                                                <!-- Información del producto -->
                                                <span class="ms-2">ID {{ $product->id }} | {{ $product->name }} - ${{ $product->price }}</span>

                                                <!-- Cantidad -->
                                                <input type="number" name="products[{{ $product->id }}][quantity]"
                                                       class="form-control ms-3"
                                                       placeholder="Cantidad"
                                                       max="{{ $product->stock }}"
                                                       style="width: 120px;">

                                                <!-- Precio unitario -->
                                                <input type="hidden" name="products[{{ $product->id }}][unit_price]"
                                                       value="{{ $product->price }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón de enviar -->
                    <button type="submit" class="btn btn-primary mt-4">Crear Pedido</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>







@endsection
