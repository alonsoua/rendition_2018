<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imputacion extends Model
{
    protected $table = 'imputacions';

    protected $fillable = [
        'idEstablecimiento'
      , 'reembolsable'
      , 'idFuncionario'
      , 'idSubvencion'
      , 'idCuenta'
      , 'idTipoDocumento'
      , 'formaPago'
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

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'idTipoDocumento');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }

    public function subvencion()
    {
        return $this->belongsTo(Subvencion::class, 'idSubvencion');
    }
    
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'idCuenta');
    }    
    /* FIN RELACIONES */
}


