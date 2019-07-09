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
    /* FIN RELACIONES */

    public static function getFuncionario_LeyWithFuncionario($idFuncionario) {
      return Funcionario_Ley::selectRaw('*')->where('idFuncionario', $idFuncionario)                            
                           ->get();
    }

    public static function getHorasTotalPorLey($idLey) {
      $horasFuncionarios = Funcionario_Ley::selectRaw('sum(horas) as horas')
                            ->where('idLey', $idLey)
                            ->get(); 
      return $horasFuncionarios[0]['horas'];
    }

    public static function getFuncionario_Ley($idFuncionario, $idLey) {
      $hora = Funcionario_Ley::selectRaw('horas, idSubvencion, idLey, idFuncionario, id')
                             ->where('idFuncionario', $idFuncionario)                            
                             ->where('idLey', $idLey)
                             ->get();  
      if (count($hora) == 0) {
        return 0;             
      } else {
        return $hora[0];        
      }

    }
}
