<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imputacion extends Model
{
    protected $table = 'imputacions';

    protected $fillable = [
        'idEstablecimiento'
      , 'idSubvencion'
      , 'idCuenta'
      , 'idTipoDocumento'
      , 'numDocumento'
      , 'fechaDocumento'
      , 'fechaPago'
      , 'descripcion'
      , 'idProveedor'
      , 'montoGasto'
      , 'montoDocumento'
      , 'documento'
      , 'estado'     
      ,
    ];

    /* RELACIONES */
    public function establecimiento()
    {
    	return $this->belongsTo(Establecimiento::class, 'idEstablecimiento');
    }

    public function subvencion()
    {
        return $this->belongsTo(Subvencion::class, 'idSubvencion');
    }
    
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'idCuenta');
    }

    public function documento()
    {
        return $this->belongsTo(documento::class, 'idTipoDocumento');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }    
    /* FIN RELACIONES */
}

