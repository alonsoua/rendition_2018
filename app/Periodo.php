<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodos';

    protected $fillable = [
        'idAno'
      , 'periodo'
      , 'estado'
      ,
    ];


    public static function getPeriodos($idAno) {
        
        $periodos = Periodo::where('idAno', $idAno)
                                  ->selectRaw('periodo, id')
                                
                                ->get();
        
        return $periodos->pluck('periodo', 'id');
    }
}
