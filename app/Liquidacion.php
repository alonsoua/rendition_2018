<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $table = 'liquidacions';

    protected $fillable = [
        'idEstablecimiento'      
      , 'idFuncionario'
      , 'idPeriodo'      
      , 'fechaLiquidacion'
      , 'diasTrabajados'
      , 'horasContratoSep'
      , 'fechaInicioContratoSep'    
      , 'sned'
      , 'reajusteSned'
      , 'asignacionFamiliar'   
      , 'bonoEscolaridad'          
      , 'bonoMovilizacion'         
      , 'bonoColacion'             
      , 'bonoAdicional'            
      , 'bonoEspecial'             
      , 'bonoSae'                  
      , 'bonoVacaciones'           
      , 'aguinaldoFiestasPatrias'  
      , 'aguinaldoNavidad'         
      , 'permisoSinSueldo'         
      , 'atrasos'                  
      , 'prestamos'                
      , 'otros'                    
      , 'estado'     
      ,
    ];

    /* RELACIONES */
    public function establecimiento()
    {
    	return $this->belongsTo(Establecimiento::class, 'idEstablecimiento');
    }   

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'idFuncionario');
        
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'idPeriodo');
    }

    public function subgeneral_ley410101()
    {
        return $this->belongsTo(Liquidacion_ley::class, 'id','idLiquidacion')
                                             ->selectRaw('Liquidacion_ley.*, leys.codigo')
                                             ->leftJoin('leys', 'Liquidacion_ley.idLey', '=', 'leys.id')
                                             ->where('leys.codigo', 410101)
                                             ->where('leys.idSubvencion', 1);
        
    }

    public function subgeneral_ley410102()
    {
        return $this->belongsTo(Liquidacion_ley::class, 'id','idLiquidacion')
                                             ->selectRaw('Liquidacion_ley.*, leys.codigo')
                                             ->leftJoin('leys', 'Liquidacion_ley.idLey', '=', 'leys.id')
                                             ->where('leys.codigo', 410102)
                                             ->where('leys.idSubvencion', 1);
        
    }

    /* FIN RELACIONES */

    public static function getDocumentoExistente ($idFuncionario, $idPeriodo) {
     
      return Liquidacion::where('idFuncionario', $idFuncionario)
                        ->where('idPeriodo', $idPeriodo)
                        ->where('estado', 1)
                        ->get();
    }

    public static function getLiquidacionesRangoFecha ($desde, $hasta) {
      return Liquidacion::select('liquidacions.*')
                        ->whereBetween('fechaLiquidacion', [$desde, $hasta])
                        ->get();
    }

    public static function getRangoFecha ($desde, $hasta) {
      return Liquidacion::selectRaw('
                                        liquidacions.*
                                      , tipo_contrato.codigo as codigoTipoContrato
                                      , funcions.codigo as codigoFuncion'
                              )
                              ->with('funcionario', 'establecimiento', 'periodo')
                              ->leftJoin('funcionarios', 'liquidacions.idFuncionario', '=', 'funcionarios.id')
                              ->leftJoin('tipo_contrato', 'funcionarios.idTipoContrato', '=', 'tipo_contrato.id')
                              ->leftJoin('funcions', 'funcionarios.idFuncion', '=', 'funcions.id')
                              ->where('liquidacions.estado', 1)

                              ->whereBetween('liquidacions.fechaLiquidacion', [$desde, $hasta])
                              ->orderBy('liquidacions.id', 'DESC');
    }

    public static function getDataTable () {
      $liquidacines = Liquidacion::selectRaw('
                                        liquidacions.*
                                      , tipo_contrato.codigo as codigoTipoContrato
                                      , funcions.codigo as codigoFuncion'
                              )
                              ->with(   
                                      'funcionario'
                                    , 'establecimiento'
                                    , 'periodo'                                    
                                    , 'subgeneral_ley410101' 
                                    // , 'subgeneral_ley410102' 
                              )
                              ->leftJoin('funcionarios', 'liquidacions.idFuncionario', '=', 'funcionarios.id')
                              ->leftJoin('tipo_contrato', 'funcionarios.idTipoContrato', '=', 'tipo_contrato.id')
                              ->leftJoin('funcions', 'funcionarios.idFuncion', '=', 'funcions.id')                              
                              ->where('liquidacions.estado', 1)
                              ->orderBy('liquidacions.id', 'DESC');    

      return $liquidacines;
    }
}