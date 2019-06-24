<?php

namespace App\Http\Controllers;

//use App\Http\Requests\LiquidacionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use PDF;

use App\Liquidacion;
use App\Liquidacion_Ley;
use App\Establecimiento;

use App\Funcionario;
use App\Periodo;
use App\Ley;
use App\Comuna;
use App\Funcionario_Ley;
use App\Funcion;
use App\CalculoHora;
use App\tipo_contrato;
use App\CalculoHoraDetalle;

use App\Afp;
use App\salud;

class LiquidacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:liquidaciones.create')->only(['create', 'store']);
        $this->middleware('permission:liquidaciones.index')->only(['index']);
        $this->middleware('permission:liquidaciones.edit')->only(['edit', 'update']);
        $this->middleware('permission:liquidaciones.show')->only(['show']);
        $this->middleware('permission:liquidaciones.destroy')->only(['destroy']);
    }
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
        

        //FUNCIONARIOS
       



        return view('RRHH.liquidaciones.create', compact(
                          'editar'
                        , 'establecimientos'
                        , 'funcionarios'
                        , 'periodos'  
                        , 'funcionarioLey'  
                        , 'horas'    
                        , 'funcionarioDscto'              
                        , 'horasDscto'

                        // FUNCIONARIO
                      
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
                    'establecimiento'  => 'required',
                    'funcionario'      => 'required',
                    'periodo'          => 'required',
                    'fechaLiquidacion' => 'required',
                    'diasTrabajados'   => 'required|integer',                                                
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
                    'asignacionFamiliar'=> $request->asignacion,
                    'prestamos'         => $request->prestamos,
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
            $reload = 'ok';
            return response()->json([
                "message" => $mensaje,
                "reload" => $reload
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $liquidacion     = Liquidacion::findOrFail($id);
        $establecimiento = Establecimiento::findOrFail($liquidacion->idEstablecimiento);
        $comuna          = Comuna::findOrFail($establecimiento->idComuna);
        $funcionario     = Funcionario::findOrFail($liquidacion->idFuncionario);
        $prevision       = Salud::findOrFail($funcionario->idSalud);
        $afp             = Afp::findOrFail($funcionario->idAfp);
        $funcion         = Funcion::findOrFail($funcionario->idFuncion);
        $tipoContrato    = tipo_contrato::findOrFail($funcionario->idTipoContrato);        

        $liquidacion_ley = Funcionario_Ley::where('idFuncionario', $funcionario->id)->get();   
            
        $horasSubvGeneral = 0;
        $horasSubvPie     = 0;
        $horasSubvSep     = 0;
        foreach ($liquidacion_ley as $key => $value) {
            if ($value->idSubvencion == 1) {                //GENERAL
                $horasSubvGeneral += $value->horas;
            } elseif ($value->idSubvencion == 3) {          //PIE
                $horasSubvPie += $value->horas;
            } elseif ($value->idSubvencion == 5) {          //SEP
                $horasSubvSep += $value->horas;
            }
        }
        $horas = array();        
        $horas = [
                    'horasSubvGeneral' => $horasSubvGeneral,
                    'horasSubvPie'     => $horasSubvPie,
                    'horasSubvSep'     => $horasSubvSep
            ];


        //Llena con datos el PDF
        //
        // $pdf = PDF::loadView('PDF.pdfLiquidacion', 
        //              compact( 'liquidacion'
        //                     , 'establecimiento'
        //                     , 'funcionario'
        //                     , 'prevision'
        //                     , 'afp'
        //                     , 'funcion'
        //                     , 'tipoContrato'
        //                     , 'comuna'));


        return View('PDF.pdfLiquidacion', 
                     compact( 'liquidacion'
                            , 'establecimiento'
                            , 'funcionario'
                            , 'prevision'
                            , 'afp'
                            , 'funcion'
                            , 'tipoContrato'
                            , 'comuna'
                            , 'horas'));

        // return view('PDF.pdfLiquidacion');

        //Exporta PDF
        // return $pdf->download($liquidacion->fechaLiquidacion.'/'.$funcionario->nombre.''.$funcionario->apellidoPaterno.''.$funcionario->apellidoMaterno.'.pdf');
    }

    public function imprimirLiquidaciones ($desde, $hasta) {
        

        $liquidaciones = Liquidacion::select('liquidacions.*')->whereBetween('fechaLiquidacion', [$desde, $hasta])->get();        

        foreach ($liquidaciones as $key => $value) {            
            $establecimiento = Establecimiento::findOrFail($value->idEstablecimiento);
            $comuna          = Comuna::findOrFail($establecimiento->idComuna);
            $funcionario     = Funcionario::findOrFail($value->idFuncionario);
            $funcion         = Funcion::findOrFail($funcionario->idFuncion);
            $tipoContrato    = tipo_contrato::findOrFail($funcionario->idTipoContrato);   


            $imprimir[$key] = [ 
                            'liquidacion' => $value,
                            'establecimiento' => $establecimiento,
                            'comuna' => $comuna,
                            'funcionario' => $funcionario,
                            'funcion' => $funcion,
                            'tipoContrato' => $tipoContrato,
            ];            
        }

        //Llena con datos el PDF
        $pdf = PDF::loadView('PDF.pdfLiquidacionesRangoFecha', 
                     compact( 'imprimir'
                            , 'desde'
                            , 'hasta'));

        //Exporta PDF
        return $pdf->download('liquidaciones'.$desde.'-'.$hasta.'.pdf');
        
    } 


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $editar = 1;

        $liquidacion = Liquidacion::findOrFail($id);
    
        $estaRaw = Establecimiento::selectRaw('CONCAT(rbd, " - " , nombre) as nombre, id')->get();
        
        $establecimientos = $estaRaw->pluck('nombre', 'id');
               
        $funcionarios = Funcionario::getFuncionarios($liquidacion->idEstablecimiento);
        $periodos     = Periodo::getPeriodos(1);
        

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
        

        //FUNCIONARIOS
       



        return view('RRHH.liquidaciones.edit', compact(
                          'editar'
                        , 'liquidacion'
                        , 'establecimientos'
                        , 'funcionarios'
                        , 'periodos'  
                        , 'funcionarioLey'  
                        , 'horas'    
                        , 'funcionarioDscto'              
                        , 'horasDscto'

                        // FUNCIONARIO
                      
                    ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {                                   
        // Validaciones           
                                    // dd($request);
        Request()->validate([
                'establecimiento'  => 'required',
                'funcionario'      => 'required',
                'periodo'          => 'required',
                'fechaLiquidacion' => 'required',
                'diasTrabajados'   => 'required|integer',                                                
            ]);   


        $docExistente = Liquidacion::where('idFuncionario', $request->funcionario)
                                    ->where('idPeriodo', $request->periodo)
                                    ->get();

        // dd($docExistente);
        if (count($docExistente) > 1) {
            //MENSAJE
            $mensaje = 'La suma total <b>Monto Gasto</b> para las imputaciones del documento número  
                        <b>"'.$request->numDocumento.'"</b>, no puede exceder el <b>Monto 
                        Documento</b> ingresado.';

            $reload = 'no';
        } else {
            
            // Formateamos Fechas
            $fechaLiquidacionContrato = date("Y-m-d", strtotime($request->fechaLiquidacion));       
            // dd($request->asignacion);

            $liquidacion = Liquidacion::findOrFail($id);                    
            $liquidacion->idEstablecimiento = $request->establecimiento;            
            $liquidacion->idFuncionario     = $request->funcionario;        
            $liquidacion->idPeriodo         = $request->periodo;     
            $liquidacion->fechaLiquidacion  = $fechaLiquidacionContrato;            
            $liquidacion->diasTrabajados    = $request->diasTrabajados;
            $liquidacion->asignacionFamiliar = $request->asignacion;
            $liquidacion->prestamos         = $request->prestamos;            
                                              
            //MENSAJE
            $mensaje = 'La Liquidación del Funcionario <b>'.$request->funcionario.' - '.$request->periodo.'</b> ha sido editada correctamente';

            $reload = 'ok';
            
            if ($request->ajax()) {
                $liquidacion->save();
            }                        
            
        }

        if ($request->ajax()) {            
            return response()->json([
                "message" => $mensaje,
                "reload" => $reload
            ]);
        }
        
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



    public function getFuncionarios(Request $request, $idEstablecimiento, $id = null)
    {            
        if ($request->ajax()) {       

            if ($id == null) {
                $funcionarios = Funcionario::getFuncionarios($idEstablecimiento);
            }
            else {
                $funcionarios = Funcionario::getFuncionarios($id);
            }     
            
            
            
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

    public function getRangoFecha ($desde, $hasta) {
        $liquidaciones = Liquidacion::select('liquidacions.*')->with('funcionario', 'establecimiento', 'periodo')->whereBetween('liquidacions.fechaLiquidacion', [$desde, $hasta]);

        return datatables()
        ->eloquent($liquidaciones)             
        ->addColumn('opciones', 'RRHH.liquidaciones.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();
    }

    // public function pdf($id)
    // {    
    //     $pdf = PDF::loadView('PDF.pdfLiquidacion');
    //     return $pdf->download('myPdf.pdf');
    // }

      
}
