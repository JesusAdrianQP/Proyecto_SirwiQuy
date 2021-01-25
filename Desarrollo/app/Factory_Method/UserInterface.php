<?php

namespace App\Factory_Method;

use Illuminate\Http\Response;

interface UserInterface
{
    public static function validationemail($parameter): Bool;

    public static function validationusername($parameter): Bool;

    public static function validationpass($parameter1, $parameter2, $parameter3): Bool;

    public static function getUser($parameter1, $parameter2);

    public static function getToken($parameter1, $parameter2);

    public static function register($parameter);

    public static function list_details_email($parameter, $par2); 
    
    public static function validationreset($parameter);
}