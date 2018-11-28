<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalculoHora extends Model
{
    protected $table = 'calculo_horas';

    protected $fillable = [
        
        'idEstablecimiento'      
      , 'idPeriodo'
      , 'estado'      
      ,
    ];

	public function subvencion()
    {
    	return $this->belongsTo(Subvencion::class, 'idSubvencion');
    }

    public function establecimiento()
    {
    	return $this->belongsTo(Establecimiento::class, 'idEstablecimiento');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'idPeriodo');
    }

    // public function ano()
    // {
    // 	return $this->belongsTo(Ano::class, 'idAno');
    // }
}
