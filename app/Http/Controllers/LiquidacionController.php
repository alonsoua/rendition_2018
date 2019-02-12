<?php

namespace App\Http\Controllers;

//use App\Http\Requests\LiquidacionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Liquidacion;
use App\Establecimiento;

use App\Funcionario;
use App\Periodo;

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
        
        return view('RRHH.liquidaciones.create', compact(
                          'editar'
                        , 'establecimientos'
                        , 'funcionarios'
                        , 'periodos'
                      
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
        //
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
}
