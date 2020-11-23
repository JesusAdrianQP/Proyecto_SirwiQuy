<?php

namespace App\DataBase;

use Auth;
use App\Factory_Method\UserFactory;
use App\DataBase\UsersData\EmployeeData;
use App\DataBase\UsersData\CustomerData;
use App\DataBase\UsersData\EnterpriseData;
use App\Http\Controllers\MailController;

class UserDataMaster{
    public static function into_sesion($user){
        //Se crea el objeto a usar - se emplea Factory Method
        //Lo que devuelve es una clase EmployeeData() - CustomerData() - EnterpriseData()
        $user_valid = UserFactory::make($user->identity);
       
        if(filter_var($user->loger, FILTER_VALIDATE_EMAIL)){           
            $param = 1;

            if($user_valid::validationemail($user->loger)){
                if($user_valid::validationpass($param, $user->loger, $user->password))
                    return $user_valid::getUser($param, $user->loger);
                else 
                    return response()->json(['errors' => ['pass' => ['Contraseña incorrecta']]], 422);
            }
            else return response()->json(['errors' => ['mail' => ['Su correo no es válido']]], 422);
        } 
        else{
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

    public static function create_sesion($user){
        $user_new = UserFactory::make($user->identity);
        
        if($user_new::validationusername($user->username)) return response()->json(['errors' => ['username' => ['Este usuario ya esta en uso']]], 422);
            else if($user_new::validationemail($user->email)) return response()->json(['errors' => ['email' => ['Este correo ya se encuentra registrado']]], 422);
                else{
                    $user_new::register($user);
                    
                    $welcome = new MailController;
                    $success2 = $welcome->welcome($user->username, $user->email, $user->password);
                        
                    return response()->json([
                        'success1' => ['Su registro fue exitoso'],
                        'success2' => $success2
                    ], 200); 
                }
    }

    public static function getCodigo($longitud){
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
         
        return $key;
    }
}