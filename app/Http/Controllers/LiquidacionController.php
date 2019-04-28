<?php

namespace App\Http\Controllers;

//use App\Http\Requests\LiquidacionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Liquidacion;
use App\Liquidacion_Ley;
use App\Establecimiento;

use App\Funcionario;
use App\Periodo;
use App\Ley;
use App\Funcionario_Ley;
use App\CalculoHora;
use App\CalculoHoraDetalle;

class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('RRHH.liquidaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editar = 0;
    
        $estaRaw = Establecimiento::selectRaw('CONCAT(rbd, " - " , nombre) as nombre, id')->get();
        
        $establecimientos = $estaRaw->pluck('nombre', 'id');
               
        $funcionarios = Funcionario::getFuncionarios(null);
        $periodos     = Periodo::getPeriodos(null);
        

        // Subvenciones
        $horas = 0;

        // Consulta Subvenciones
        $arraySubvenciones =    DB::table('leys')
                                ->join('subvencions', 'subvencions.id', '=', 'leys.idSubvencion')             
                                ->selectRaw(' distinct 
                                              subvencions.id as idSubvencion
                                            , subvencions.nombre as nombreSubvencion')
                                ->where('subvencions.id', '>', 0)
                                ->where('leys.tipo', 'Haber')
                                ->orderBy('subvencions.nombre')
                                ->get();

        // Recorre subvenciones ya que por cada subvencion 
        // hay que mostrar sus leyes respectivas
        $funcionarioLey = array();
        foreach ($arraySubvenciones as $key => $subvencion) {
            
            $topeHora = Ley::selectRaw('tope as topeHora ')
                            ->where('idSubvencion', $subvencion->idSubvencion)
                            ->where('tipo', 'Haber')
                            ->get();       

            // Consulta las leyes según subvención
            $leyes =   Ley::selectRaw('  id as idLey
                                            , codigo as codigoLey
                                            , nombre as nombreLey 
                                            , tope as topeHora ')
                            ->where('idSubvencion', $subvencion->idSubvencion)
                            ->where('tipo', 'Haber')
                            ->get();                            
            $arrayLeyes = array();
            foreach ($leyes as $idLey => $ley) {


                $horasFuncionarios = Funcionario_Ley::selectRaw('sum(horas) as horas')
                            ->where('idLey', $ley->idLey)
                            ->get(); 
            
                $topeHora = $ley->topeHora - $horasFuncionarios[0]['horas'];

                $arrayLeyes[$ley->idLey] = [   
                            'idLey'     => $ley->idLey,
                            'codigoLey' => $ley->codigoLey,
                            'nombreLey' => $ley->nombreLey,
                            'topeHora'  => $topeHora,
                            ];
                
            }

            // dd($arrayLeyes);
            $funcionarioLey[$key] = [   'idSubvencion' => $subvencion->idSubvencion,
                                        'subvencion'   => $subvencion->nombreSubvencion,
                                        'leyes'        => $arrayLeyes, 
                                    ];
        }     


        // Subvenciones Descuento
        $horasDscto = 0;

        // Consulta Subvenciones
        $arraySubvencionesDscto =    DB::table('leys')
                                ->join('subvencions', 'subvencions.id', '=', 'leys.idSubvencion')             
                                ->selectRaw(' distinct 
                                              subvencions.id as idSubvencion
                                            , subvencions.nombre as nombreSubvencion')                                
                                ->where('leys.tipo', 'Descuento')
                                ->orderBy('subvencions.nombre')
                                ->get();

        // Recorre subvenciones ya que por cada subvencion 
        // hay que mostrar sus leyes respectivas
        $funcionarioDscto= array();
        foreach ($arraySubvencionesDscto as $key => $subvencion) {
            
            $topeHora = Ley::selectRaw('tope as topeHora ')
                            ->where('idSubvencion', $subvencion->idSubvencion)
                            ->where('tipo', 'Descuento')
                            ->get();       

            // Consulta las leyes según subvención
            $leyes =   Ley::selectRaw('  id as idLey
                                            , codigo as codigoLey
                                            , nombre as nombreLey 
                                            , tope as topeHora ')
                            ->where('idSubvencion', $subvencion->idSubvencion)
                            ->where('tipo', 'Descuento')
                            ->get(); 

            $arrayLeyes = array();
            foreach ($leyes as $idLey => $ley) {

                $horasFuncionarios = Funcionario_Ley::selectRaw('sum(horas) as horas')
                            ->where('idLey', $ley->idLey)
                            ->get(); 
            
                $topeHora = $ley->topeHora - $horasFuncionarios[0]['horas'];

                $arrayLeyes[$ley->idLey] = [   
                            'idLey'     => $ley->idLey,
                            'codigoLey' => $ley->codigoLey,
                            'nombreLey' => $ley->nombreLey,
                            'topeHora'  => $topeHora,
                            ];                
            }
            
            $funcionarioDscto[$key] = [   'idSubvencion' => $subvencion->idSubvencion,
                                        'subvencion'   => $subvencion->nombreSubvencion,
                                        'leyes'        => $arrayLeyes, 
                                    ];
        }     


        return view('RRHH.liquidaciones.create', compact(
                          'editar'
                        , 'establecimientos'
                        , 'funcionarios'
                        , 'periodos'  
                        , 'funcionarioLey'  
                        , 'horas'    
                        , 'funcionarioDscto'              
                        , 'horasDscto'
                    ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {                                

            // Validaciones           
            Request()->validate([
                    'establecimiento'       => 'required',
                    'funcionario'           => 'required',
                    'periodo'               => 'required',
                    'fechaLiquidacion'      => 'required',
                    'diasTrabajados'        => 'required',                    
                ]);   
                   
            // Transaction: Si se cae en el segundo create, 
            // no ingresa los datos del primer create                
            DB::transaction(function () use ($request){

                // Formateamos Fechas
                $fechaLiquidacionContrato = date("Y-m-d", strtotime($request->fechaLiquidacion));                
                
                // Crea Liquidacion            
                $liquidacion = Liquidacion::Create([
                    'idEstablecimiento' => $request->establecimiento,
                    'idFuncionario'     => $request->funcionario,
                    'idPeriodo'         => $request->periodo,
                    'fechaLiquidacion'  => $fechaLiquidacionContrato,
                    'diasTrabajados'    => $request->diasTrabajados,                    
                ]);

                $ley            = $request->ley;                
                $horasContrato  = $request->horasContrato;
                $valor          = $request->valor;
                $valorDscto     = $request->valorDscto;
                // var_dump($horasContrato);
                // die();
                foreach ($horasContrato as $id => $hora) {             

                    // Crea relacion Liquidacion_Ley    
                    Liquidacion_Ley::create([
                        'idLey'            => $id,
                        'idLiquidacion'    => $liquidacion->id,
                        'horasContratoLey' => $horasContrato[$id],
                        'valor'            => $valor[$id],
                        'valorDescuento'   => Null,                                            
                    ]);                
                }
                foreach ($valorDscto as $idLeys => $valor) {             

                    // Crea relacion Liquidacion_Ley    
                    Liquidacion_Ley::create([
                        'idLey'            => $idLeys,
                        'idLiquidacion'    => $liquidacion->id,
                        'horasContratoLey' => Null,
                        'valor'            => Null,
                        'valorDescuento'   => $valorDscto[$idLeys],                                            
                    ]);                
                }

            });

            //MENSAJE
            $mensaje = 'La Liquidación del Funcionario <b>'.$request->funcionario.' - '.$request->periodo.'</b> ha sido agregada correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function show(Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liquidacion $liquidacion)
    {
        //
    }



    public function getFuncionarios(Request $request, $idEstablecimiento)
    {    

        if ($request->ajax()) {            
            
            $funcionarios = Funcionario::getFuncionarios($idEstablecimiento);
            
            return response()->json($funcionarios);
        }        
    }



    public function getPeriodos(Request $request, $idAno)
    {    

        if ($request->ajax()) {            
            
            $periodos = Periodo::getPeriodos($idAno);
            
            return response()->json($periodos);
        }        
    }

    public function horasContrato(Request $request, $idFuncionario, $idEstablecimiento, $idPeriodo)
    {
        if ($request->ajax()) {   
            $horasFuncionario = Funcionario_Ley::selectRaw('*')                            
                            ->where('idFuncionario', $idFuncionario)                            
                            ->get();  

            $valorContrato = array();
            foreach ($horasFuncionario as $idLey => $funcionario) {

                $valorHora = CalculoHora::selectRaw('calculo_hora_detalle.valor as valorHora')             
                            ->leftjoin('calculo_hora_detalle', 'calculo_hora_detalle.idCalculoHora' , '=' ,'calculo_horas.id')         
                            ->where('calculo_horas.idEstablecimiento', $idEstablecimiento)                            
                            ->where('calculo_horas.idPeriodo', $idPeriodo)                            
                            ->where('calculo_hora_detalle.idLey', $funcionario->idLey)                            
                            ->get();  

                
                
                $valorContrato[$funcionario->idLey] = [   
                            'idFuncionario'=> $funcionario->idFuncionario,
                            'idSubvencion' => $funcionario->idSubvencion,
                            'idLey'        => $funcionario->idLey,                            
                            'valorHora'    => $valorHora[0]['valorHora'],
                            'horas'        => $funcionario->horas,
                            ];
               
                
            }
            return response()->json($valorContrato);
        }
    }
}
