<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prevision extends Model
{
    protected $table = 'salud';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo'
      , 'nombre'
      , 'porcentaje'
      , 'estado'
      ,
    ];
}
