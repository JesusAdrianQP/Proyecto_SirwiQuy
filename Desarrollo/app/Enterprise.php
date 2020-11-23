<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Enterprise extends Eloquent implements Authenticatable
{
    use AuthenticableTrait;

    /**
     *  * @var array
     */
    protected $fillable = [
        'email', 'password', 'username', 'access', 'society', 'RUC', 'file_enterprise', 'cuenta',
        'file', 'name', 'lastnamep', 'lastnamem', 'DNI', 'recover'
    ];

    protected $guarded = [];
    /**
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];
}
