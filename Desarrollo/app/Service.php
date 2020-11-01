<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Service extends Eloquent
{
    /**
     *  * @var array
     */
    protected $fillable = [
        'identity','id_worker','title', 'description', 'category', 'distrito', 'calificacion', 'precioMin', 'precioMax', 
        'file'
    ];

    /**
     * @var array
     */
}
