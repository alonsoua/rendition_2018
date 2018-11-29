<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';

    protected $fillable = [
        'idEstablecimiento'
      , 'rut'
      , 'nombre'
      , 'apellidoPaterno'
      , 'apellidoMaterno'
      , 'idAfp'
      , 'idSalud'
      , 'idTipoContrato'
      , 'horasCtoSemanal'
      , 'fechaInicioContrato'
      , 'fechaTerminoContrato'
      , 'idFuncion'
      , 'ufIsapre'
      , 'estado'
      ,
    ];
	
    /* RELACIONES */
    public function establecimiento()
    {
    	return $this->belongsTo(Establecimiento::class, 'idEstablecimiento');
    }

    public function afp()
    {
        return $this->belongsTo(Afp::class, 'idAfp');
    }

    public function salud()
    {
        return $this->belongsTo(Salud::class, 'idSalud');
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

    public static function getFuncionarios($idEstablecimiento) {
        
        $funcionarios = Funcionario::where('idEstablecimiento', $idEstablecimiento)
                                  ->selectRaw('CONCAT(rut, " - " , nombre, " ", apellidoPaterno, " ", apellidoMaterno) 
                                as nombre, id')
                                
                                ->get();
        
        return $funcionarios->pluck('nombre', 'id');
    }
    
}
