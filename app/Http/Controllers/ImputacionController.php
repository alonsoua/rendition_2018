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
        return view('gastos.imputaciones.create', compact(
                          'editar'
                        , 'establecimientos'
                        , 'subvenciones'
                        , 'cuentas'
                        , 'tipoDocumentos'
                        , 'proveedores'
                    ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImputacionRequest $request)
    {
            //dd($request);
        if ($request->ajax()) {
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
        // $idEstablecimiento = $request->idEstablecimiento;
    }

}
