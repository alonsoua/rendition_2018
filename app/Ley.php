<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ley extends Model
{
	protected $table = 'leys';

    protected $fillable = [
        
        'codigo'
      , 'nombre'
      , 'idSubvencion'
      , 'descripcion'
      , 'tipo'
      , 'haber'
      , 'descuento'
      , 'sueldoBase'
      , 'afp'
      , 'salud'
      , 'adicionalSalud'
      , 'porcMax'
      , 'tope'
      , 'estado'
      ,
    ];

	public function subvencion()
  {
  	return $this->belongsTo(Subvencion::class, 'idSubvencion');
  }

  public static function getLeys ($idLey) {
    $ley = Ley::select('*')
              ->where('id', $idLey)
              ->orderBy('codigo')
              ->get();
    return $ley[0];
  }
  
  public static function getLeyPorSubvencion($idSubvencion) {
    return Ley::selectRaw('leys.id as idLey, leys.codigo as codigoLey, leys.nombre as nombreLey, leys.tope as tope')
              ->where('idSubvencion', $idSubvencion)
              ->where('tipo', 'Haber')
              ->orderBy('leys.codigo')
              ->get();
  }

  public static function getSubvencionLeyHaber () {
    return Ley::join('subvencions', 'subvencions.id', '=', 'leys.idSubvencion')             
              ->selectRaw(' distinct 
                            subvencions.id as idSubvencion
                          , subvencions.nombre as nombreSubvencion')
              ->where('subvencions.id', '>', 0)
              ->where('leys.tipo', 'Haber')
              ->orderBy('subvencions.nombre')
              ->get();
  }

  public static function getTopeHora ($idSubvencion) {
    return Ley::selectRaw('tope as topeHora ')
              ->where('idSubvencion', $idSubvencion)
              ->where('tipo', 'Haber')
              ->get(); 
  }

  public static function getLeyesHaberImponible ($idSubvencion) {
    return Ley::selectRaw(' id as idLey
                          , codigo as codigoLey
                          , nombre as nombreLey 
                          , tope as topeHora ')
              ->where('idSubvencion', $idSubvencion)
              ->where('tipo', 'Haber')
              ->where('haber', 'Imponible')
              ->orderBy('codigo')
              ->get(); 
  }

  public static function getLeyesHaberNoImponible ($idSubvencion) {
    return Ley::selectRaw(' id as idLey
                          , codigo as codigoLey
                          , nombre as nombreLey 
                          , tope as topeHora ')
              ->where('idSubvencion', $idSubvencion)
              ->where('tipo', 'Haber')
              ->where('haber', 'No Imponible')
              ->orderBy('codigo')
              ->get(); 
  }

  public static function getSubvencionLeyDescuentos() {
    return Ley::join('subvencions', 'subvencions.id', '=', 'leys.idSubvencion')             
              ->selectRaw(' distinct 
                            subvencions.id as idSubvencion
                          , subvencions.nombre as nombreSubvencion')                                
              ->where('leys.tipo', 'Descuento')
              ->orderBy('subvencions.nombre')
              ->get();
  }

  public static function getLeyesDescuentoLegal($idSubvencion) {
    return Ley::selectRaw(' id as idLey
                          , codigo as codigoLey
                          , nombre as nombreLey 
                          , tope as topeHora ')
              ->where('idSubvencion', $idSubvencion)
              ->where('tipo', 'Descuento')
              ->where('descuento', 'Descuento Legal')
              ->orderBy('codigo')
              ->get(); 
  }
}
