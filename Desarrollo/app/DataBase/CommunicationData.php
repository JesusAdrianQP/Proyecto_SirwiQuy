<?php

namespace App\DataBase;

use App\Request;
use App\Response;
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
            $notification->timemin = $request->timemin;
            $notification->timemax = $request->timemax;
            $notification->message = $request->message;
            $notification->status = 'No respondido';
            $notification->cotizacion_personal = $request->coti_personal;
            $notification->sumaTotal = (float) $request->suma;

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

    public static function list_not($request)
    {
        $request = Request::where('id_provider', $request->id)
                            ->orderBy('created_at', 'DESC')
                            ->statusnot($request->filter)
                            ->paginate(5, ['*'], 'requests', $request->page);

        return response()->json([
            'paginate' => $request
        ], 200);
    }

    public static function delete_request($not)
    {
        $exist = Request::find($not->id);

        if($exist){
            $service = Service::where('_id', '=', $exist->id_service)->first();
            $customer = Customer::where('_id', '=', $exist->id_customer)->first();

            if($not->status == 'No respondido')
            {
                $exist->delete();

                $message = new MailController;
                $message->message_deny($service, $customer, $not->date);

                return response()->json([
                    'info' => 'La solicitud fue eliminada con éxito'
                ], 200);
            }
            if($not->status == 'En proceso')
            {
                /**No borra solicitud - la mantiene pero negada */
                $message = new MailController;
                $message->message_deny($service, $customer, $not->date);

                return response()->json(['success' => ['Respuesta enviada exitosamente']], 200);   
            }
            else{
                $exist->delete();

                return response()->json([
                    'info' => 'La solicitud fue eliminada con éxito',
                ], 200);
            }
        }
        else return response()->json(['errors' => ['fail' => ['La solicitud no existe!']]], 422) ;       
    }

    public static function notiddetails($request){
        $request_id = Request::where('_id', '=', $request->notification_id)->first();

        if($request_id)
        {
            $service = Service::where('_id', '=', $request_id->id_service)->first();
            $customer = Customer::where('_id', '=', $request_id->id_customer)->first();
    
            return response()->json([
                'request_details' => $request_id,
                'service_details' => $service,
                'customer_details' => $customer
            ], 200);
        }
        else return response()->json(['errors' => ['fail' => ['Solicitud no encontrada!']]], 422);
    }

    //Funcion que sige el progreso de tu estado
    public static function status($statu)
    {
        if($statu->typeNot == 'request'){
            $request = Request::find($statu->id);
  
            if($request){
                $request->status = $statu->status;
  
                $request->save();
  
                return response()->json(['success' => ['Estado actualizado']], 200);
            }
            else return response()->json(['errors' => ['fail' => ['Hubo un error de conexión ... Intente más tarde']]], 422);
        }
        else if($statu->typeNot == 'response'){
            $response = Response::find($statu->id);
  
            if($response){
                $response->status = $statu->status;
                
                if($statu->status == 'Pendiente'){
                    $response->linkPayPal = '';

                    $message = new MailController;
                    $message->message_pay($statu->email1, $statu->email2, $statu->pay);
                }
                else if($statu->status == 'Completado'){
                    $response->status = 'Completado';
                }
                else if($statu->status == 'No completado'){
                    $response->status = 'No completado';
                }
                  
                $response->save();
  
                return response()->json(['success' => ['Estado actualizado']], 200);
            }
            else return response()->json(['errors' => ['fail' => ['Hubo un error de conexión ... Intente más tarde']]], 422);
        }
    }

    public static function acept_request($info)
    {
        $exist = Service::find($info->id_service);
        $access = new UserDataMaster();

        if($exist){
            $response = new Response();
            
            $response->id_provider = $info->id_provider;
            $response->id_service = $info->id_service;
            $response->identity = $info->identity;
            $response->new_lat = (float) $info->lat;
            $response->new_lng = (float) $info->long;
            $response->addres = $info->adress;
            $response->id_customer = $info->id_customer;
            $response->name = $info->name;
            $response->lastnamep = $info->lastnamep;
            $response->lastnamem = $info->lastnamem;
            $response->age =  (int) $info->age;
            $response->date = $info->date;
            $response->timemin = $info->timemin;
            $response->timemax = $info->timemax;
            $response->message = $info->message;
            $response->status = 'Por pagar';
            $response->cotizacion_personal = $info->cotizacion;
            $response->sumaTotal = (float) $info->sumtotal;
            $response->work = (float) $info->work;
            $response->linkPayPal = $access->getCodigo(50);

            $response->save();

            $customer = Customer::where('_id', '=', $info->id_customer)->first();

            $message = new MailController;
            $message->message_acept($response, $customer->email);

            return response()->json(['success' => ['Respuesta enviada exitosamente']], 200);          
        }
        else return response()->json(['errors' => ['fail' => ['El servicio no existe!']]], 422);
    }

    public static function response_details($value)
    {
        $response = Response::find($value->id_response); 
 
        if($response && $response->linkPayPal==$value->linkPaypal)
        {
            $service = Service::find($response->id_service);
            $customer = Customer::find($response->id_customer);

            if($response->identity == 'employee') $supplier = Employee::find($response->id_provider);
              else $supplier = Enterprise::find($response->id_provider);

            return response()->json([
                'response' => $response,
                'service' => $service,
                'supplier' => $supplier,
                'customer' => $customer
            ], 200);
        }
        else return response()->json(['errors' => ['fail' => ['Respuesta no encontrada!']]], 422);
    }

    public static function listResponse($value)
    {
        $response = Response::where('id_customer', '=', $value->id)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(8, ['*'], 'requests', $value->page);

        return response()->json([
            'paginate' => $response
        ], 200);
    }
}