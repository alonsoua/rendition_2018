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
use App\Proveedor;
use App\Funcionario;
use App\forma_pago;


class ImputacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:imputaciones.create')->only(['create', 'store']);
        $this->middleware('permission:imputaciones.index')->only(['index']);
        $this->middleware('permission:imputaciones.edit')->only(['edit', 'update']);
        $this->middleware('permission:imputaciones.show')->only(['show']);
        $this->middleware('permission:imputaciones.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gastos.imputaciones.index');
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



        $provRaw = Proveedor::selectRaw('CONCAT(rut, " - " , razonSocial) as nombre, id')
                            ->get();
        
        $establecimientos = $estaRaw->pluck('nombre', 'id');
        $subvenciones     = $subvRaw->pluck('nombre', 'id');
        $cuentas          = $cuenRaw->pluck('nombre', 'id');
        $tipoDocumentos   = Documento::pluck('nombre', 'id');
        $proveedores      = $provRaw->pluck('nombre', 'id');
        $formaPago        = forma_pago::pluck('nombre', 'id');
        
        $funcionarios     = Funcionario::getFuncionarios(null);
        return view('gastos.imputaciones.create', compact(
                          'editar'
                        , 'establecimientos'
                        , 'subvenciones'
                        , 'cuentas'
                        , 'tipoDocumentos'
                        , 'proveedores'
                        , 'funcionarios'
                        , 'formaPago'
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
            if (empty($request->reembolsable)) {
                Request()->validate([
                    'establecimiento' => 'required',            
                    'subvencion'      => 'required',            
                    'cuenta'          => 'required',            
                    'tipoDocumento'   => 'required',
                    'formaPago'       => 'required',
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
                    'subvencion'      => 'required',            
                    'cuenta'          => 'required',            
                    'tipoDocumento'   => 'required',
                    'formaPago'       => 'required',
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

            // Formateamos Fechas
            $fechaDocu = date("Y-m-d", strtotime($request->fechaDocumento));
            $fechaPago = date("Y-m-d", strtotime($request->fechaPago));

            //Verifica si existe registro con el Número de Documento
            $docExistente = Imputacion::where('numDocumento', '=', $request->numDocumento)->get();
            
            if (count($docExistente) > 0) {
                
                if ($docExistente[0]->fechaDocumento == $fechaDocu 
                    && $docExistente[0]->idProveedor == $request->proveedor
                    && $docExistente[0]->montoDocumento == $request->montoDocumento) 
                {
                    
                    $montoGastos = 0;
                
                    //Suma montoGasto de lo que está en BD
                    foreach ($docExistente as $key => $valor) {                           
                       $montoGastos += $valor->montoGasto;
                    }

                    //El monto total de los gastos no puede subrepasar el montoDocumento
                    if (($montoGastos + $request->montoGasto) > $docExistente[0]->montoDocumento) {                        
                        //MENSAJE
                        $mensaje = 'La suma total <b>Monto Gasto</b> para las imputaciones del documento número  
                                    <b>"'.$request->numDocumento.'"</b>, no puede exceder el <b>Monto 
                                    Documento</b> ingresado.';

                        $reload = 'no';
                    } else {

                        DB::transaction(function () use ($request){
                            
                            // Formateamos Fechas
                            $fechaDocu = date("Y-m-d", strtotime($request->fechaDocumento));
                            $fechaPago = date("Y-m-d", strtotime($request->fechaPago));

                            // Si es reembolsable agrega funcionario
                            $funcionario = $request->funcionario == 0 ? null : $request->funcionario;

                            $imputacion = Imputacion::Create([
                                'tipo'              => 'Gasto',
                                'idEstablecimiento' => $request->establecimiento,
                                'reembolsable'      => $request->reembolsable,
                                'idFuncionario'     => $funcionario,
                                'idSubvencion'      => $request->subvencion,
                                'idCuenta'          => $request->cuenta,
                                'idTipoDocumento'   => $request->tipoDocumento,
                                'idFormaPago'       => $request->formaPago,
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
                    
                        //MENSAJE
                        $mensaje = 'La Imputación número <b>"'.$request['numDocumento'].'"</b>, con <b>Monto Gasto:  
                                    '.Helper::peso_chileno($request['montoGasto']).'</b>, ha sido creada 
                                    correctamente.';

                        $reload = 'ok';
                    }                    
                    
                } else if ($docExistente[0]->fechaDocumento != $fechaDocu 
                    && $docExistente[0]->idProveedor != $request->proveedor
                    && $docExistente[0]->montoDocumento != $request->montoDocumento) 
                {                    
                    //MENSAJE
                    $mensaje = 'El <b>Número Documento "'.$request['numDocumento'].'"</b>, ya existe en el sistema. Para 
                                ingresar dos imputaciones con el mismo <b>Número Documento</b>, debe contar con la misma
                                información en los campos <b>Fecha Documento, Proveedor y Monto Documento</b>.';

                    $reload = 'no';
                } else if ($docExistente[0]->fechaDocumento != $fechaDocu) {
                    //MENSAJE
                    $mensaje = 'La <b>Fecha Documento</b> ingresada, no coincide con la <b>Fecha Documento</b> ya 
                                existente para la imputación número <b>"'.$request['numDocumento'].'"</b>.';

                    $reload = 'no';
                } else if ($docExistente[0]->idProveedor != $request->proveedor) {
                    //MENSAJE
                    $mensaje = 'El <b>Proveedor</b> ingresado, no coincide con el <b>Proveedor</b> ya existente para 
                                la imputación número <b>"'.$request['numDocumento'].'"</b>.';

                    $reload = 'no';
                }  else if ($docExistente[0]->montoDocumento != $request->montoDocumento) {                    
                    //MENSAJE
                    $mensaje = 'El <b>Monto Documento</b> ingresado, no coincide con el <b>Monto Documento</b> ya 
                                existente para la imputación número <b>"'.$request['numDocumento'].'"</b>.';

                    $reload = 'no';
                }

            } else {

                
                DB::transaction(function () use ($request){
                    // Formateamos Fechas
                    $fechaDocu = date("Y-m-d", strtotime($request->fechaDocumento));
                    $fechaPago = date("Y-m-d", strtotime($request->fechaPago));

                    // Si es reembolsable agrega funcionario
                    $funcionario = $request->funcionario == 0 ? null : $request->funcionario;

                    $imputacion = Imputacion::Create([
                        'tipo'              => 'Gasto',
                        'idEstablecimiento' => $request->establecimiento,
                        'reembolsable'      => $request->reembolsable,
                        'idFuncionario'     => $funcionario,
                        'idSubvencion'      => $request->subvencion,
                        'idCuenta'          => $request->cuenta,
                        'idTipoDocumento'   => $request->tipoDocumento,
                        'idFormaPago'       => $request->formaPago,
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

                //MENSAJE
                $mensaje = 'La Imputación número <b>"'.$request['numDocumento'].'"</b>, con <b>Monto Gasto:  
                            '.Helper::peso_chileno($request['montoGasto']).'</b>, ha sido creada correctamente.';
                $reload = 'ok';
            }
            
            return response()->json([
                "message" => $mensaje,
                "reload" => $reload
            ]);

        }   
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Imputacion  $imputacion
     * @return \Illuminate\Http\Response
     */
    public function show(Imputacion $imputacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Imputacion  $imputacion
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
        return view('gastos.imputaciones.edit', compact(
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
     * @param  \App\Imputacion  $imputacion
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
                'formaPago'       => 'required',
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
                'formaPago'       => 'required',
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
        // dd($request);
        
        // Formateamos Fechas             
        $fechaDocu = date("Y-m-d", strtotime($request->fechaDocumento));
        $fechaPago = date("Y-m-d", strtotime($request->fechaPago));
        
        //Verifica si existe registro con el Número de Documento
        $docExistente = Imputacion::where('numDocumento', '=', $request->numDocumento)->get();

        $docEditado = Imputacion::findOrFail($id)->get();
        
        if (count($docExistente) > 1) {
            
            if ($docExistente[0]->fechaDocumento == $fechaDocu 
                && $docExistente[0]->idProveedor == $request->proveedor
                && $docExistente[0]->montoDocumento == $request->montoDocumento) 
            {
                
                $montoGastos = 0;
                
                //Suma montoGasto de lo que está en BD
                foreach ($docExistente as $key => $valor) {                           
                   $montoGastos += $valor->montoGasto;
                }
                //Restamos el valor monto gasto del doc
                $montoGastos = $montoGastos - $docEditado[0]->montoGasto;


                //El monto total de los gastos no puede subrepasar el montoDocumento
                if (($montoGastos + $request->montoGasto) > $docExistente[0]->montoDocumento) {                        
                
                    //MENSAJE
                    $mensaje = 'La suma total <b>Monto Gasto</b> para las imputaciones del documento número  
                                <b>"'.$request->numDocumento.'"</b>, no puede exceder el <b>Monto 
                                Documento</b> ingresado.';

                    $reload = 'no';
                } else {
                
                    // Formateamos Fechas
                    $fechaDocu = date("Y-m-d", strtotime($request->fechaDocumento));
                    $fechaPago = date("Y-m-d", strtotime($request->fechaPago));

                    $funcionario = $request->funcionario == 0 ? null : $request->funcionario;

                    $imputacion1 = Imputacion::findOrFail($id);        
                    $imputacion1->tipo              = 'Gasto';
                    $imputacion1->idEstablecimiento = $request->establecimiento;
                    $imputacion1->reembolsable      = $request->reembolsable;
                    $imputacion1->idFuncionario     = $funcionario;
                    $imputacion1->idSubvencion      = $request->subvencion;
                    $imputacion1->idCuenta          = $request->cuenta;
                    $imputacion1->idTipoDocumento   = $request->tipoDocumento;
                    $imputacion1->idFormaPago       = $request->formaPago;
                    $imputacion1->numDocumento      = $request->numDocumento;
                    $imputacion1->fechaDocumento    = $fechaDocu;
                    $imputacion1->fechaPago         = $fechaPago;
                    $imputacion1->descripcion       = $request->descripcion;
                    $imputacion1->idProveedor       = $request->proveedor;
                    $imputacion1->montoGasto        = $request->montoGasto;
                    $imputacion1->montoDocumento    = $request->montoDocumento;
                    $imputacion1->estado            = $request->estado;
                                                      
                    //MENSAJE
                    $mensaje = 'La Imputacion número <b>"'.$request['numDocumento'].'"</b>, con <b>Monto Gasto:  
                                '.Helper::peso_chileno($request['montoGasto']).'</b>, ha sido editada  
                                correctamente.';

                    $reload = 'ok';
                    
                    if ($request->ajax()) {
                        $imputacion1->save();
                    }
                }                    
                
            } else if ($docExistente[0]->fechaDocumento != $fechaDocu 
                && $docExistente[0]->idProveedor != $request->proveedor
                && $docExistente[0]->montoDocumento != $request->montoDocumento) 
            {               
                //MENSAJE
                $mensaje = 'El <b>Número Documento "'.$request['numDocumento'].'"</b>, ya existe en el sistema. Para 
                            ingresar dos imputaciones con el mismo <b>Número Documento</b>, debe contar con la misma
                            información en los campos <b>Fecha Documento, Proveedor y Monto Documento</b>.';

                $reload = 'no';
            } else if ($docExistente[0]->fechaDocumento != $fechaDocu) {
                //MENSAJE
                $mensaje = 'La <b>Fecha Documento</b> ingresada, no coincide con la <b>Fecha Documento</b> ya 
                            existente para la imputación número <b>"'.$request['numDocumento'].'"</b>.';

                $reload = 'no';
            } else if ($docExistente[0]->idProveedor != $request->proveedor) {
                //MENSAJE
                $mensaje = 'El <b>Proveedor</b> ingresado, no coincide con el <b>Proveedor</b> ya existente para 
                            la imputación número <b>"'.$request['numDocumento'].'"</b>.';

                $reload = 'no';
            }  else if ($docExistente[0]->montoDocumento != $request->montoDocumento) {                    
                //MENSAJE
                $mensaje = 'El <b>Monto Documento</b> ingresado, no coincide con el <b>Monto Documento</b> ya 
                            existente para la imputación número <b>"'.$request['numDocumento'].'"</b>.';

                $reload = 'no';
            }

        } else {

            // Formateamos Fechas
            $fechaDocu = date("Y-m-d", strtotime($request->fechaDocumento));
            $fechaPago = date("Y-m-d", strtotime($request->fechaPago));

            $funcionario = $request->funcionario == 0 ? null : $request->funcionario;

            $imputacion = Imputacion::findOrFail($id);        
            $imputacion->tipo              = 'Gasto';
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
                            

            //MENSAJE
            $mensaje = 'La Imputación número <b>"'.$request['numDocumento'].'"</b>, con <b>Monto Gasto:  
                        '.Helper::peso_chileno($request['montoGasto']).'</b>, ha sido editada correctamente.';
            $reload = 'ok';
        
            if ($request->ajax()) {
                $imputacion->save();               
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
     * @param  \App\Imputacion  $imputacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $estado       = DB::table('imputacions')->where('id', $id)->value('estado');
        $descripcion  = DB::table('imputacions')->where('id', $id)->value('descripcion');        
               
        DB::table('imputacions')->where('id', $id)->delete();
        
        $registro   = $descripcion.' <b style="font-weight:normal">con estado</b> '.$estado.'';
        $message = Helper::msgEliminado('M', 'Gasto', $registro);        
        
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


    public function modificarEstado(Request $request, $idImputacion, $estado) 
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
        
        $imputaciones = Imputacion::select('imputacions.*')->with('establecimiento', 'cuenta', 'subvencion', 'documento', 'proveedor')
                                    ->where('imputacions.tipo', 'Gasto')
                                    ->whereBetween('imputacions.fechaDocumento', [$desde, $hasta]);
                                                                        
        return datatables()
        ->eloquent($imputaciones)             
        ->addColumn('opciones', 'gastos.imputaciones.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();

    }


}
