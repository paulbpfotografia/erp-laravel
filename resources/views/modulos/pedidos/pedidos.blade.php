@extends('layouts.main_layout')

@section('title', 'Gestión Usuarios')

@section('content')

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <!-- Botón Registrar Usuario con margen para dar espacio -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarPedido">
                Crear Pedido
            </button>
        </div>

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
<div class="modal fade" id="modalAgregarUsuarios" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white rounded-top">
                <h4 class="modal-title" id="modalUsuariosAgregarLabel">Registro de Usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                @include('partials.formulario', [
                    'accion' => route('usuarios.registrar.store'),
                    'metodo' => 'POST',
                    'campos' => [
                        ['nombre' => 'name', 'etiqueta' => 'Nombre', 'tipo' => 'text', 'requerido' => true],
                        ['nombre' => 'email', 'etiqueta' => 'Correo Electrónico', 'tipo' => 'email', 'requerido' => true],
                        ['nombre' => 'password', 'etiqueta' => 'Contraseña', 'tipo' => 'password', 'requerido' => true],
                        ['nombre' => 'password_confirmation', 'etiqueta' => 'Confirmar Contraseña', 'tipo' => 'password', 'requerido' => true],
                        ['nombre' => 'image', 'etiqueta' => 'Foto de Perfil', 'tipo' => 'file', 'requerido' => false], 
                        ['nombre' => 'role', 'etiqueta' => 'Rol', 'tipo' => 'select', 'opciones' => $roles->pluck('name', 'name')->toArray()]
                    ],
                    'valores' => [],
                    'textoBoton' => 'Registrar Usuario'
                ])
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>









@endsection
