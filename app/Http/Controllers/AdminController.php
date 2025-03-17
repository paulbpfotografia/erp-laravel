<?php

namespace App\Http\Controllers;

use App\Models\User; // Importa el modelo User
use Illuminate\Http\Request; // Importa la clase Request para manejar formularios
use Illuminate\Support\Facades\Hash; // Importa Hash para cifrar contraseñas
use Illuminate\Validation\Rules; // Importa reglas de validación para la contraseña
use Spatie\Permission\Models\Role; // Importa Role para asignar roles a usuarios


class AdminController extends Controller
{
    // Método para mostrar el formulario de registro
    public function showRegisterForm()
    {
        $roles = Role::all(); // Aquí obtenemos todos los roles para pasarlos a la vista
        return view('modulos.admin.registro', compact('roles'));
    }

    // Método para registrar usuarios
    public function register(Request $request)
    {
        // VALIDACIÓN DE DATOS
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // emial único
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // la contraseña debe confirmarse
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
        return redirect()->route('admin.registrar')->with('success', 'Usuario registrado correctamente.');
    }


    //Función para mostrar la vista usuarios con la lista de usuarios y roles
    public function usersList (Request $reques) {

        $users = User::all();

        return view ('modulos.admin.usuarios',compact('users'));

    }



}
