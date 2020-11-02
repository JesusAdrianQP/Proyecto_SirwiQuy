<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use App\DataBase\UserDataMaster;

class LoginController extends Controller
{
    //Funcion que recibe credenciales para el acceso a la sesión correspondiente
    public function login(LoginFormRequest $request)
    {
        return UserDataMaster::into_sesion($request);    
    }

}
