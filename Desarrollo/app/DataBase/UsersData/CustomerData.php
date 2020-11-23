<?php

namespace App\DataBase\UsersData;

use App\Factory_Method\UserInterface;
use App\DataBase\UserDataMaster;
use Illuminate\Http\Response;
use App\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerData implements UserInterface
{
    public static function validationemail($mail): Bool{
        $response = Customer::where('email', '=', $mail)->first();
        
        if($response) return true;
        else return false;
    }

    public static function validationusername($username): Bool{
        $response = Customer::where('username', '=', $username)->first();
        
        if($response) return true;
        else return false;
    }

    public static function validationpass($param, $loger, $pass): Bool{
        $customer = CustomerData::getUser($param, $loger); 

        $response = Hash::check($pass, $customer->password);
        
        if($response) return true;
        else return false;
    }

     public static function getUser($par, $loger){
         if($par == 1) return Customer::where('email', '=', $loger)->first();
        else return Customer::where('username', '=', $loger)->first();
    }

    public static function register($new_user)
    {
        $acess = new UserDataMaster();
        $customer = new Customer();
        
        $customer->email = $new_user->email;
        $customer->password = bcrypt($new_user->password);
        $customer->username = $new_user->username;
        $customer->acess = $acess->getCodigo(30);
        
        $customer->save();
    }
}