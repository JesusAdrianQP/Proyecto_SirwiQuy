<?php

namespace App\DataBase\UsersData;

use App\Factory_Method\UserInterface;
use App\DataBase\UserDataMaster;
use Illuminate\Http\Response;
use App\Enterprise;
use Illuminate\Support\Facades\Hash;

class EnterpriseData implements UserInterface
{
    public static function validationemail($mail): Bool{
       $response = Enterprise::where('email', '=', $mail)->first();
        
        if($response) return true;
        else return false;
    }

    public static function validationusername($username): Bool{
       $response = Enterprise::where('username', '=', $username)->first();
        
        if($response) return true;
        else return false;
    }

    public static function validationpass($param, $loger, $pass): Bool{
        $enterprise = EnterpriseData::getUser($param, $loger);

        $response = Hash::check($pass, $enterprise->password);
        
        if($response) return true;
        else return false;
    }

    public static function getUser($par, $loger){
        if($par == 1) return Enterprise::where('email', '=', $loger)->first();
            else if($par == 2) return Enterprise::where('username', '=', $loger)->first();
            else if($par == 3) return Enterprise::where('_id', '=', $loger)->first();
                else return Enterprise::where('access', '=', $loger)->first();
    }

    public static function getToken($par, $loger){
        $token = EnterpriseData::getUser($par, $loger);

        return $token->access;
    }

    public static function register($new_user){
        $access = new UserDataMaster();
        $enterprise = new Enterprise();
        
        $enterprise->email = $new_user->email;
        $enterprise->password = bcrypt($new_user->password);
        $enterprise->username = $new_user->username;
        $enterprise->access = $access->getCodigo(30);
        $enterprise->society = $new_user->name_enterprise;
        $enterprise->RUC = $new_user->RUC;
        $enterprise->file_enterprise = $new_user->file_enterprise;
        $enterprise->cuenta = $new_user->cuenta_enterprise;
        $enterprise->file = $new_user->file_admi;
        $enterprise->name = $new_user->name_admi;
        $enterprise->lastnamep = $new_user->lastnamep_admi;
        $enterprise->lastnamem = $new_user->lastnamem_admi;
        $enterprise->DNI = $new_user->DNI;
        /*Notacion empresa posee más detalles owo*/
        $enterprise->save();
    }

    public static function updatetoken($token){
        $access = new UserDataMaster();
        $user = EnterpriseData::getUser(3, $token);

        if($user){
            $user->access = $access->getCodigo(30);
            $user->save();
        }
    }

     //Se actualiza el password del usuario
     public static function updatepass($user)
     {
         $enterprise = Enterprise::where('email', '=', $user->email)
                                   ->where('RUC', '=', $user->ruc)
                                   ->first();
  
         if($enterprise){
             $enterprise->password = bcrypt($user->password);
             $enterprise->recover = null;
             // Guardamos cambios
             $enterprise->save();
  
             return response()->json(['success' => ['Contraseña actualizada']], 200);
         }
         else return response()->json(['errors' => ['fail' => ['Empresa no encontrada, chequee sus datos porfavor!']]], 422);
     }

    public static function update($user){}

    //Funcion de listado con email
    public static function list_details_email($enterprise, $cod_reset)
    {
        $enter = Enterprise::where('email', '=', $enterprise)->first();
        $enter->recover = $cod_reset;
        $enter->save();

        return $enter;
    }

    //Funcion que valida mi enlace
    public static function validationreset($enterprise){
        if(Enterprise::where('recover', '=', $enterprise)->first()) return 0;
            else return 1;
    }
}