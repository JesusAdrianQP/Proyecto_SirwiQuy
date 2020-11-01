<?php

namespace App\DataBase;

use App\Service;
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
}
