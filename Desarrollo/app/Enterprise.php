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
        'username', 'name_enterprise', 'RUC', 'file_enterprise', 'cuenta_enterprise',
        'file_admi', 'name_admi', 'lastnamep_admi', 'lastnamem_admi', 'DNI', 'email', 'password', 'recover'
    ];

    protected $guarded = [];
    /**
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeEnteprise($query, $id){
        if($id) return $query->where('_id', '=', $id)
                             ->select('email');
    }
}
