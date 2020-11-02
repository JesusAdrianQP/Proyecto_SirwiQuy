<?php

namespace App\DataBase;

use Auth;
use App\Factory_Method\UserFactory;
use App\DataBase\UsersData\EmployeeData;
use App\DataBase\UsersData\CustomerData;
use App\DataBase\UsersData\EnterpriseData;

class UserDataMaster{
    //Funcion para entrar a la sesión
    public static function into_sesion($user)
    {
        //Se crea el objeto a usar - se emplea Factory Method
        //Lo que devuelve es una clase EmployeeData() - CustomerData() - EnterpriseData()
        $user_valid = UserFactory::make($user->identity);
       
        //Se implementa las validaciones con funciones traidas de la clase construida en fabrica
        //Se condiciona si el primer campo es tipo email o es otro tipo (username)
        if(filter_var($user->loger, FILTER_VALIDATE_EMAIL)){
            //Parametro si es mail            
            $param = 1;

            if($user_valid::validationemail($user->loger))
            {
                if($user_valid::validationpass($param, $user->loger, $user->password))
                    return $user_valid::getUser($param, $user->loger);
                else 
                    return response()->json(['errors' => ['pass' => ['Contraseña incorrecta']]], 422);
            }
            else return response()->json(['errors' => ['mail' => ['Su correo no es válido']]], 422);
        } 
        else{
            //Parametro si es nombre de usuario
            $param = 2;

            if ($user_valid::validationusername($user->loger)) 
            {
                if ($user_valid::validationpass($param, $user->loger, $user->password)) 
                    return $user_valid::getUser($param, $user->loger);
                else
                    return response()->json(['errors' => ['pass' => ['Contraseña incorrecta']]], 422);
            } 
            else return response()->json(['errors' => ['user' => ['Su usuario no es válido']]], 422);
        }
    }

    
}