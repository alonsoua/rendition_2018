<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiquidacionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Helpers\CifrasEnLetras;

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
use App\Reajuste;

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

        // Subvenciones
        $horas = 0;
        // dd(Liquidacion::getDataTable());
        $establecimientos = Establecimiento::getEstablecimientos();               
        $funcionarios     = Funcionario::getFuncionarios(null);
        $periodos         = Periodo::getPeriodosLiquidacion(null, null);            

        // Consulta Subvenciones
        $arraySubvencioneImponibles = Ley::getSubvencionLeyHaber();

        $funcionarioLey = array();        
        // Recorre subvenciones ya que por cada subvencion 
        // hay que mostrar sus leyes respectivas
        foreach ($arraySubvencioneImponibles as $key => $subvencion) {                    

            // Consulta las leyes según subvención
            $leyes = Ley::getLeyesHaberImponible($subvencion->idSubvencion);

            $arrayLeyes = array();
            foreach ($leyes as $idLey => $ley) {

                $horasTotalFuncionarios = Funcionario_Ley::getHorasTotalPorLey($ley->idLey);
            
                $topeHora = $ley->topeHora - $horasTotalFuncionarios;

                $arrayLeyes[$ley->idLey] = [   
                    'idLey'     => $ley->idLey,
                    'codigoLey' => $ley->codigoLey,
                    'nombreLey' => $ley->nombreLey,
                    'topeHora'  => $topeHora,
                ];

            }

            // Consulta las leyes según subvención
            $leyesNoImponible = Ley::getLeyesHaberNoImponible($subvencion->idSubvencion);            
            
            $funcionarioLey[$key] = [   
                'idSubvencion'     => $subvencion->idSubvencion,
                'subvencion'       => $subvencion->nombreSubvencion,
                'leyes'            => $arrayLeyes, 
                'leyesNoImponible' => $leyesNoImponible,
            ];
        }     


        // Subvenciones Descuento
        $horasDscto = 0;

        // Consulta Subvenciones
        $arraySubvencionesDscto = Ley::getSubvencionLeyDescuentos();

        $funcionarioDscto= array();
        // Recorre subvenciones ya que por cada subvencion 
        // hay que mostrar sus leyes respectivas
        foreach ($arraySubvencionesDscto as $key => $subvencion) {

            // Consulta las leyes según subvención
            $leyes = Ley::getLeyesDescuentoLegal($subvencion->idSubvencion);

            $arrayLeyes = array();
            foreach ($leyes as $idLey => $ley) {

                $horasTotalFuncionarios = Funcionario_Ley::getHorasTotalPorLey($ley->idLey);                            
            
                $topeHora = $ley->topeHora - $horasTotalFuncionarios;

                $arrayLeyes[$ley->idLey] = [   
                    'idLey'     => $ley->idLey,
                    'codigoLey' => $ley->codigoLey,
                    'nombreLey' => $ley->nombreLey,
                    'topeHora'  => $topeHora,
                ];                
            }
            
            $funcionarioDscto[$key] = [   
                'idSubvencion' => $subvencion->idSubvencion,
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
    
    public function store(LiquidacionRequest $request)
    {
        if ($request->ajax()) {            
            
            // $sned = Establecimiento::getSned($request->establecimiento);
            
            // // Validaciones SNED, si el establecimiento tiene sned, valida
            // if ($sned == 1) {
            //     Request()->validate([
            //        'sned' => 'required'
            //     ]);                                   
            // }
            
            $docExistente = Liquidacion::getDocumentoExistente($request->funcionario, $request->periodo);
        
            if (count($docExistente) > 0) {
                
                //MENSAJE
                $mensaje = 'No se debe agregar dos liquidaciones para el mismo funcionario, en un mismo periodo.';
                $reload = 'no';

            } else {                

                if ($request->navHidden == 'navLiquidacion') {

                    $mensaje = 'Imponibles';
                    $reload  = 'nav';

                } else if ($request->navHidden == 'navImponibles') {
                    
                    $mensaje = 'Descuentos';
                    $reload  = 'nav';

                } else if ($request->navHidden == 'navDescuentos') { 
                    // dd('navDescuentos');
                    // Transaction: Si se cae en el segundo create, 
                    // no ingresa los datos del primer create                
                    DB::transaction(function () use ($request){

                        // Formateamos Fechas
                        $fechaLiquidacionContrato = date("Y-m-d", strtotime($request->fechaLiquidacion));                
                        
                        // Crea Liquidacion            
                        $liquidacion = Liquidacion::Create([
                            'idEstablecimiento'         => $request->establecimiento,
                            'idFuncionario'             => $request->funcionario,
                            'idPeriodo'                 => $request->periodo,
                            'fechaLiquidacion'          => $fechaLiquidacionContrato,
                            'diasTrabajados'            => $request->diasTrabajados,                    
                            // 'sned'                      => $request->sned,
                            // 'reliquidacionSned'         => $request->reliquidacionSned,
                            'asignacionFamiliar'        => $request->asignacion,
                            'bonoEscolaridad'           => $request->bonoEscolaridad,
                            'bonoMovilizacion'          => $request->bonoMovilizacion,
                            'bonoColacion'              => $request->bonoColacion,
                            'bonoAdicional'             => $request->bonoAdicional,
                            'bonoEspecial'              => $request->bonoEspecial,
                            'bonoSae'                   => $request->bonoSae,
                            'bonoVacaciones'            => $request->bonoVacaciones,
                            'aguinaldoFiestasPatrias'   => $request->aguinaldoFiestasPatrias,
                            'aguinaldoNavidad'          => $request->aguinaldoNavidad,
                            'permisoSinSueldo'          => $request->permisoSinSueldo,
                            'atrasos'                   => $request->atrasos,
                            'prestamos'                 => $request->prestamos,
                            'otros'                     => $request->otros,
                        ]);

                        $ley            = $request->ley;                
                        $horasContrato  = $request->horasContrato;
                        $valor          = $request->valor;
                        $valorDscto     = $request->valorDscto;

                        //IMPONIBLES                
                        foreach ($horasContrato as $id => $hora) {             

                            // Agrega imponibles en Liquidacion_Ley    
                            Liquidacion_Ley::create([
                                'idLey'            => $id,
                                'idLiquidacion'    => $liquidacion->id,
                                'horasContratoLey' => $hora,
                                'valor'            => str_replace('.', '', $valor[$id]),
                                'valorDescuento'   => Null,                                            
                            ]);                
                        }

                        //DESCUENTOS LEGALES
                        foreach ($valorDscto as $idLeys => $valor) {             

                            // Agrega descuentos en Liquidacion_Ley    
                            Liquidacion_Ley::create([
                                'idLey'            => $idLeys,
                                'idLiquidacion'    => $liquidacion->id,
                                'horasContratoLey' => Null,
                                'valor'            => Null,
                                'valorDescuento'   => str_replace('.', '', $valor),                                            
                            ]);                
                        }

                    });

                    //MENSAJE
                    $mensaje = 'La Liquidación del Funcionario <b>'.$request->funcionario.' - '.$request->periodo.'</b> 
                                ha sido agregada correctamente';

                    $reload = 'ok';
                }
                
            }
            return response()->json([
                "message" => $mensaje,
                "reload" => $reload
            ]);
        }
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
        $idAno = 1;

        $liquidacion = Liquidacion::findOrFail($id);
    
        $establecimientos = Establecimiento::getEstablecimientos();
                
        $funcionarios = Funcionario::getFuncionarios($liquidacion->idEstablecimiento);
        $periodos     = Periodo::getPeriodosLiquidacion($idAno, $liquidacion->idEstablecimiento);
                
        $horas = 0;

        // Consulta Subvenciones
        $arraySubvencionesImponibles = Ley::getSubvencionLeyHaber();

        $funcionarioLey = array();
        // Recorre subvenciones ya que por cada subvencion 
        // hay que mostrar sus leyes respectivas
        $valorHoraTotal = 0;
        foreach ($arraySubvencionesImponibles as $key => $subvencion) {
            
            // Consulta las leyes según subvención                      
            $leyes = Ley::getLeyesHaberImponible($subvencion->idSubvencion);
            
            $arrayLeyes = array();
            foreach ($leyes as $idLey => $ley) {
            
                $horasTotalFuncionarios = Funcionario_Ley::getHorasTotalPorLey($ley->idLey);

                $horasContrato  = Liquidacion_Ley::getHorasContrato($ley->idLey, $id);      
                
                $valorHoraFunci = Liquidacion_Ley::getValorHora($ley->idLey, $id);
                                
                $valorHora = CalculoHora::getValor($liquidacion->idEstablecimiento,$liquidacion->idPeriodo,$ley->idLey); 
                

                //REAJUSTE
                $reajuste = Establecimiento::getReajuste($liquidacion->idEstablecimiento);

                if ($reajuste == 1) {
                    $porcentajeReajuste = Reajuste::getPorcentajeReajuste();                
                }

                $valorHoraTotal = $valorHoraTotal + $valorHoraFunci;

                $topeHora = $ley->topeHora - $horasTotalFuncionarios; 

                $arrayLeyes[$ley->idLey] = [   
                    'idLey'         => $ley->idLey,
                    'codigoLey'     => $ley->codigoLey,
                    'nombreLey'     => $ley->nombreLey,
                    'topeHora'      => $topeHora,
                    'horasContrato' => $horasContrato,
                    'valorHora'     => Helper::miles($valorHoraFunci),
                    'valorHoraCalculo' => $valorHora['valorHora'],
                ];
                
            }           

            $funcionarioLey[$key] = [   
                'idSubvencion' => $subvencion->idSubvencion,
                'subvencion'   => $subvencion->nombreSubvencion,
                'leyes'        => $arrayLeyes, 
            ];
        }     

        $valorHoraTotal = Helper::miles($valorHoraTotal);

        // Subvenciones Descuento
        $horasDscto = 0;

        // Consulta Subvenciones
        $arraySubvencionesDscto = Ley::getSubvencionLeyDescuentos();

        $funcionarioDscto= array();
        // Recorre subvenciones ya que por cada subvencion 
        // hay que mostrar sus leyes respectivas
        foreach ($arraySubvencionesDscto as $key => $subvencion) {

            // Consulta las leyes según subvención
            $leyes =   Ley::getLeyesDescuentoLegal($subvencion->idSubvencion);

            $arrayLeyes = array();
            foreach ($leyes as $idLey => $ley) {

                $horasTotalFuncionarios = Funcionario_Ley::getHorasTotalPorLey($ley->idLey);
            
                $topeHora = $ley->topeHora - $horasTotalFuncionarios;

                $arrayLeyes[$ley->idLey] = [   
                    'idLey'     => $ley->idLey,
                    'codigoLey' => $ley->codigoLey,
                    'nombreLey' => $ley->nombreLey,
                    'topeHora'  => $topeHora,
                ];                
            }
            
            $funcionarioDscto[$key] = [   
                'idSubvencion' => $subvencion->idSubvencion,
                'subvencion'   => $subvencion->nombreSubvencion,
                'leyes'        => $arrayLeyes, 
            ];
        }     
        
                
        $valorContrato = $this->horasContratoEdit(
                                  $liquidacion->idFuncionario
                                , $liquidacion->idEstablecimiento
                                , $liquidacion->idPeriodo
                            );        
        

        //FUNCIONARIOS       
        // $sned = Establecimiento::getSned($liquidacion->idEstablecimiento);       

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
                        , 'valorContrato'
                        // , 'sned'
                        , 'valorHoraTotal'
                      
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
                'establecimiento'  => '',
                'funcionario'      => '',
                'periodo'          => 'required',
                'fechaLiquidacion' => 'required',
                'diasTrabajados'   => 'required|integer',                                                
            ]);   


        // $sned = Establecimiento::getSned($request->establecimiento);
            
        // // Validaciones SNED, si el establecimiento tiene sned, valida
        // if ($sned == 1) {
        //     Request()->validate([
        //        'sned' => 'required'
        //     ]);                                   
        // }
        
        $docExistente = Liquidacion::getDocumentoExistente($request->funcionario, $request->periodo);

        // dd($docExistente);
        if (count($docExistente) > 1) {
            //MENSAJE
            $mensaje = 'La suma total <b>Monto Gasto</b> para las imputaciones del documento número  
                        <b>"'.$request->numDocumento.'"</b>, no puede exceder el <b>Monto 
                        Documento</b> ingresado.';

            $reload = 'no';
        } else {
            if ($request->navHidden == 'navLiquidacion') {

                $mensaje = 'Imponibles';
                $reload  = 'nav';

            } else if ($request->navHidden == 'navImponibles') {
                
                $mensaje = 'Descuentos';
                $reload  = 'nav';

            } else if ($request->navHidden == 'navDescuentos') { 
                dd('navDescuentos');
                // Formateamos Fechas
                $fechaLiquidacionContrato = date("Y-m-d", strtotime($request->fechaLiquidacion));       
                // dd($request->asignacion);

                $liquidacion = Liquidacion::findOrFail($id);                    
                $liquidacion->idEstablecimiento         = $request->establecimiento;            
                $liquidacion->idFuncionario             = $request->funcionario;        
                $liquidacion->idPeriodo                 = $request->periodo;     
                $liquidacion->fechaLiquidacion          = $fechaLiquidacionContrato;            
                $liquidacion->diasTrabajados            = $request->diasTrabajados;
                // $liquidacion->sned                      = $request->sned;
                // $liquidacion->reajusteSned              = $request->reliquidacionSned;
                $liquidacion->asignacionFamiliar        = $request->asignacion;
                $liquidacion->bonoEscolaridad           = $request->bonoEscolaridad;
                $liquidacion->bonoMovilizacion          = $request->bonoMovilizacion;
                $liquidacion->bonoColacion              = $request->bonoColacion;
                $liquidacion->bonoAdicional             = $request->bonoAdicional;
                $liquidacion->bonoEspecial              = $request->bonoEspecial;
                $liquidacion->bonoSae                   = $request->bonoSae;
                $liquidacion->bonoVacaciones            = $request->bonoVacaciones;
                $liquidacion->aguinaldoFiestasPatrias   = $request->aguinaldoFiestasPatrias;
                $liquidacion->aguinaldoNavidad          = $request->aguinaldoNavidad;
                $liquidacion->permisoSinSueldo          = $request->permisoSinSueldo;
                $liquidacion->atrasos                   = $request->atrasos;
                $liquidacion->prestamos                 = $request->prestamos;
                $liquidacion->otros                     = $request->otros;

                $ley            = $request->ley;                
                $horasContrato  = $request->horasContrato;
                $valor          = $request->valor;
                $valorDscto     = $request->valorDscto;
                
                if ($request->ajax()) {
                    $liquidacion->save();
                }                        


                foreach ($horasContrato as $idHora => $hora) {             

                    // Editar relacion Liquidacion_Ley    
                    $horasContrato = Liquidacion_Ley::findOrFail($idHora);                      
                    $horasContrato->idLiquidacion    = $id;
                    $horasContrato->horasContratoLey = $hora;
                    $horasContrato->valor            = str_replace('.', '', $valor[$idHora]);
                    $horasContrato->valorDescuento   = Null;
                              

                    if ($request->ajax()) {
                        $horasContrato->save();
                    }                           
                }
                // foreach ($valorDscto as $idLeys => $valor) {             

                //     // Edita relacion Liquidacion_Ley                    
                //     $valorDscto = Liquidacion_Ley::findOrFail($idLeys);                      
                //     $valorDscto->idLiquidacion    = $id;
                //     $valorDscto->horasContratoLey = Null;
                //     $valorDscto->valor            = Null;
                //     $valorDscto->valorDescuento   = str_replace('.', '', $valorDscto[$idLeys]);                          

                //     if ($request->ajax()) {
                //         $valorDscto->save();
                //     }          
                // }
                //MENSAJE
                $mensaje = 'La Liquidación del Funcionario <b>'.$request->funcionario.' - '.$request->periodo.'</b> ha sido editada correctamente';
                $reload = 'ok';
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
    public function destroy(Request $request, $id)
    {
        // dd($id);
        // $estado       = DB::table('liquidacions')->where('id', $id)->value('estado');
        // $descripcion  = DB::table('liquidacions')->where('id', $id)->value('descripcion');        
               
        // DB::table('liquidacions')->where('id', $id)->delete();
        
        

        $liquidacion = Liquidacion::findOrFail($id);
        $funcionario = Funcionario::findOrFail($liquidacion->idFuncionario);                            
        $liquidacion->estado = 0;            

        //MENSAJE
        $mensaje = ''.$funcionario->nombre.' '.$funcionario->apellidoPaterno.' - '.$funcionario->rut.'';

        $reload = 'ok';
        
        // $registro   = $descripcion.' <b style="font-weight:normal">con estado</b> '.$estado.'';
        $message = Helper::msgEliminado('F', 'Liquidación del funcionario', $mensaje);        
        
        if ($request->ajax()) {
            $liquidacion->save();
            return response()->json([
               'id'      => $id,
               'message' => $message,
               'reload'  => $reload
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


        // //Llena con datos el PDF        
        // $pdf = PDF::loadView('PDF.pdfLiquidacion', 
        //              compact( 'liquidacion'
        //                     , 'establecimiento'
        //                     , 'funcionario'
        //                     , 'prevision'
        //                     , 'afp'
        //                     , 'funcion'
        //                     , 'tipoContrato'
        //                     , 'comuna'
        //                     , 'horas'));


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



        //Exporta PDF
        // return $pdf->download($liquidacion->fechaLiquidacion.'/'.$funcionario->nombre.''.$funcionario->apellidoPaterno.''.$funcionario->apellidoMaterno.'.pdf');
    }

    public function imprimirLiquidaciones ($desde, $hasta) {
        

        $liquidaciones = Liquidacion::getLiquidacionesRangoFecha($desde, $hasta);        

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

    public function getFuncionarios(Request $request, $idEstablecimiento, $id = null)
    {            
        if ($request->ajax()) {       

            if ($id == null) {
                $funcionarios = Funcionario::getFuncionarios($idEstablecimiento);
                $sned         = Establecimiento::getSned($idEstablecimiento);                
            }
            else {
                $funcionarios = Funcionario::getFuncionarios($id);
                $sned         = Establecimiento::getSned($id);                
            }     
            
            $info = array();
            $info = [
                'funcionarios' => $funcionarios,
                'sned'         => $sned,
            ];

            return response()->json($info);
        }        
    }



    public function getPeriodos(Request $request, $idAno, $idEstablecimiento)
    {    
        if ($request->ajax()) {            
            
            $periodos = Periodo::getPeriodosLiquidacion($idAno, $idEstablecimiento);            
            
            return response()->json($periodos);
        }        
    }
    
    public function horasContrato(Request $request, $idFuncionario, $idEstablecimiento, $idPeriodo)
    {
        if ($request->ajax()) {   
            
            $reajuste = Establecimiento::getReajuste($idEstablecimiento);
            if ($reajuste == 1) {
                $porcentajeReajuste = Reajuste::getPorcentajeReajuste();                
            } else {
                $porcentajeReajuste = 0;
            }                    

            $sned        = Establecimiento::getSned($idEstablecimiento);                                
            $periodo     = Periodo::getPeriodo($idPeriodo);            
            $valorFuncio = Funcionario_Ley::getFuncionario_LeyWithFuncionario($idFuncionario);  
            $funcion     = Funcionario::getFuncionFuncionario($idFuncionario);

            //Creamos array y agregamos periodo en key 0            
            $valorContrato   = array();
            $valorContrato[] = [
                'periodo' => $periodo['periodo']
            ];            
            
            foreach ($valorFuncio as $idLey => $funcionario) {

                $valorHora = CalculoHora::getValor($idEstablecimiento, $idPeriodo, $funcionario->idLey);                 
                $ley       = Ley::getLeys($funcionario->idLey);                

                $valorContrato[$funcionario->idLey] = [   
                    'idFuncionario'     => $funcionario->idFuncionario,
                    'idSubvencion'      => $funcionario->idSubvencion,
                    'idLey'             => $funcionario->idLey,
                    'codigoFuncion'     => $funcion['funcion']['codigo'],
                    'codigoLey'         => $ley['codigo'],
                    'sned'              => $sned,
                    'valorHora'         => $valorHora['valorHora'],
                    'horas'             => $funcionario->horas,
                    'reajuste'          => $reajuste,
                    'porcentajeReajuste'=> $porcentajeReajuste
                ];                               
            }
            
            return response()->json($valorContrato);

        }
    }

    public function horasContratoEdit($idFuncionario, $idEstablecimiento, $idPeriodo)
    {        
        $periodo = Periodo::where('id', $idPeriodo)->get();
        
        $horasFuncionario = Funcionario_Ley::selectRaw('*')                            
                        ->where('idFuncionario', $idFuncionario)                            
                        ->get();  

        $valorContrato = array();
        $valorContrato[] = ['periodo' => $periodo[0]['periodo']];
        foreach ($horasFuncionario as $idLey => $funcionario) {

            $valorHora = CalculoHora::selectRaw('calculo_hora_detalle.valor as valorHora')             
                        ->leftjoin('calculo_hora_detalle', 'calculo_hora_detalle.idCalculoHora' , '=' ,'calculo_horas.id')         
                        ->where('calculo_horas.idEstablecimiento', $idEstablecimiento)                            
                        ->where('calculo_horas.idPeriodo', $idPeriodo)                            
                        ->where('calculo_hora_detalle.idLey', $funcionario->idLey)                            
                        ->get();  
            


            // dd($valorHora[0]['valorHora']);
            $valorContrato[$funcionario->idLey] = [   
                        'idFuncionario'=> $funcionario->idFuncionario,
                        'idSubvencion' => $funcionario->idSubvencion,
                        'idLey'        => $funcionario->idLey,                            
                        'valorHora'    => $valorHora[0]['valorHora'],
                        'horas'        => $funcionario->horas,      
                        ];
                           
        }
         
        return $valorContrato;        
    }

    public function getRangoFecha ($desde, $hasta) {
        $liquidaciones = Liquidacion::getRangoFecha($desde, $hasta);

        return datatables()
        ->eloquent($liquidaciones)             
        ->addColumn('opciones', 'RRHH.liquidaciones.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();
    }
      
}


