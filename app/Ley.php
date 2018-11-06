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
      , 'imponible'
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
}
