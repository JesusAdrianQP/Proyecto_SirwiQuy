<?php

namespace App\DataBase\UsersData;

use App\Factory_Method\UserInterface;
use App\DataBase\UserDataMaster;
use Illuminate\Http\Response;
use App\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeData implements UserInterface
{
    public static function validationemail($mail): Bool{
        $response = Employee::where('email', '=', $mail)->first();
        
        if($response) return true;
        else return false;
    }

    public static function validationusername($username): Bool{
        $response = Employee::where('username', '=', $username)->first();
        
        if($response) return true;
        else return false;
    }

    public static function validationpass($param, $loger, $pass): Bool{
        $worker = EmployeeData::getUser($param, $loger);    

        $response = Hash::check($pass, $worker->password);
        
        if($response) return true;
        else return false;
    }

    public static function getUser($par, $loger){
        if($par == 1) return Employee::where('email', '=', $loger)->first();
        else return Employee::where('username', '=', $loger)->first();
    }

    public static function register($new_user)
    {
        $acess = new UserDataMaster();
        $employee = new Employee();
        
        $employee->email = $new_user->email;
        $employee->password = bcrypt($new_user->password);
        $employee->username = $new_user->username;
        $employee->acess = $acess->getCodigo(30);

        $employee->save();
    }
}