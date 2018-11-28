<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = 'cuentas';

    protected $fillable = [
        
        'codigo'
      , 'nombre'
      , 'descripcion'
      , 'estado'
      ,
    ];


	  // RELACIONES
    public function subvencion() 
    {
    	return $this->belongsToMany(Subvencion::class, 'idSubvencion');
    }
    // FIN RELACIONES
    

    public static function getCuentasSubvencion($idSubvencion) {
        
        return Cuenta::join('cuenta_subvencion', 'cuenta_subvencion.idCuenta', '=', 'cuentas.id')             
                        ->selectRaw(' CONCAT(cuentas.codigo, " - " , cuentas.nombre) as nombre, cuentas.id as id')
                        ->where('cuenta_subvencion.idSubvencion', $idSubvencion)
                        ->get();
    }
}
