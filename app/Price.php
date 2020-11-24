<?php

namespace App;

use App\Service;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Price extends Eloquent
{
    /**
     *  * @var array
     */
    protected $fillable = [
        'price_mdo', 'materials' , 'id_service'
    ];

    /**
     * @var array
     */
}
