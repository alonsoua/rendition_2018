<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalculoHoraDetalle extends Model
{
    protected $table = 'calculo_hora_detalle';

    protected $fillable = [
        
        'idCalculoHora'
      , 'idLey'
      , 'cargaPeriodo'
      , 'cantHoras'      
      , 'valor'
      ,
    ];

    public function calculoHora()
    {
        return $this->belongsTo(CalculoHora::class, 'idCalculoHora');
    }

    public function Ley()
    {
        return $this->belongsTo(Ley::class, 'idLey');
    }
}
