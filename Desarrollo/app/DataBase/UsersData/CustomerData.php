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
            else if($par == 2) return Customer::where('username', '=', $loger)->first();
                else return Customer::where('access', '=', $loger)->first();
    }

    public static function getToken($par, $loger){
        $token = CustomerData::getUser($par, $loger);

        return $token->access;
    }

    public static function register($new_user){
        $access = new UserDataMaster();
        $customer = new Customer();
        
        $customer->email = $new_user->email;
        $customer->password = bcrypt($new_user->password);
        $customer->username = $new_user->username;
        $customer->access = $access->getCodigo(30);
        
        $customer->save();
    }

    public static function updatetoken($token){
        $access = new UserDataMaster();
        $user = CustomerData::getUser(3, $token);

        if($user){
            $user->access = $access->getCodigo(30);
            $user->save();
        }
    }

    public static function update($user){
        $customer = CustomerData::getUser(3, $user->token);
 
        if($customer){
            $customer->DNI = $user->dni;
            $customer->edad = $user->age;
            $customer->file = $user->photo;
            $customer->name = $user->first_name;
            $customer->lastnamep = $user->last_name_p;
            $customer->lastnamem = $user->last_name_m;
            $customer->departamento = $user->department;
            $customer->provincia = $user->province;
            $customer->distrito = $user->district;
            $customer->adress = $user->address;
 
            $customer->save();

            return response()->json(['success' => ['Cambios guardados']], 200);
        }else return response()->json(['errors' => ['fail' => ['Hubo un error de conexión ... Intente más tarde']]], 422);
    }
}