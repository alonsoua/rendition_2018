<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculoHoraRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Establecimiento;
use App\Periodo;
use App\Ley;
use App\Subvencion;
use App\CalculoHora;
use App\CalculoHoraDetalle;


class CalculoHoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:calculohoras.create')->only(['create', 'store']);
        $this->middleware('permission:calculohoras.index')->only(['index']);
        $this->middleware('permission:calculohoras.edit')->only(['edit', 'update']);
        $this->middleware('permission:calculohoras.show')->only(['show']);
        $this->middleware('permission:calculohoras.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $estRaw =   Establecimiento::selectRaw('
                        CONCAT(
                              rut
                            , " - " 
                            , nombre
                        )
                        as nombre
                        , id
                    ')
                    ->where('estado', '1')
                    ->get();

        $establecimientos = $estRaw->pluck('nombre',  'id');        
        $periodos         = Periodo::pluck('periodo', 'id');        
        $leyes = 0;

        return view('mantenedor.calculoHoras.index'
                , compact(
                      'establecimientos'
                    , 'periodos'
                    , 'leyes'
                ));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            // Si existe devuelve id
            // si no existe lo crea y devuelve id
            $calculoHora = CalculoHora::firstOrCreate(
                [ 'idEstablecimiento' => $request->establecimiento 
                , 'idPeriodo' => $request->periodo ]
            );

            //Agregamos relación CalculoHora CalculoHoraDetalle
            $cargaPeriodo = $request->cargaPeriodo;
            foreach ($cargaPeriodo as $ley => $value) {        

                $calculoHoraDetalle = CalculoHoraDetalle::firstOrCreate(
                    [ 'idCalculoHora' => $calculoHora->id 
                    , 'idLey'         => $ley ]
                );

                $calculoHoraDetalleEdit = CalculoHoraDetalle::findOrFail($calculoHoraDetalle->id);        
                $calculoHoraDetalleEdit->cargaPeriodo = str_replace(".", "", $request->cargaPeriodo[$ley]);
                $calculoHoraDetalleEdit->cantHoras    = str_replace(".", "", $request->cantHoras[$ley]);
                $calculoHoraDetalleEdit->valor        = str_replace(".", "", $request->valor[$ley]);         
                $calculoHoraDetalleEdit->save();
            }     
            

            //Devuelve info a mostrar en el mensaje
            $periodo = Periodo::findOrFail($request->periodo);            
            $estable = Establecimiento::findOrFail($request->establecimiento);    
 
            //MENSAJE
            $mensaje = 'El Calculo de Hora en el Periodo <b>'.$periodo->periodo.'</b>';
            $mensaje .= ' para el Establecimiento <b>'.$estable->nombre.'</b>,';
            $mensaje .= ' ha sido agregado correctamente';

            return response()->json([                
                "message" => $mensaje
            ]);
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CalculoHora  $calculoHora
     * @return \Illuminate\Http\Response
     */
    public function show(CalculoHora $calculoHora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CalculoHora  $calculoHora
     * @return \Illuminate\Http\Response
     */
    public function edit(CalculoHora $calculoHora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CalculoHora  $calculoHora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalculoHora $calculoHora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CalculoHora  $calculoHora
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalculoHora $calculoHora)
    {
        //
    }


    public function periodos(Request $request)
    {    
        $idEstablecimiento = $request->idEstablecimiento;
        $periodos = Periodo::all();        
        return response()->json($periodos);
    }

    public function cargaLeyes(Request $request)
    {
        $idPeriodo = $request->idPeriodo;
        $idEstable = $request->idEstablecimiento;
                      
        // Consulta si existe un CalculoHora con los datos
        // idPeriodo y idEstablecimiento enviados en request
        $calculoHora =  CalculoHora::selectRaw('id')
                        ->where('idEstablecimiento', $idEstable)
                        ->where('idPeriodo', $idPeriodo)                        
                        ->get();


        // Consulta Subvenciones
        $arraySubvenciones =    DB::table('leys')
                                ->join('subvencions', 'subvencions.id', '=', 'leys.idSubvencion')             
                                ->selectRaw(' distinct 
                                              subvencions.id as idSubvencion
                                            , subvencions.nombre as nombreSubvencion')
                                ->where('subvencions.id', '>', 0)
                                ->orderBy('subvencions.nombre')
                                ->get();

        // Recorre subvenciones ya que por cada subvencion 
        // hay que mostrar sus leyes respectivas
        $leyes = array();
        foreach ($arraySubvenciones as $key => $subvencion) {
            
            // Consulta las leyes según subvención
            $arrayLeyes =   DB::table('leys')
                            ->selectRaw('leys.id as idLey, leys.codigo as codigoLey, leys.nombre as nombreLey')
                            ->where('idSubvencion', $subvencion->idSubvencion)
                            ->get();

            $leyesValores = array();
            foreach ($arrayLeyes as $ley => $value) {
                
                //Por defecto
                $cargP = 2000000;
                $cantH = 200;
                $valor = 9000;

                if (!empty($calculoHora[0])) {
                    
                    $calculoHoraDetalle =   CalculoHoraDetalle::selectRaw('*')
                                            ->where('idCalculoHora', $calculoHora[0]->id)                   
                                            ->where('idLey', $value->idLey)       
                                            ->get();
                    //Si calculoHora
                    if (!empty($calculoHoraDetalle[0])) {
                        
                        array_push( $leyesValores,  [ 
                                                        'idLey'        => $value->idLey,
                                                        'codigoLey'    => $value->codigoLey,
                                                        'nombreLey'    => $value->nombreLey,
                                                        'cargaPeriodo' => $calculoHoraDetalle[0]->cargaPeriodo,
                                                        'cantHoras'    => $calculoHoraDetalle[0]->cantHoras,
                                                        'valor'        => $calculoHoraDetalle[0]->valor
                                                    ]);
                        
                    } else {                       

                        array_push( $leyesValores,  [ 
                                                        'idLey'        => $value->idLey,
                                                        'codigoLey'    => $value->codigoLey,
                                                        'nombreLey'    => $value->nombreLey,
                                                        'cargaPeriodo' => $cargP,
                                                        'cantHoras'    => $cantH,
                                                        'valor'        => $valor                              
                                                    ]);                        
                    }   
                }else {                    

                    array_push( $leyesValores,  [ 
                                                    'idLey'        => $value->idLey,
                                                    'codigoLey'    => $value->codigoLey,
                                                    'nombreLey'    => $value->nombreLey,
                                                    'cargaPeriodo' => $cargP,
                                                    'cantHoras'    => $cantH,
                                                    'valor'        => $valor                              
                                                ]);     
                }
                    
            }
                   
            array_push( $leyes, [
                                   'subvencion' => $subvencion->nombreSubvencion,
                                   'leyes'      => [ $leyesValores ],                       
                                ]);            
        }
        
        return response()->json($leyes);
    }
}

