<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Service extends Eloquent
{
    /**
     *  * @var array
     */
    protected $fillable = [
        'identity','token','title', 'description', 'category', 'distrito', 'calificacion', 'precio', 
        'file'
    ];

    /**
     * @var array
     */
    public function scopeTitle($query, $title){
        if($title && $title!='all') return $query->where('title', 'LIKE', "%$title%");
    }

    public function scopeLocalizacion($query, $district){
        if($district && $district!='all') return $query->where('distrito', 'LIKE', "%$district%");
    }

    public function scopePmin($query, $pmin){
        if($pmin && $pmin!='all') return $query->where('precio','>=', $pmin);
    }
 
     public function scopePmax($query, $pmax){
         if($pmax && $pmax!='all') return $query->where('precio', '<=', $pmax);
     }
     
     public function scopeCalificacion($query, $value){
        if($value == 0) return $query->orderBy('created_at', 'DESC');
            else if($value == 1) return $query->orderBy('calificacion', 'DESC');
    }
}
