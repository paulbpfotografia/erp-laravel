<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    


    
    
    //creamos función logout, ya que debemos sobreescribir la que viene por defecto en AuthenticateUsers para redirigir donde queremos.
    public function logout(Request $request) {
        Auth::logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message','Sesión cerrada');

    }




}
