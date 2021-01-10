<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Request extends Eloquent
{
    /**
     *  * @var array
     */
    protected $fillable = [
        'id_provider', 'id_service', 'identity', 'new_lat', 'new_lng', 'addres', 'id_customer', 'name',
        'lastnamep','lastnamem',  'age', 'date','timemin','timemax', 'message','status', 
        'cotizacion_personal', 'sumaTotal'
    ];
    
    protected $guarded = [];

    public function scopeStatusnot($query, $filter){
        if($filter && $filter!='all') return $query->where('status', '=', "$filter");
    }
    /**
     * @var array
     */
}
