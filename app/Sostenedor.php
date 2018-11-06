<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sostenedor extends Model
{
    protected $table = 'sostenedors';

    protected $fillable = [
        
        'rut'
      , 'nombre'
      , 'apellidoPaterno'
      , 'apellidoMaterno'
      , 'idComuna'
      , 'direccion'
      , 'fono'
      , 'correo'
      , 'estado'
      ,
    ];


    /* RELACIONES */
    public function comuna()
    {
      return $this->belongsTo(Sostenedor::class, 'idComuna');
    }
    /* FIN RELACIONES */
}
