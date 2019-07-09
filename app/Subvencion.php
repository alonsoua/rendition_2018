<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subvencion extends Model
{
    protected $table = 'subvencions';

    protected $fillable = [
        
        'nombre'
      , 'descripcion'
      , 'valorHora'
      , 'porcentajeMax'
      , 'estado'
      ,
    ];


    // RELACIONES
    public function cuenta() 
    {
    	return $this->belongsToMany(Cuenta::class, 'idCuenta');
    }

    public static function getSubvenciones() {
      $subRaw       = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
                        ->where('estado', '1')->get();                  
      return $subRaw->pluck('nombre',  'id'); 
    }
}