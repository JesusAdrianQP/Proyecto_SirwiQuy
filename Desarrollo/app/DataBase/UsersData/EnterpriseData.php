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
        else return Enterprise::where('username', '=', $loger)->first();
    }

    public static function register($new_user)
    {
        $acess = new UserDataMaster();
        $enterprise = new Enterprise();
        
        $enterprise->email = $new_user->email;
        $enterprise->password = bcrypt($new_user->password);
        $enterprise->username = $new_user->username;
        $enterprise->acess = $acess->getCodigo(30);
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
}