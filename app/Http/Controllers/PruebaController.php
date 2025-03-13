<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{

    //UNA FORMA DE PROTEGER RUTAS Y CONTROLADORES
    public function __construct()
    {
        $this->middleware('auth');
    }


    // public function index()
    // {
    //     return view('index'); // PARA PROBAR MENÚ
    // }

    // public function producto()
    // {
    //     return view('producto'); // PARA PROBAR MENÚ
    // }

    // public function cliente()
    // {
    //     return view('cliente'); // PARA PROBAR MENÚ
    // }

    // public function pedido()
    // {
    //     return view('pedido'); // PARA PROBAR MENÚ
    // }

}
