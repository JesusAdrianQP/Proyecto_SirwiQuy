<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Service extends Eloquent
{
    /**
     *  * @var array
     */
    protected $fillable = [
        'id','identity','token','title', 'description', 'category', 'distrito', 'calificacion', 'precio', 
        'file'
    ];

    /**
     * @var array
     */
}
