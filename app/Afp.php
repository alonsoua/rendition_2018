<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afp extends Model
{
    protected $table = 'afp';

    protected $fillable = [
        
        'codigo'
      , 'nombre'      
      , 'porcentaje'   
      , 'estado'
      ,
    ];
}
