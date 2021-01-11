<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Notification extends Eloquent
{
    /**
     *  * @var array
     */
    protected $fillable = [
        'id_service','id_customer'
        //,'coti_personal', 'workforce', 'sumtotal', 'lat', 'lng', 'status', 
        //'fecharequest', 'fechaact'
    ];

    
}
