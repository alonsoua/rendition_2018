<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $table = 'liquidacions';

    protected $fillable = [
        'idEstablecimiento'      
      , 'idFuncionario'
      , 'idPeriodo'      
      , 'fechaLiquidacion'
      , 'diasTrabajados'
      , 'horasContratoSep'
      , 'fechaInicioContratoSep'    
      , 'asignacionFamiliar'    
      , 'prestamos'    
      , 'estado'     
      ,
    ];

    /* RELACIONES */
    public function establecimiento()
    {
    	return $this->belongsTo(Establecimiento::class, 'idEstablecimiento');
    }   

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'idFuncionario');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'idPeriodo');
    }
    /* FIN RELACIONES */
}
