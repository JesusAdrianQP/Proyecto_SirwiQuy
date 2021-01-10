<?php

namespace App\DataBase;

use App\Request;
use App\Service;
use App\Customer;
use App\Employee;
use App\Enterprise;
use App\Http\Controllers\MailController;
use App\DataBase\UserDataMaster;

class CommunicationData
{ 
    public static function request($request)
    {
        $exist = Service::find($request->id_service);

        if($exist){
            $notification = new Request();

            $notification->id_provider = $request->id_provider;
            $notification->id_service = $request->id_service;
            $notification->identity = $request->identity;
            $notification->new_lat = (float) $request->lati;
            $notification->new_lng = (float) $request->longi;
            $notification->addres = $request->exactly;
            $notification->id_customer = $request->id_customer;
            $notification->name = $request->name;
            $notification->lastnamep = $request->last_name_p;
            $notification->lastnamem = $request->last_name_m;
            $notification->age =  (int) $request->age;
            $notification->date = $request->date;
            $notification->timemin = (float) $request->timemin;
            $notification->timemax = (float) $request->timemax;
            $notification->message = $request->message;
            $notification->status = 'No respondido';
            $notification->cotizacion_personal = $request->coti_personal;
            $notification->sumaTotal = (int) $request->suma;

            $notification->save();
            
            if($request->identity == 'employee') $supplier = Employee::employee($request->id_provider)->first();
                else $supplier = Enterprise::enteprise($request->id_provider)->first();

            $message = new MailController;
            $message->message($request, $supplier->email);

            return response()->json([
                'success' => 'Su mensaje fue enviado exitosamente, espere su respuesta!',
            ], 200);            
        }
        else return response()->json(['errors' => ['fail' => ['El servicio no existe!']]], 422);
    }
}