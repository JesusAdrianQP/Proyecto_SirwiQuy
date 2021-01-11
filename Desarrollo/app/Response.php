<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Response extends Eloquent
{
    /**
     *  * @var array
     */
    protected $fillable = [
        'id_service', 'id_customer', 'id_provider', 'identity', 'new_lat', 'new_lng', 
        'addres', 'name','lastnamep','lastnamem',  'age', 'date','timemin','timemax', 'message',
        'status', 'cotizacion_personal', 'sumaTotal', 'work', 'linkPayPal'
    ];
    
    protected $guarded = [];

    /**
     * @var array
     */
}
