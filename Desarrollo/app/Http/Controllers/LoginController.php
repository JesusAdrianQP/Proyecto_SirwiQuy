<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetRequest;
use Illuminate\Http\Request;
use App\DataBase\UserDataMaster;

class LoginController extends Controller
{
    public function login(LoginFormRequest $request){
        if($request->identity == "manager") return UserDataMaster::openManager($request);
        else return UserDataMaster::into_sesion($request);    
    }

    public function signup(RegisterRequest $request){
        return UserDataMaster::create_sesion($request);
    }

    public function getUser(Request $request){
        return UserDataMaster::validate($request);
    }

    public function close(Request $request){
        UserDataMaster::closesesion($request);
    }

    public function reset(ResetRequest $request){
        return UserDataMaster::generatereset($request);
    }
 
    //Funcion que valida mi enlace de reseteo
    public function validatereset(Request $request)
    {
        return UserDataMaster::validateres($request);
    }
 
    //Funcion que setea mi password
    public function changepass(Request $request)
    {
        return UserDataMaster::change_pass($request);
    }
}
