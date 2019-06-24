<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImputacionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Imputacion;
use App\Establecimiento;
use App\Subvencion;
use App\Cuenta;
use App\CuentaSubvencion;
use App\CuentaDocumento;
use App\Documento;
use App\Funcionario;
use App\Proveedor;
use App\forma_pago;


class HonorarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:honorarios.create')->only(['create', 'store']);
        $this->middleware('permission:honorarios.index')->only(['index']);
        $this->middleware('permission:honorarios.edit')->only(['edit', 'update']);
        $this->middleware('permission:honorarios.show')->only(['show']);
        $this->middleware('permission:honorarios.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('RRHH.honorarios.index');
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
        $subvRaw = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
                            ->where('id','>', 0)->get();

        $cuenRaw = Cuenta::selectRaw('CONCAT(codigo, " - " , nombre) as nombre, id')
                            ->get();    



        $funcRaw = Funcionario::selectRaw('CONCAT(rut, " - " , nombre) as nombre, id')
                            ->where('idTipoContrato' , '=' , 3)
                            ->get();
        $provRaw = Proveedor::selectRaw('CONCAT(rut, " - " , razonSocial) as nombre, id')
                            ->get();

        $proveedores      = $provRaw->pluck('nombre', 'id');
        $establecimientos = $estaRaw->pluck('nombre', 'id');
        $subvenciones     = $subvRaw->pluck('nombre', 'id');
        $cuentas          = $cuenRaw->pluck('nombre', 'id');
        $tipoDocumentos   = Documento::pluck('nombre', 'id');
        $funcionarios     = $funcRaw->pluck('nombre', 'id');
        
        // $funcionarios     = Funcionario::getFuncionarios(null);
        return view('RRHH.honorarios.create', compact(
                          'editar'
                        , 'establecimientos'
                        , 'subvenciones'
                        , 'tipoDocumentos'
                        , 'cuentas'
                        , 'proveedores'                        
                        , 'funcionarios'
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
            // dd($request);
            if (empty($request->reembolsable)) {
                Request()->validate([
                    'establecimiento' => 'required',            
                    'funcionario'     => 'required',
                    'subvencion'      => 'required',            
                    'cuenta'          => 'required',            
                    'tipoDocumento'   => 'required',
                    'numDocumento'    => 'required|Integer|min:0|max:99999999999',
                    'fechaDocumento'  => 'required',
                    'fechaPago'       => 'required',
                    'descripcion'     => 'required',
                    'proveedor'       => 'required',
                    'montoGasto'      => 'required|Integer|min:0|max:99999999',
                    'montoDocumento'  => 'required|Integer|min:0|max:99999999',           
                    'estado'          => 'required'
                ]);   
            }  else {
                Request()->validate([
                    'establecimiento' => 'required',
                    'funcionario'     => 'required',            
                    'funcionario'     => 'required',
                    'subvencion'      => 'required',            
                    'cuenta'          => 'required',            
                    'tipoDocumento'   => 'required',
                    'numDocumento'    => 'required|Integer|min:0|max:99999999999',
                    'fechaDocumento'  => 'required',
                    'fechaPago'       => 'required',
                    'descripcion'     => 'required',
                    'proveedor'       => 'required',
                    'montoGasto'      => 'required|Integer|min:0|max:99999999',
                    'montoDocumento'  => 'required|Integer|min:0|max:99999999',           
                    'estado'          => 'required'

                ]);   
            }     
            
            DB::transaction(function () use ($request){

                // Formateamos Fechas
                $fechaDocu = date("Y-m-d", strtotime($request->fechaDocumento));
                $fechaPago = date("Y-m-d", strtotime($request->fechaPago));
                
                // Agrega funcionario si no viene en null
                $funcionario = $request->funcionario == 0 ? null : $request->funcionario;
                           
                // Crea Imputación tipo Honorario                 
                $imputacion = Imputacion::Create([
                    'tipo'              => 'Honorario',
                    'idEstablecimiento' => $request->establecimiento,
                    'reembolsable'      => $request->reembolsable,
                    'idFuncionario'     => $funcionario,
                    'idSubvencion'      => $request->subvencion,
                    'idCuenta'          => $request->cuenta,
                    'idTipoDocumento'   => $request->tipoDocumento,                    
                    'numDocumento'      => $request->numDocumento,
                    'fechaDocumento'    => $fechaDocu,
                    'fechaPago'         => $fechaPago,
                    'descripcion'       => $request->descripcion,
                    'idProveedor'       => $request->proveedor,
                    'montoGasto'        => $request->montoGasto,
                    'montoDocumento'    => $request->montoDocumento,                
                    'estado'            => $request->estado
                ]);            

            });

            $establecimiento = Establecimiento::findOrFail($request->establecimiento);

            //MENSAJE
            $mensaje = 'La Boleta de Honorario <b>'.$request['numDocumento'].' - '.$establecimiento['nombre'].'</b> 
                        ha sido ingresada correctamente';

            return response()->json([
                "message" => $mensaje
            ]);

        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $editar = 1;
        $imputacion = Imputacion::findOrFail($id);
        $estaRaw = Establecimiento::selectRaw('CONCAT(rbd, " - " , nombre) as nombre, id')->get();
        $subvRaw = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
                            ->where('id','>', 0)->get();

        $cuenRaw = Cuenta::selectRaw('CONCAT(codigo, " - " , nombre) as nombre, id')
                            ->get();              

        $provRaw = Proveedor::selectRaw('CONCAT(rut, " - " , razonSocial) as nombre, id')
                            ->get();
       

        $establecimientos = $estaRaw->pluck('nombre', 'id');
        $subvenciones     = $subvRaw->pluck('nombre', 'id');
        $cuentas          = $cuenRaw->pluck('nombre', 'id');
        $tipoDocumentos   = Documento::pluck('nombre', 'id');
        $formaPago        = forma_pago::pluck('nombre', 'id');
        $proveedores      = $provRaw->pluck('nombre', 'id');
        
        
        $funcionarios     = Funcionario::getFuncionarios($imputacion->idEstablecimiento);
        return view('RRHH.honorarios.edit', compact(
                          'editar'
                        , 'establecimientos'
                        , 'subvenciones'
                        , 'cuentas'
                        , 'tipoDocumentos'
                        , 'proveedores'
                        , 'funcionarios'
                        , 'imputacion'
                        , 'formaPago'
                    ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validaciones
        if (empty($request->reembolsable)) {
            Request()->validate([
                'establecimiento' => 'required',            
                'subvencion'      => 'required',            
                'cuenta'          => 'required',            
                'tipoDocumento'   => 'required',                
                'numDocumento'    => 'required|Integer|min:0|max:99999999999',
                'fechaDocumento'  => 'required',
                'fechaPago'       => 'required',
                'descripcion'     => 'required',
                'proveedor'       => 'required',
                'montoGasto'      => 'required|Integer|min:0|max:999999',
                'montoDocumento'  => 'required|Integer|min:0|max:999999',           
                'estado'          => 'required'

            ]);   
        }  else {
            Request()->validate([
                'establecimiento' => 'required',            
                'funcionario'     => 'required',
                'subvencion'      => 'required',            
                'cuenta'          => 'required',            
                'tipoDocumento'   => 'required',                
                'numDocumento'    => 'required|Integer|min:0|max:99999999999',
                'fechaDocumento'  => 'required',
                'fechaPago'       => 'required',
                'descripcion'     => 'required',
                'proveedor'       => 'required',
                'montoGasto'      => 'required|Integer|min:0|max:999999',
                'montoDocumento'  => 'required|Integer|min:0|max:999999',           
                'estado'          => 'required'

            ]);   
        }     

        
        // Formateamos Fechas             
        $fechaDocu = date("Y-m-d", strtotime($request->fechaDocumento));
        $fechaPago = date("Y-m-d", strtotime($request->fechaPago));
       
        $funcionario = $request->funcionario == 0 ? null : $request->funcionario;

        $imputacion = Imputacion::findOrFail($id);    
        $imputacion->tipo              = 'Honorario';    
        $imputacion->idEstablecimiento = $request->establecimiento;
        $imputacion->reembolsable      = $request->reembolsable;
        $imputacion->idFuncionario     = $funcionario;
        $imputacion->idSubvencion      = $request->subvencion;
        $imputacion->idCuenta          = $request->cuenta;
        $imputacion->idTipoDocumento   = $request->tipoDocumento;
        $imputacion->idFormaPago       = $request->formaPago;
        $imputacion->numDocumento      = $request->numDocumento;
        $imputacion->fechaDocumento    = $fechaDocu;
        $imputacion->fechaPago         = $fechaPago;
        $imputacion->descripcion       = $request->descripcion;
        $imputacion->idProveedor       = $request->proveedor;
        $imputacion->montoGasto        = $request->montoGasto;
        $imputacion->montoDocumento    = $request->montoDocumento;
        $imputacion->estado            = $request->estado;
            
        $establecimiento = Establecimiento::findOrFail($request->establecimiento);

        //MENSAJE
        $mensaje = 'La Boleta de Honorario <b>'.$request['numDocumento'].' - '.$establecimiento['nombre'].'</b> 
                    ha sido editada correctamente';

        if ($request->ajax()) {
            $imputacion->save();
            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $estado       = DB::table('imputacions')->where('id', $id)->value('estado');
        $descripcion  = DB::table('imputacions')->where('id', $id)->value('descripcion');        
               
        DB::table('imputacions')->where('id', $id)->delete();
        
        $registro   = $descripcion.' <b style="font-weight:normal">con estado</b> '.$estado.'';
        $message = Helper::msgEliminado('F', 'Boleta de Honorario', $registro);        
        
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }


    public function getCuentas(Request $request, $idSubvencion)
    {    
        if ($request->ajax()) {
            
            $cuentas = Cuenta::getCuentasSubvencion($idSubvencion);
            
            return response()->json($cuentas);
        }        
    }

    public function getDocumentos(Request $request, $idCuenta)
    {    
        if ($request->ajax()) {

            $documentos = Cuenta::getCuentasDocumento($idCuenta);
            
            return response()->json($documentos);
        }        
    }

    public function getFuncionariosTipoContrato(Request $request, $idEstablecimiento, $idTipoContrato)
    {            
        if ($request->ajax()) {            

          
            $funcionarios = Funcionario::getFuncionariosPorContrato($idEstablecimiento, $idTipoContrato);    
          
            return response()->json($funcionarios);
        }
    }


    public function modificarEstadoHonorario(Request $request, $idImputacion, $estado) 
    {
       
        $imputacion = Imputacion::modificarEstado($idImputacion , $estado);
            

        if ($request->ajax()) {
            $imputacion->save();
            return response()->json([
                "message" => 'ok'
            ]);
        }
    }

     public function getRangoFecha ($desde, $hasta) {
        // $honorario = Honorario::select('honorarios.*')->with('funcionario', 'establecimiento', 'periodo');

        $honorario = Imputacion::with('establecimiento', 'cuenta', 'subvencion', 'funcionario', 'documento', 'proveedor')
                                    ->select('imputacions.*')->where('imputacions.tipo', 'Honorario')
                                    ->whereBetween('imputacions.fechaDocumento', [$desde, $hasta]);

        return datatables()
        ->eloquent($honorario)             
        ->addColumn('opciones', 'RRHH.honorarios.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();
    }
}
