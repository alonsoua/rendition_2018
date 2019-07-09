<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Establecimiento extends Model
{
    protected $table = 'establecimientos';

    protected $fillable = [
        
        'nombre'
      , 'rbd'
      , 'razonSocial'
      , 'rut'
      , 'idTipoDependencia'
      , 'idSostenedor'
      , 'idComuna'
      , 'direccion'
      , 'fono'
      , 'correo'
      , 'sned'
      , 'reajuste'
      , 'insignia'
      , 'estado'
      ,
    ];

    /* RELACIONES */
    public function tipoDependencia()
    {
    	return $this->belongsTo(Sostenedor::class, 'idTipoDependencia');
    }

    public function sostenedor()
    {
    	return $this->belongsTo(Sostenedor::class, 'idSostenedor');
    }

    public function comuna()
    {
    	return $this->belongsTo(Sostenedor::class, 'idComuna');
    }
    /* FIN RELACIONES */

    public static function getEstablecimientos () {
      
      $estaRaw = Establecimiento::selectRaw('CONCAT(rbd, " - " , nombre) as nombre, id')->get();
      
      return $estaRaw->pluck('nombre', 'id');
    } 

    public static function getSned($idEstablecimiento) {     

      $snedResult = Establecimiento::select('sned')->where('id', $idEstablecimiento)->get();

      return $snedResult[0]['sned'];
    
    } 

    public static function getReajuste($idEstablecimiento) {     

      $reajusteResult = Establecimiento::select('reajuste')->where('id', $idEstablecimiento)->get();

      return $reajusteResult[0]['reajuste'];
    
    } 
}
