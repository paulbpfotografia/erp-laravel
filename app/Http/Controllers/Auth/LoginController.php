<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
     //Redireción después de hacer login
     protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    //Como hemos creado una nueva vista para el login, sobreescribo el método para redirigir a esta nueva vista
    public function showLoginForm()
    {
        return view('modulos.usuarios.ingresar');
    }
    
    public function login(Request $request)
    {
        // Validación personalizada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Intentar autenticación con los datos del request
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            
            // Verifica si el usuario está activo antes de permitir el login
            if (!Auth::user()->active) {
                Auth::logout(); // Cierra la sesión si el usuario está inactivo
                return redirect()->back()->withErrors(['message' => 'Tu cuenta está deshabilitada. Contacte con un administrador']);
            }

            $user = User::All();
            
            return redirect('/home')->with('message', '¡Has iniciado sesión correctamente!');
        }

        // Si falla el login, volver con un error
        return redirect()->back()->withErrors(['message' => 'Las credenciales no son correctas.']);
    }


    
    
    //creamos función logout, ya que debemos sobreescribir la que viene por defecto en AuthenticateUsers para redirigir donde queremos.
    public function logout(Request $request) {
        Auth::logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message','Sesión cerrada');

    }




}
