<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubvencionRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Subvencion;

class SubvencionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:subvenciones.create')->only(['create', 'store']);
        $this->middleware('permission:subvenciones.index')->only(['index']);
        $this->middleware('permission:subvenciones.edit')->only(['edit', 'update']);
        $this->middleware('permission:subvenciones.show')->only(['show']);
        $this->middleware('permission:subvenciones.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.subvenciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $number = '';
        return view('mantenedor.subvenciones.create', compact('number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubvencionRequest $request)
    {
        if ($request->ajax()) {
            Subvencion::create([
                'nombre'        => $request->nombre,
                'descripcion'   => $request->descripcion,
                'porcentajeMax' => $request->porcentajeMaximo
            ]);

            //MENSAJE
            $mensaje = 'La subvención <b>'.$request['nombre'].'</b> ha sido agregada correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subvencion  $subvencion
     * @return \Illuminate\Http\Response
     */
    public function show(Subvencion $subvencion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subvencion  $subvencion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subvencion  = Subvencion::findOrFail($id);
        $number = $subvencion->porcentajeMax;
        return view('mantenedor.subvenciones.edit', compact('subvencion', 'number'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subvencion  $subvencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Request()->validate([
            'nombre'           => 'required|max:100',
            'porcentajeMaximo' => 'Integer|Min:1|Max:100|required'
        ]);

        $subvencion = Subvencion::findOrFail($id);        
        $subvencion->nombre            = $request->nombre;
        $subvencion->descripcion       = $request->descripcion;
        $subvencion->porcentajeMax     = $request->porcentajeMaximo;
        

        $mensaje = 'La subvencion con nombre <b>'.$subvencion['nombre'].'</b> ha sido editada correctamente';

        if ($request->ajax()) {
            $subvencion->save();
            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subvencion  $subvencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $nombre = DB::table('subvencions')->where('id', $id)->value('nombre');
        DB::table('subvencions')->where('id', $id)->update(['estado' => 0]);
        $message = 'La subvención con nombre <b>'.$nombre.'</b> fue eliminada correctamente';
        
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
