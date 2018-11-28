<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
      , 'name'
      , 'apellidoPaterno'
      , 'apellidoMaterno'
      , 'direccion'
      , 'email'
      , 'password'
      , 'estado'
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

    // public function setPasswordAttribute($value)
    // {
    //     if(!empty($value))
    //     {
    //         $this->attributes['password'] = bcrypt($value);
    //     }
    // }

    public function setSostenedorAttribute($value)
    {
        $this->attributes['sostenedor'] = ($value == 'on') ? '1' : '0';
    }

    
}
