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
    public static function idCalculoHora($idPeriodo, $idEstablecimiento) {
        
        return CalculoHora::selectRaw('id')
            ->where('idPeriodo', $idPeriodo)
            ->where('idEstablecimiento', $idEstablecimiento)
            ->get();

        // return $funcionarios->pluck('nombre', 'id');
    }  

    public static function getValor ($idEstablecimiento, $idPeriodo, $idLey) {
        $valor = CalculoHora::selectRaw('calculo_hora_detalle.valor as valorHora')             
                            ->leftjoin('calculo_hora_detalle', 'calculo_hora_detalle.idCalculoHora' , '=' ,'calculo_horas.id')         
                            ->where('calculo_horas.idEstablecimiento', $idEstablecimiento)                            
                            ->where('calculo_horas.idPeriodo', $idPeriodo)                            
                            ->where('calculo_hora_detalle.idLey', $idLey)                            
                            ->get(); 
        if (count($valor) == 0) {
            return 0;             
        } else {    
            return $valor[0];
        }                                
    }

}
