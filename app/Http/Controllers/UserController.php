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

    //Aplicamos capa de seguridad con el rol Admin.
    public function __construct()
    {
        $this->middleware('role:Admin');
    }


    // Método para registrar un usuario
    public function register(Request $request)
    {
        //Verificamos permisos
        $this->authorize('crear usuarios');

        // Comprobamos que no se repita el correo
        if (User::where('email', $request->email)->exists()) {
            return redirect()->route('usuarios.index')
                ->with('message', 'Error al crear usuario. El correo ya está registrado.')
                ->with('icono', 'error');
        }

        // Validación de datos
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048']
        ]);

        // Guardar la imagen si se ha subido
        $rutaImagen = $request->hasFile('image') 
            ? $request->file('image')->store('imagenes_usuarios', 'public') 
            : null;

        // Creación del usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $rutaImagen
        ]);

        // Asignar rol al usuario
        $user->assignRole($request->role);

        return redirect()->route('usuarios.index')
            ->with('message', 'Usuario registrado correctamente.')
            ->with('icono', 'success');
    }

    // Método para mostrar la lista de usuarios
    public function index()
    {
        $this->authorize('ver usuarios');

        $users = User::with('roles')->get(); // Carga los usuarios con sus roles
        $roles = Role::all(); // Obtiene todos los roles

        return view('modulos.usuarios.usuarios', compact('users', 'roles'))
            ->with('message', session('message'))
            ->with('icono', session('icono'));
    }

    // Método para ver un usuario en detalle
    public function show(User $user)
    {
        $this->authorize('ver usuarios');

        return view('modulos.usuarios.usuario-datos', compact('user'));
    }

    // Método para cambiar el estado activo/inactivo de un usuario
    public function changeActive(User $user)
    {
        $this->authorize('editar usuarios');

        $user->active = !$user->active;
        $user->save();

        return redirect()->back()
            ->with('message', 'El estado del usuario ha cambiado.')
            ->with('icono', 'info');
    }

    // Método para eliminar un usuario
    public function destroy(User $user)
    {
        $this->authorize('eliminar usuarios');

        $user->delete();
        return redirect()->back()
            ->with('message', 'Usuario eliminado correctamente.')
            ->with('icono', 'success');
    }

    // Método para mostrar el formulario de edición de usuario
    public function edit(User $user)
    {
        $this->authorize('editar usuarios');

        $rol = $user->getRoleNames()->first() ?? ''; // Obtiene el rol del usuario
        $roles = Role::all();

        return view('modulos.usuarios.usuarios-editar', compact('user', 'rol', 'roles'));
    }

    // Método para actualizar la información de un usuario
    public function update(Request $request, User $user)
    {
        $this->authorize('editar usuarios');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'rol' => 'required|string',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles([$request->rol]);

        return redirect()->route('usuarios.index')
            ->with('message', 'Usuario actualizado correctamente.')
            ->with('icono', 'success');
    }
}
