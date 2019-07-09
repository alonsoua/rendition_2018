<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodos';

    protected $fillable = [
        'idAno'
      , 'periodo'
      , 'nombrePeriodo'
      , 'estado'
      ,
    ];


    public static function getPeriodos($idAno) {
        
        $periodos = Periodo::where('idAno', $idAno)                              
                           ->selectRaw('periodo, id')
                           ->get();
        
        return $periodos->pluck('periodo', 'id');
    
    }

    public static function getPeriodosLiquidacion($idAno, $idEstablecimiento) {
        
        $periodos = Periodo::selectRaw('periodos.*')
                           ->leftjoin('calculo_horas', 'calculo_horas.idPeriodo' , '=' ,'periodos.id')         
                           ->where('idAno', $idAno) 
                           ->where('idEstablecimiento', $idEstablecimiento)                                                              
                           ->get();

        return $periodos->pluck('periodo', 'id');
   
    }

    public static function periodoNombrePeriodo() {
     
      $perRaw =   Periodo::selectRaw('CONCAT(
                                              periodo
                                            , " - " 
                                            , nombrePeriodo
                                        )
                                        as periodo
                                        , id
                                    ')
                        ->where('estado', '1')
                        ->get();

      return $perRaw->pluck('periodo', 'id');
    
    }


    public static function idPeriodo($periodo) { 
      
      $resultPeriodo = Periodo::select('id')
                              ->where('periodo', $periodo)
                              ->get();

      return $resultPeriodo[0]['id'];
    }

    public static function getPeriodo($idPeriodo) {

      $periodo = Periodo::where('id', $idPeriodo)->get();
      
      return $periodo[0];

    }

}
