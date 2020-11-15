<?php

namespace App\DataBase;

use App\Service;
use App\Price;
use App\Http\Controllers\MailController;

class ServiceData
{ 
    //Función que lista todos los servicios
    public static function service_list($new_page)
    {
        $services = Service::paginate(4, ['*'], 'services', $new_page->page);
        
        return response()->json([
            'paginate' => $services
        ]);
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

    //Funcion de una cotización nueva perteneciente a un servicio
    public static function register_price($new_price)
    {
        //Actualizamos el precio maximo solo si es necesario
        if($new_price->pmax != 0)
        {
            $service = Service::find($new_price->id_service); //Encontramos el servicio
            $service->precioMax = (int) $new_price->pmax; //Actualizamos
            $service->save(); //Guardamos
        } 

        //Para evitar vulnerabilidades hacemos que la relacion sea uno con uno
        if(!Price::where('id_service', '=', $new_price->id_service)->first())
        {
            //Se crea una nueva colección
            $price = new Price();

            $price->price_mdo = $new_price->laboral;
            $price->materials = $new_price->materials;
            $price->id_service = $new_price->id_service;

             // Guardamos en base de datos
            $price->save();

            return response()->json([
                'success' => 'Cotización generada con éxito',
            ], 200);
        }
        else return response()->json(['errors' => ['fail' => ['Acceso Denegado!']]], 422);
    }
}
