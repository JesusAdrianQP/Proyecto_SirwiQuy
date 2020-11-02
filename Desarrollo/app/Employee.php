<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Employee extends Eloquent implements Authenticatable
{
    use AuthenticableTrait;

    /**
     *  * @var array
     */
    protected $fillable = [
        'username', 'DNI', 'edad', 'file', 'name', 'lastnamep', 'lastnamem', 'email', 'password', 
        'departamento', 'provincia', 'distrito', 'adress', 'cuenta', 'recover'
    ];

    protected $guarded = [];
    /**
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeEmployee($query, $id){
        if($id) return $query->where('_id', '=', $id)
                             ->select('email');
    }
}
