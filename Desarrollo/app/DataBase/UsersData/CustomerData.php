<?php

namespace App\DataBase\UsersData;

use App\Factory_Method\UserInterface;
use Illuminate\Http\Response;
use App\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerData implements UserInterface
{
    //Funcion de validacion de mail
    public static function validationemail($mail): Bool
    {
        //Se valida la existencia
        $response = Customer::where('email', '=', $mail)->first();
        
        if($response) return true;
        else return false;
    }

    //Funcion de validacion de nombre de usuario
    public static function validationusername($username): Bool
    {
        //Se valida la existencia
        $response = Customer::where('username', '=', $username)->first();
        
        if($response) return true;
        else return false;
    }

    //Funcion de validacion del password
    public static function validationpass($param, $loger, $pass): Bool
    {
        //Obtengo el usuario
        $customer = CustomerData::getUser($param, $loger); 

        //Se valida si esta correcto
        $response = Hash::check($pass, $customer->password);
        
        if($response) return true;
        else return false;
    }

    //Funcion de obtencion del usuario
    public static function getUser($par, $loger)
    {
        //Encuentro mi usuario
        if($par == 1) return Customer::where('email', '=', $loger)->first();
        else return Customer::where('username', '=', $loger)->first();
    }

}