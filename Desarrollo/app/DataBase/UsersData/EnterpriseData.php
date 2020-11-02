<?php

namespace App\DataBase\UsersData;

use App\Factory_Method\UserInterface;
use Illuminate\Http\Response;
use App\Enterprise;
use App\Subemployee;
use Illuminate\Support\Facades\Hash;

class EnterpriseData implements UserInterface
{
    //Funcion de validacion de mail
    public static function validationemail($mail): Bool
    {
        //Se valida la existencia
        $response = Enterprise::where('email', '=', $mail)->first();
        
        if($response) return true;
        else return false;
    }

    //Funcion de validacion de nombre de usuario
    public static function validationusername($username): Bool
    {
        //Se valida la existencia
        $response = Enterprise::where('username', '=', $username)->first();
        
        if($response) return true;
        else return false;
    }

    //Funcion de validacion del password
    public static function validationpass($param, $loger, $pass): Bool
    {
        //Obtengo el usuario
        $enterprise = EnterpriseData::getUser($param, $loger); 

        //Se valida si esta correcto
        $response = Hash::check($pass, $enterprise->password);
        
        if($response) return true;
        else return false;
    }

    //Funcion de obtencion del usuario
    public static function getUser($par, $loger)
    {
        //Encuentro mi usuario
        if($par == 1) return Enterprise::where('email', '=', $loger)->first();
        else return Enterprise::where('username', '=', $loger)->first();
    }

}