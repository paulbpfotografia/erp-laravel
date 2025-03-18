<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    // Método para mostrar el formulario de registro. ELIMINAR SI NOS QUEDAMOS CON MODALES
    public function showRegisterForm()
    {
        $roles = Role::all(); // Aquí obtenemos todos los roles para pasarlos a la vista
        return view('modulos.usuarios.registro', compact('roles'));
    }

    // Método para registrar usuarios
    public function register(Request $request)
    {

          // Comprobamos que no se repita el correo
            if (User::where('email', $request->email)->exists()) {
                return redirect()->route('usuarios.listar')
                    ->with('message', 'Error al crear usuario. El correo ya está registrado.')
                    ->with('icono', 'error');
            }


        // VALIDACIÓN DE DATOS
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // emial único
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Usamos las reglas de validación de Rules. Consultarlas para verlas.
            'role' => ['required', 'string', 'exists:roles,name'] // el rol debe existir en la tabla roles
        ]);

        // CREACIÓN DEL USUARIO
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ASIGNAR ROL AL USUARIO
        $user->assignRole($request->role); // Asigna el rol seleccionado

        // REDIRECCIÓN CON MENSAJE DE ÉXITO
        return redirect()->route('usuarios.listar')
        ->with('message', 'Usuario registrado correctamente.')
        ->with('icono', 'success');

    }

    //Función para mostrar la vista usuarios con la lista de usuarios y roles
    public function usersList (Request $request) {

        $users = User::with('roles')->get(); //Se pasan los usuarios a la vista
        $roles = Role::all(); // Aquí obtenemos todos los roles para pasarlos a la vistaç
        //Redirijimos con el mensaje que viene desde la función de registro. P
        return view('modulos.usuarios.usuarios', compact('users', 'roles'))
        ->with('message', session('message'))
        ->with('icono', session('icono'));


    }












}
