@extends('layouts.main_layout')


@section('title', 'Home')


@section('content')






<div class="container">

    <h1 class="text-center display-4 m-5">Bienvenido al ERP, {{ $user->name }}</h1>

    

    <div class="row justify-content-center m-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="alert alert-warning fw-bold" role="alert">
                        INSTRUCCIONES PARA NUEVOS USUARIOS
                    </div>
                </div>
                

                <div class="card-body">
                    
                <p>dddddddddddddddddd</p>
                  
                </div>
                
            </div>
        </div>
    </div>
</div>





    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mi perfil</div>
                

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item fw-bold">
                            Nombre: <span class="fw-normal">{{ $user->name }}</span>
                        </li>
                        <li class="list-group-item fw-bold">
                            Correo electrónico: <span class="fw-normal">{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item fw-bold">
                            Registrado desde: <span class="fw-normal">{{ $user->created_at }}</span>
                        </li>
                       
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
