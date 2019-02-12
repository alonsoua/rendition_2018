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

    public function documento() 
    {
      return $this->belongsToMany(Documento::class, 'idSubvencion');
    }
    // FIN RELACIONES
    

    public static function getCuentasSubvencion($idSubvencion) {
        
        return Cuenta::join('cuenta_subvencion', 'cuenta_subvencion.idCuenta', '=', 'cuentas.id')             
                        ->selectRaw(' CONCAT(cuentas.codigo, " - " , cuentas.nombre) as nombre, cuentas.id as id')
                        ->where('cuenta_subvencion.idSubvencion', $idSubvencion)
                        ->get();
    }

    public static function getCuentasDocumento($idCuenta) {
        
        return Documento::join('cuenta_documento', 'cuenta_documento.idDocumento', '=', 'documentos.id')             
                        ->selectRaw(' CONCAT(documentos.codigo, " - " , documentos.nombre) as nombre, documentos.id as id')
                        ->where('cuenta_documento.idCuenta', $idCuenta)
                        ->get();
    }
}
