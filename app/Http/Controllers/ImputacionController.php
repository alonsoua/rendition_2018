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
use App\Documento;
use App\Proveedor;
use App\Funcionario;


class ImputacionController extends Controller
{
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

        
        $funcionarios     = Funcionario::getFuncionarios(null);
        return view('gastos.imputaciones.create', compact(
                          'editar'
                        , 'establecimientos'
                        , 'subvenciones'
                        , 'cuentas'
                        , 'tipoDocumentos'
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
        //dd($request->reembolsable);
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
            
            DB::transaction(function () use ($request){

                // Formateamos Fechas
                $fechaDocu = date("Y-m-d", strtotime($request->fechaDocumento));
                $fechaPago = date("Y-m-d", strtotime($request->fechaPago));
                
                // Crea Funcionario            
                $imputacion = Imputacion::Create([
                    'idEstablecimiento' => $request->establecimiento,
                    'reembolsable'      => $request->reembolsable,
                    'idFuncionario'     => $request->funcionario,
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
            $mensaje = 'El gasto <b>'.$request['numDocumento'].' - '.$establecimiento.'</b> 
                        ha sido ingresado correctamente';

            return response()->json([
                "message" => $mensaje
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
    public function edit(Imputacion $imputacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Imputacion  $imputacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imputacion $imputacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Imputacion  $imputacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imputacion $imputacion)
    {
        //
    }


    public function getCuentas(Request $request, $idSubvencion)
    {    
        if ($request->ajax()) {
            
            $cuentas = Cuenta::getCuentasSubvencion($idSubvencion);
            
            return response()->json($cuentas);
        }        
    }

    public function getFuncionarios(Request $request, $idEstablecimiento)
    {    
        if ($request->ajax()) {            
            
            $funcionarios = Funcionario::getFuncionarios($idEstablecimiento);
            
            return response()->json($funcionarios);
        }        
    }

}
