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
    public function scopePmin($query, $pmin){
        if($pmin && $pmin!='all') return $query->where('precio','>=', $pmin);
    }
 
     public function scopePmax($query, $pmax){
         if($pmax && $pmax!='all') return $query->where('precio', '<=', $pmax);
    }

    /*
    public function scopePmin($query, $pmin, $pmax){
        if($pmin && $pmin!='all') return $query->where('precio','>=', $pmin);
     }
 
     public function scopePmax($query, $pmax){
         if($pmax && $pmax!='all') return $query->where('precio', '<=', $pmax);
     }*/
}
