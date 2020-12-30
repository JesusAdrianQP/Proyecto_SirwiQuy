<?php

namespace App\DataBase;

use App\Service;
use App\Price;
use App\DataBase\UserDataMaster;
use App\Http\Controllers\MailController;

class ServiceData
{ 
    //Función que lista todos los servicios
    public static function service_list($new_page)
    {
        $pmin = (int) $new_page->pmin;
        $pmax = (int) $new_page->pmax;

        $services = Service::title($new_page->title)
                    ->localizacion($new_page->district)
                    ->category($new_page->category)
                    ->pmin($pmin)
                    ->pmax($pmax)
                    ->calificacion($new_page->value)
                    ->paginate(6, ['*'], 'services', $new_page->page);
        
        return response()->json([
            'paginate' => $services
        ]);
    }

    public static function listid($id){
        $services_id = Service::where('token', '=', $id->ide)->get();

        return response()->json([
            'servicios' => $services_id
        ]);
    }
    
    public static function listiddetails($id){
        $services_id = Service::where('_id', '=', $id->service_id)->get();

        return response()->json([
            'serv_details' => $services_id
        ]);
    }

    //Funcion que trae los detalles de la estimacion de precios del servicio
    public static function pridetails($id)
    {
        $exist = Price::where('id_service', '=', $id->service_id)->first();

        if($exist){
            return response()->json([
                'pri_details' => $exist
            ], 200);
        }
        else return response()->json(['errors' => ['fail' => ['Cotización no encontrada!']]], 422);
    }

    public static function register($new_service){
        //Verifico que mi usuario no haya publicado más de 3 anuncios
        if(Service::where('token', '=', $new_service->id)->count()<3){
            //Se crea una nueva colección
            $service = new Service();

            //Guardo los datos en mi colección
            $service->identity = $new_service->level;
            $service->token = $new_service->id; /*Codigo del proveedor*/
            $service->title = $new_service->title;
            $service->description = $new_service->description;
            $service->category = $new_service->category;
            $service->distrito = $new_service->district;
            $service->calificacion = 0;
            $service->precio = (int) $new_service->price;
            $service->file = $new_service->photo;

            $service->save();

            ServiceData::register_price($service->_id, $new_service->price, $new_service->materials);

            return response()->json([
                'success' => 'Su servicio ha sido creado',
                //'pmin' => $service->precioMin,
                //'pmax' => $service->precioMax
            ], 200);
        }
        else return response()->json(['errors' => ['fail' => ['No se puede tener más de 3 servicios activos']]], 422);
    }

    public static function register_price($id_service, $pricemdo, $mat){
        $price = new Price();

        $price->price_mdo = $pricemdo;
        $price->materials = $mat;
        $price->id_service = $id_service;

        $price->save();
    }

    //Funcion de actualizacion de datos de servicio
    public static function update_service($new_service)
    {
        //Encuentro mis datos de servicio
        $service = Service::where('_id', '=', $new_service->id_service)->first();
 
        // Si existe
        if($service){
            //Seteamos
            $service->title = $new_service->title;
            $service->description = $new_service->description;
            $service->category = $new_service->category;
            $service->departamento = $new_service->department;
            $service->provincia = $new_service->province;
            $service->distrito= $new_service->district;
            $service->precioMin= $new_service->min_price;
            $service->precioMax= $new_service->max_price;
            $service->file= $new_service->photo;

            // Guardamos en base de datos
            $service->save();

            return response()->json(['success' => ['Cambios guardados']], 200);
        }else return response()->json(['errors' => ['fail' => ['Hubo un error de conexión ... Intente más tarde']]], 422);
    }

    //Funcion de actualizacion de cotización de servicio
    public static function update_price($new_price)
    {
        //Encuentro mi cotizacion de servicio
        $price = Price::where('id_service', '=', $new_price->id_service)->first();
 
        //Actualizamos el precio maximo solo si es necesario
        if($new_price->pmax != 0)
        {
            $service = Service::find($new_price->id_service); //Encontramos el servicio
            $service->precioMax = (int) $new_price->pmax; //Actualizamos
            $service->save(); //Guardamos
        } 

        // Si existe
        if($price){
            //Seteamos
            $price->price_mdo = $new_price->laboral;
            $price->materials = $new_price->materials;
            $price->id_service = $new_price->id_service;

            // Guardamos en base de datos
            $price->save();

            return response()->json(['success' => ['Cambios guardados']], 200);
        }else return response()->json(['errors' => ['fail' => ['Hubo un error de conexión ... Intente más tarde']]], 422);
    }

    
//Función que borra una notificacion
public static function delete_request($not)
{
    $exist = Request::find($not->id); //Encuentro la solicitud

    if($exist){
        if($not->status == 'No respondido'){
            //Configuro mis datos a devolver
            $value_service = Service::servicesupplier($exist->id_service)->first();
            $customer = Customer::where('_id', '=', $exist->id_customer)->first();

            $exist->delete(); //Borro la solicitud

            //Envio un mensaje al cliente que su solicitud ha sido rechazada
            $message = new MailController;
            $message->message_deny($value_service, $customer, $not->date);

            return response()->json([
                'info' => 'La solicitud fue eliminada con éxito'
            ], 200);
        }
        else{
            $exist->delete(); //Borro la solicitud
            
            return response()->json([
                'info' => 'La solicitud fue eliminada con éxito',
            ], 200);
        }
    }
    else return response()->json(['errors' => ['fail' => ['La solicitud no existe!']]], 422) ;       
}


//Función que trae todos mis notificaciones (solicitudes) correspondientes a mi proveedor
public static function list_not($request)
{
    //Traigo mis servicios correspondientes, solo requiero las id's
    $num_services = Service::listsupplier($request->id)->get();
    $array_services = [];
    //Guardo en un array todas las id's obtenidas
    for($i = 0; $i < count($num_services); $i++){
        $array_services[$i] = $num_services[$i]->_id;
    }
    //Selecciono todas mis solicitudes correspondidas a esa id
    $request = Request::whereIn('id_service', $array_services)
                        ->orderBy('created_at', 'DESC')
                        ->statusnot($request->filter)
                        ->paginate(5, ['*'], 'requests', $request->page);

    return response()->json([
        'paginate' => $request
    ], 200);
}

//Función que trae los detalles de mis notificaciones (solicitudes)
public static function notdetails($id)
{
    //Encontramos los detalles de la solicitud
    $request = Request::find($id->id); 

    if($request){
        //Encuentro mi servicio correspondiente
        $service = ServiceData::servdetails($request->id_service, 2);
        //Encuentro a quién pertenece mi solicitud
        $customer = Customer::where('_id', '=', $request->id_customer)->first();

        return response()->json([
            'request_details' => $request,
            'service_details' => $service,
            'customer_details' => $customer
        ], 200);
    }
    else return response()->json(['errors' => ['fail' => ['Solicitud no encontrada!']]], 422);
}

}
