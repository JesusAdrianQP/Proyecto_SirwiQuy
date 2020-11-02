<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Strategy\typeAPI;

class UserController extends Controller
{
    //Funcion que optiene datos de las apis
    public function getValidate(Request $request)
    {
        $tipo = new typeAPI; //Se instancia la clase para verificar el comportamiento
        return $tipo->execute($request);
    }
}
