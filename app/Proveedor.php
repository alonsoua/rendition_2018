<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo'
      , 'tipoPersona'
      , 'rut'
      , 'razonSocial'
      , 'giro'
      , 'idComuna'
      , 'direccion'
      , 'fono'
      , 'correo'
      , 'estado'
      ,
    ];
}
