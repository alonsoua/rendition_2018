<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Ley;
use App\Subvencion;

class LeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:leyes.create')->only(['create', 'store']);
        $this->middleware('permission:leyes.index')->only(['index']);
        $this->middleware('permission:leyes.edit')->only(['edit', 'update']);
        $this->middleware('permission:leyes.show')->only(['show']);
        $this->middleware('permission:leyes.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.leyes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $editar = 0;
        $subRaw       = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
                        ->where('estado', '1')->get();                  
        $subvenciones = $subRaw->pluck('nombre',  'id');    
        
        $porcentajeMaximo = '';

        return view('mantenedor.leyes.create', compact('subvenciones' , 'porcentajeMaximo', 'editar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */                    
    public function store(LeyRequest $request)
    {
        if ($request->ajax()) {
            Ley::create([
                'codigo'         => $request->codigo,
                'nombre'         => $request->nombre,
                'idSubvencion'   => $request->subvencion,
                'descripcion'    => $request->descripcion,
                'tipo'           => $request->tipo,
                'imponible'      => $request->imponible,
                'sueldoBase'     => $request->sueldoBase,
                'afp'            => $request->afp,
                'salud'          => $request->salud,
                'adicionalSalud' => $request->adicionalSalud,
                'porcMax'        => $request->porcentajeMáximo,
                'tope'           => $request->tope,
            ]);

            //MENSAJE
            $mensaje = 'La ley <b>'.$request['codigo'].' - '.$request['nombre'].'</b> ha sido agregado correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ley  $ley
     * @return \Illuminate\Http\Response
     */
    public function show(Ley $ley)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ley  $ley
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editar           = 1;   
        $ley              = Ley::findOrFail($id);

        $subRaw       = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
                        ->where('estado', '1')->get();
        $subvenciones = $subRaw->pluck('nombre',  'id'); 

        return view('mantenedor.leyes.edit', 
            compact(
                  'subvenciones'
                , 'ley'        
                , 'editar'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ley  $ley
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Request()->validate([
            'codigo'            => 'required|max:20' ,
            'nombre'            => 'required|max:100',
            'tipo'              => 'required',
            'subvencion'        => 'required',
            'descripcion'       => 'required',
            'porcentajeMáximo'  => 'required|Integer|min:0|max:999',
            'tope'              => 'required|Integer|min:0|max:99999999'
          ]);

         $ley = Ley::findOrFail($id);        
         $ley->codigo       = $request->codigo;
         $ley->nombre       = $request->nombre;
         $ley->tipo         = $request->tipo;
         $ley->idSubvencion = $request->subvencion;
         $ley->descripcion  = $request->descripcion;
         $ley->porcMax      = $request->porcentajeMáximo;
         $ley->tope         = $request->tope;
         
         // Checkbox
         $ley->imponible        = $request->imponible;
         $ley->sueldoBase       = $request->sueldoBase;
         $ley->afp              = $request->afp;
         $ley->salud            = $request->salud;
         $ley->adicionalSalud   = $request->adicionalSalud;

         

         $mensaje = 'El ley <b>'.$ley['codigo'].' - '.$ley['nombre'].'</b> ha sido editada correctamente';

         if ($request->ajax()) {
            $ley->save();
            return response()->json([
                "message" => $mensaje
            ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ley  $ley
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $nombre = DB::table('leys')->where('id', $id)->value('nombre');
        $codigo = DB::table('leys')->where('id', $id)->value('codigo');
       
        DB::table('leys')->where('id', $id)->delete();
        
        $texto   = $codigo.' - '.$nombre;
        $message = Helper::msgEliminado('F', 'Ley', $texto);        
        
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
