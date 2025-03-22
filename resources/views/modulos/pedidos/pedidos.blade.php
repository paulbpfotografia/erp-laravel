@extends('layouts.main_layout')

@section('title', 'Gestión de pedidos')

@section('content')

<section class="content">
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
                                            <?php
                                            $estado='';
                                            ?>
                                        @if ($order->status == 'enviado')
                                                <?php
                                                $estado='badge bg-info';
                                                ?>
                                        @elseif ($order->status == 'pendiente')
                                                <?php
                                                $estado='badge bg-danger';
                                                ?>
                                        @elseif ($order->status == 'preparado')
                                                <?php
                                                $estado='badge bg-warning';
                                                ?>
                                        @else
                                                <?php
                                                $estado='badge bg-success';
                                                ?>
                                        @endif
                                        <td><span class="{{ $estado }}">{{ $order->status }}</span></td>
                                        <td>{{ $order->total }}</td>


                                        <!-- Acciones -->
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                
                                                <!-- Botón Eliminar -->
                                                @can('eliminar pedidos')
                                                <button type="button" class="btn btn-sm btn-danger eliminarRegistroBtn"
                                                    data-id="{{ $order->id }}"
                                                    data-url="{{ route('pedidos.destroy', $order->id) }}"
                                                    data-entidad="Pedido">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>    
                                                @endcan
                                                

                                                <!-- Botón Editar -->
                                                @can('editar pedidos')
                                                <a href="{{ route( 'pedidos.edit',$order) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>     
                                                @endcan
                                               

                                                <!-- Botón Ver Usuario -->
                                                @can('ver pedidos')
                                                <a href="{{ route('pedidos.show', $order) }}" class="btn btn-sm btn-primary">
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
                <h4 class="modal-title" id="modalPedidosAgregarLabel">Registro de Usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form action="{{ route('pedidos.store') }}" method="POST">
                    @csrf
                
                    <!-- LISTAD DE CLIENTES -->
                    <label for="customer_id">Cliente</label>
                    <select name="customer_id" class="form-control" required>
                        <option value="" disabled selected>Seleccione un cliente</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>

                    <div class="accordion" id="accordionCategorias">
                        @foreach ($categories as $category)
                            @php
                            //Identificamos dinamicamente los ID para poder colapsar los accordion de 1 en 1.
                                $collapseId = 'collapseCategoria' . $category->id;
                                $headingId = 'headingCategoria' . $category->id;
                            @endphp

                            {{-- Creamos el accordion de cada categoría --}}

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

                                     {{-- Para cada categoria - accordion, le ponemos todos los productos que pertenecen a esa categoría para poder seleccionar cantidad y producto --}}

                                    <div class="accordion-body">
                                        @foreach ($category->products as $product)
                                            <div class="form-group d-flex align-items-center mb-2">
                                                <input type="checkbox" name="productos[]" value="{{ $product->id }}">
                                                <span class="ms-2">ID {{ $product->id }} | {{ $product->name }} - ${{ $product->price }}</span>
                                                <input type="number" name="cantidades[{{ $product->id }},{{ $product->price }}]"
                                                       class="form-control ms-3" placeholder="Cantidad" max="{{ $product->stock }}" style="width: 300px;">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                   
                    <button type="submit" class="btn btn-primary mt-3">Crear Pedido</button>
                </form>
                

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>









@endsection
