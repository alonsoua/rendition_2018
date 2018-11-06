<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    protected $table = 'funcions';

    protected $fillable = [
        
        'codigo'
      , 'nombre'
      , 'descripcion'
      , 'estado'
      ,
    ];
}
