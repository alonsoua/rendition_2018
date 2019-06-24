<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PrevisionRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Prevision;

class PrevisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:previsiones.create')->only(['create', 'store']);
        $this->middleware('permission:previsiones.index')->only(['index']);
        $this->middleware('permission:previsiones.edit')->only(['edit', 'update']);
        $this->middleware('permission:previsiones.show')->only(['show']);
        $this->middleware('permission:previsiones.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.previsiones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editar = 0;
        return view('mantenedor.previsiones.create', compact(
                'editar'
            ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrevisionRequest $request)
    {                
        if ($request->ajax()) {           

            Prevision::create([                
                'nombre'     => $request->nombre,
                'porcentaje' => $request->porcentajeDescuento,                             
            ]);

            //MENSAJE
            $mensaje = 'La Previsión <b>'.$request['nombre'].'</b>';
            $mensaje .= ' ha sido agregada correctamente';

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
        $prevision = Prevision::findOrFail($id);

        // dd($prevision);    

        $editar = 1;
        return view('mantenedor.previsiones.edit', compact(
                'editar',
                'prevision'
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
        Request()->validate([            
            'nombre'              => 'required|max:100|unique:salud,nombre,'.$id.',id' ,            
            'porcentajeDescuento' => 'required|numeric|Min:0|Max:99'            
          ]);

         $prevision = Prevision::findOrFail($id);                 
         $prevision->nombre     = $request->nombre;
         $prevision->porcentaje = $request->porcentajeDescuento;
       

         $mensaje = 'La Previsión <b>'.$prevision['nombre'].'</b>';
         $mensaje .= ' ha sido editada correctamente';

         if ($request->ajax()) {
            $prevision->save();
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
    public function destroy(Request $request,$id)
    {
        $nombre = DB::table('salud')->where('id', $id)->value('nombre');

        // DB::table('salud')->where('id', $id)->delete();

        $prevision = Prevision::findOrFail($id);                 
        $prevision->estado     = 0;
        
        $message = Helper::msgEliminado('F', 'Previsión', $nombre);    

        if ($request->ajax()) {
            $prevision->save();
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
