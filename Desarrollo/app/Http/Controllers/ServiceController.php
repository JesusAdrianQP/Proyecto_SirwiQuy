<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\DataBase\ServiceData;

class ServiceController extends Controller
{
    public function serviceall(Request $request){
        return ServiceData::service_list($request);
    }

    public function createservice(Request $request){
        return ServiceData::register($request); 
    }
    
    public function serviceid(Request $request){
        return ServiceData::listid($request);
    }

    public function serviceiddetails(Request $request){
        return ServiceData::listiddetails($request);
    }

    public function pricesdetails(Request $request) 
    {
        return ServiceData::pridetails($request);
    }
    
    public function updateservice(Request $request)
    {   
        return ServiceData::update_service($request);
    }

    public function updateprice(Request $request)
    {   
        return ServiceData::update_price($request);
    }

    //Función que lista todas las notificaciones de mi trabajador
    public function notifications_id(Request $request)
    {
        return ServiceData::list_not($request);
    }


    //Función que trae los detalles de mis solicitudes
    public function notificationsdetails(Request $request)
    {
        return ServiceData::notdetails($request);
    }

    //Función que borra una solicitud específica cuando no se requiere (sea respondida o no respondida)
    public function deleterequests(Request $request)
    {
        return ServiceData::delete_request($request);
    }
   
}
