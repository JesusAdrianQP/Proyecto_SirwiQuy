<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Customer extends Eloquent implements Authenticatable
{
    use AuthenticableTrait;

    /**
     *  * @var array
     */
    protected $fillable = [
        'email', 'password', 'username', 'access', 'DNI', 'edad', 'file', 'name', 'lastnamep', 'lastnamem',
        'departamento', 'provincia', 'distrito', 'adress', 'nro_piso','piso_dpto', 'recover'
    ];

    protected $guarded = [];
    /**
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];
}
