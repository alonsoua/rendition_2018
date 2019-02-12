<?php

namespace App\Http\Controllers;

use App\Http\Requests\RrhhFuncionesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Funcion;


class FuncionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:funciones.create')->only(['create', 'store']);
        $this->middleware('permission:funciones.index')->only(['index']);
        $this->middleware('permission:funciones.edit')->only(['edit', 'update']);
        $this->middleware('permission:funciones.show')->only(['show']);
        $this->middleware('permission:funciones.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.rrhhFunciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('mantenedor.rrhhFunciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RrhhFuncionesRequest $request)
    {
        if ($request->ajax()) {
            Funcion::create([
                'codigo'         => $request->codigo,
                'nombre'         => $request->nombre,
                'descripcion'    => $request->descripcion,
            ]);

            //MENSAJE
            $mensaje = 'La función <b>'.$request['codigo'].' - '.$request['nombre'].'</b>';
            $mensaje .= ' ha sido agregada correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Funcion  $funcion
     * @return \Illuminate\Http\Response
     */
    public function show(Funcion $funcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Funcion  $funcion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcion           = Funcion::findOrFail($id);

        // $subRaw       = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
        //                 ->where('estado', '1')->get();
        // $subvenciones = $subRaw->pluck('nombre',  'id'); 

        return view('mantenedor.rrhhFunciones.edit', compact('funcion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funcion  $funcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Request()->validate([
            'codigo'        => 'required|max:10|unique:funcions,codigo,'.$id.',id' ,
            'nombre'        => 'required|max:100',
            'descripcion'   => ''
          ]);

            $funcion = Funcion::findOrFail($id);        
            $funcion->codigo       = $request->codigo;
            $funcion->nombre       = $request->nombre;         
            $funcion->descripcion  = $request->descripcion;        

            $mensaje = 'La función <b>'.$funcion['codigo'].' - '.$funcion['nombre'].'</b> ha sido editada correctamente';

            if ($request->ajax()) {
                $funcion->save();
                return response()->json([
                    "message" => $mensaje
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Funcion  $funcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $nombre = DB::table('funcions')->where('id', $id)->value('nombre');
        $codigo = DB::table('funcions')->where('id', $id)->value('codigo');
       
        DB::table('funcions')->where('id', $id)->delete();
        $texto   = $codigo.' - '.$nombre;
        $message = Helper::msgEliminado('F', 'Función', $texto);        
        
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
