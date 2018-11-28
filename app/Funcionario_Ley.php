<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario_Ley extends Model
{
       protected $table = 'funcionario_ley';

    protected $fillable = [
        'idFuncionario'
      , 'idLey'
      , 'idSubvencion'
      , 'horas'      
      ,
    ];

    /* RELACIONES */
    public function funcionario()
    {
    	return $this->belongsTo(Funcionario::class, 'idFuncionario');
    }

    public function ley()
    {
        return $this->belongsTo(Ley::class, 'idLey');
    }

    public function subvencion()
    {
        return $this->belongsTo(Subvencion::class, 'idSubvencion');
    }
}
