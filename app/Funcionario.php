<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
	
    /* RELACIONES */
    public function establecimiento()
    {
    	return $this->belongsTo(Establecimiento::class, 'idEstablecimiento');
    }

    public function tipo_contrato()
    {
    	return $this->belongsTo(tipo_contrato::class, 'idTipoContrato');
    }

    public function funcion()
    {
    	return $this->belongsTo(Funcion::class, 'idFuncion');
    }
    /* FIN RELACIONES */
}
