@extends('layouts.main_layout')

@section('title', 'Iniciar sesión')




@section('content')


<h1 class="title">HAY QUE CRUZAR TABLAS PARA SACAR EL ROL </h1>

<div class="container">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user )

                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                  <td>{{ $user->roles->first()->name}}</td> {{-- Recuperamos el rol, que lo hemos traido previamente usando HasRoles en el modelo user y en la función UserList --}}
                                                            {{-- Lo que hacemos es acceder a la tabla pivot, y extraer el primer nombre de la colección. En caso de ser varios
                                                            podríamos usar pluck. --}}

                </tr>

                @endforeach



            </tbody>
        </table>
    </div>
</div>


@endsection
