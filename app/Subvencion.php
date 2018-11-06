<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subvencion extends Model
{
    protected $table = 'subvencions';

    protected $fillable = [
        
        'nombre'
      , 'descripcion'
      , 'valorHora'
      , 'porcentajeMax'
      , 'estado'
      ,
    ];
}