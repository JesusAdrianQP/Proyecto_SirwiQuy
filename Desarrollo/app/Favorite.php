<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Favorite extends Eloquent
{
    /**
     *  * @var array
     */
    protected $fillable = [
        'idService','idCustomer'
    ];

    /**
     * @var array
     */
}
