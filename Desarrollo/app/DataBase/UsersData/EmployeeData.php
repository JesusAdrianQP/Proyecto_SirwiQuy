<?php

namespace App\DataBase\UsersData;

use App\Notifications;
use App\Service;
use App\Factory_Method\UserInterface;
use Illuminate\Http\Response;
use App\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeData implements UserInterface
{
    //Funcion de validacion de mail
    public static function validationemail($mail): Bool
    {
        //Se valida la existencia
        $response = Employee::where('email', '=', $mail)->first();
        
        if($response) return true;
        else return false;
    }

    //Funcion de validacion de nombre de usuario
    public static function validationusername($username): Bool
    {
        //Se valida la existencia
        $response = Employee::where('username', '=', $username)->first();
        
        if($response) return true;
        else return false;
    }

    //Funcion de validacion de password
    public static function validationpass($param, $loger, $pass): Bool
    {
        //Obtengo el usuario
        $worker = EmployeeData::getUser($param, $loger);    

        //Se valida si esta correcto
        $response = Hash::check($pass, $worker->password);
        
        if($response) return true;
        else return false;
    }

    //Funcion que obtiene el usuario
    public static function getUser($par, $loger)
    {
        //Encuentro mi usuario
        if($par == 1) return Employee::where('email', '=', $loger)->first();
        else return Employee::where('username', '=', $loger)->first();
    }

}