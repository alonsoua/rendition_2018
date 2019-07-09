<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion_Ley extends Model
{
    protected $table = 'liquidacion_ley';

    protected $fillable = [
        'idLey'
      , 'idLiquidacion'
      , 'horasContratoLey'
      , 'valor'      
      , 'valorDescuento'      
      ,
    ];



    /* RELACIONES */
    public function ley()
    {
    	return $this->belongsTo(Ley::class, 'idLey');
    }

    public function liquidacion()
    {
        return $this->belongsTo(Liquidacion::class, 'idliquidacion');
    }


    public static function getHorasContrato ($idLey, $idLiquidacion) {
      // dd($idLiquidacion);
      $horasContrato = Liquidacion_Ley::selectRaw('horasContratoLey as horasContrato')
                                      ->where('idLey', $idLey)
                                      ->where('idLiquidacion', $idLiquidacion)
                                      ->get(); 
      if (count($horasContrato) == 0) {
        return 0;          
      } else {
        return $horasContrato[0]['horasContrato'];        
      }

    }

    public static function getValorHora ($idLey, $idLiquidacion) {
      $valorHora = Liquidacion_Ley::selectRaw('valor as valorHora')
                                  ->where('idLey', $idLey)
                                  ->where('idLiquidacion', $idLiquidacion)
                                  ->get(); 
      if (count($valorHora) == 0) {
        return 0;             
      } else {
        return $valorHora[0]['valorHora'];        
      }
    }
    
}
