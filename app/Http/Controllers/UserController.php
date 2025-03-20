<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
            // Método para mostrar el formulario de registro. ELIMINAR SI NOS QUEDAMOS CON MODALES
            public function register(Request $request)
            {
                // Comprobamos que no se repita el correo
                if (User::where('email', $request->email)->exists()) {
                    return redirect()->route('usuarios.index')
                        ->with('message', 'Error al crear usuario. El correo ya está registrado.')
                        ->with('icono', 'error');
                }
            
                // VALIDACIÓN DE DATOS
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Email único
                    'password' => ['required', 'confirmed', Rules\Password::defaults()], // Contraseña segura
                    'role' => ['required', 'string', 'exists:roles,name'], // El rol debe existir en la tabla roles
                    'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'] // Validación para la imagen
                ]);
            
                // GUARDAR LA IMAGEN SI SE HA SUBIDO
                if ($request->hasFile('image')) {
                    $rutaImagen = $request->file('image')->store('imagenes_usuarios', 'public'); 
                } else {
                    $rutaImagen = null;
                }
            
                // CREACIÓN DEL USUARIO
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'image' => $rutaImagen
                ]);
            
                // ASIGNAR ROL AL USUARIO
                $user->assignRole($request->role); // Asigna el rol que se selecciona
            
                // REDIRECCIÓN CON MENSAJE DE ÉXITO
                return redirect()->route('usuarios.index')
                    ->with('message', 'Usuario registrado correctamente.')
                    ->with('icono', 'success');
            }



    //Función para mostrar la vista usuarios con la lista de usuarios y roles
    public function index (Request $request) {

        $users = User::with('roles')->get(); //Se pasan los usuarios a la vista
        $roles = Role::all(); // Aquí obtenemos todos los roles para pasarlos a la vistaç
        //Redirijimos con el mensaje que viene desde la función de registro. P
        return view('modulos.usuarios.usuarios', compact('users', 'roles'))
        ->with('message', session('message'))
        ->with('icono', session('icono'));


    }



    public function show ($id) {

        $user = User::findOrFail($id);
        return view('modulos.usuarios.usuario-datos', compact('user'));

    }



    //Función para actualizar el estado booleano de la columna active del usuario
    public function changeActive ($id) {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();

        return redirect()->back()
        ->with('message', 'El estado del usuario ha cambiado.')
        ->with('icono', 'info');	

    }


    //Borra al usuario
    public function destroy ($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()
        ->with('message', 'Usuario eliminado correctamente.')
        ->with('icono', 'success');

    }


    //Devuelve la vista para la edición de usuario con los datos del usuario y los roles para el desplegable
    public function showEditForm ($id) {

        $user = User::findOrFail($id);
        $rol = $user->getRoleNames()->first() ?? ``; //Envio el rol con el usuario.
        $roles = Role::all();
        return view('modulos.usuarios.usuarios-editar', compact('user', 'rol', 'roles'));

    }


    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'rol' => 'required|string',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    
        $user->syncRoles([$request->rol]);
    
        return redirect()->route('usuarios.index')->with('message', 'Usuario actualizado correctamente.');
    }
    
        
}