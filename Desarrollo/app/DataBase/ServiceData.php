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
