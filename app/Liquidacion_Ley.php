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
   
}
