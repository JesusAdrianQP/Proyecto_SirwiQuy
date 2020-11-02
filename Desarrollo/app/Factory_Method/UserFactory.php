<?php

namespace App\Factory_Method;

use InvalidArgumentException;
use App\Factory_Method\UserFactoryInterface;
use App\DataBase\UsersData\EmployeeData;
use App\DataBase\UsersData\CustomerData;
use App\DataBase\UsersData\EnterpriseData;

class UserFactory implements UserFactoryInterface
{
    public static function make($identity): UserInterface
    {
        //Switch de tipo de usuarios con identidades
        switch ($identity) 
        {
            case 'cliente':
                return new CustomerData(); //Devuelve una clase Customer
            case 'trabajador':
                return new EmployeeData(); //Devuelve una clase Employee
            case 'empresa':
                return new EnterpriseData(); //Devuelve una clase Enterprise
            default:
                throw new Exception(
                    "Error -> No se reconoce el identificador enviado"
                );
        }
    }
}