<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\DataBase\ServiceData;

class ServiceController extends Controller
{
    //Función que llama a todos los servicios paginados
    public function serviceall(Request $request)
    {
        return ServiceData::service_list($request);
    }

    //Funcion que crea la cotización perteneciente a un servicio
    public function createprice(Request $request)
    {
        return ServiceData::register_price($request);
    }
    
    //Funcion que actualiza los datos de cotizacion de un servicio
    public function updateservice(Request $request)
    {   
        return ServiceData::update_service($request);
    }

    //Funcion que actualiza los datos de cotizacion de un servicio
    public function updateprice(Request $request)
    {   
        return ServiceData::update_price($request);
    }
}
