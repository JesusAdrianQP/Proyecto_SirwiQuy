<?php

namespace App\DataBase;

use App\Notification;

class NotificationData
{ 

    public static function register($new_notification){
        
            //Se crea una nueva colección
            $notification = new Notification();

            //Guardo los datos en mi colección
            $notification->id_service = $new_notification->id_service;
            $notification->id_customer = $new_notification->id_customer; /*Codigo del proveedor*/
            //$notificaction->coti_personal = $new_service->title;
            //$notificaction->workforce = $new_service->description;
            //$notificaction->sumtotal = $new_service->category;
            //$notificaction->lat = $new_service->district;
            //$notificaction->lng = $new_service->district;
            //$notificaction->status = $new_service->district;
            //$notificaction->fecharequest = $new_service->district;
            //$notificaction->fechaact = $new_service->district;
            
            //$service->calificacion = 0;
            //$service->precio = (int) $new_service->price;
            //$service->file = $new_service->photo;

            $notification->save();

            return response()->json([
                'success' => 'Su notificacion ha sido creado'
            ], 200);

            
        
        
    }

    public static function notiddetails($id){
        $notifications_id = Notification::where('_id', '=', $id->notification_id)->first();

        return response()->json([
            'not_details' => $notifications_id
        ]);
    }


}
