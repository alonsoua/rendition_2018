<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, ShinobiTrait;
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sostenedor'
      , 'rut'
      , 'password'
      , 'name'
      , 'apellidoPaterno'
      , 'direccion'
      , 'email'
      , 'remember_token'
      ,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        if(!empty($value))
        {
            $this->attributes['password'] = encrypt($value);
        }
    }

    public function setSostenedorAttribute($value)
    {
        $this->attributes['sostenedor'] = ($value == 'on') ? '1' : '0';
    }
}
