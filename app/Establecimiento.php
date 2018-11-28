<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Establecimiento extends Model
{
    protected $table = 'establecimientos';

    protected $fillable = [
        
        'nombre'
      , 'rbd'
      , 'razonSocial'
      , 'rut'
      , 'idTipoDependencia'
      , 'idSostenedor'
      , 'idComuna'
      , 'direccion'
      , 'fono'
      , 'correo'
      , 'insignia'
      , 'estado'
      ,
    ];

    /* RELACIONES */
    public function tipoDependencia()
    {
    	return $this->belongsTo(Sostenedor::class, 'idTipoDependencia');
    }

    public function sostenedor()
    {
    	return $this->belongsTo(Sostenedor::class, 'idSostenedor');
    }

    public function comuna()
    {
    	return $this->belongsTo(Sostenedor::class, 'idComuna');
    }
    /* FIN RELACIONES */

}
