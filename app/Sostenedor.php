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


    public static function getSostenedor() {
      $sostRaw = Sostenedor::selectRaw('CONCAT(rut, " - " , nombre, " ", apellidoPaterno, " ", apellidoMaterno) as nombre, id')
                       ->where('estado', '1')
                       ->get();
      return $sostRaw->pluck('nombre',  'id');
    }
}
