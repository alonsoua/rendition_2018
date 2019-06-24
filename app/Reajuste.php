<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reajuste extends Model
{
    protected $table = 'reajustes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idAno'
      , 'porcentajeReajuste'      
      ,
    ];

     /* RELACIONES */
    public function ano()
    {
        return $this->belongsTo(Ano::class, 'idAno');
    }   

    /* FIN RELACIONES */

}
