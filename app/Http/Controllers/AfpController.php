<?php

namespace App\Http\Controllers;

use App\Http\Requests\AfpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Afp;

class AfpController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:afp.create')->only(['create', 'store']);
        $this->middleware('permission:afp.index')->only(['index']);
        $this->middleware('permission:afp.edit')->only(['edit', 'update']);
        $this->middleware('permission:afp.show')->only(['show']);
        $this->middleware('permission:afp.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.afp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editar = 0;
        return view('mantenedor.afp.create', compact(
                'editar'
            ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(AfpRequest $request)    
    {
        if ($request->ajax()) {           
         

            Afp::create([                
                'nombre'     => $request->nombre,
                'porcentaje' => $request->porcentajeDescuento,                             
            ]);

            //MENSAJE
            $mensaje = 'La AFP <b>'.$request['nombre'].'</b>';
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
        $afp = Afp::findOrFail($id);

        // dd($afp);    

        $editar = 1;
        return view('mantenedor.afp.edit', compact(
                'editar',
                'afp'
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
            'nombre'              => 'required|max:100|unique:afp,nombre,'.$id.',id' ,            
            'porcentajeDescuento' => 'required|numeric|Min:0|Max:99'            
          ]);

         $afp = Afp::findOrFail($id);                 
         $afp->nombre     = $request->nombre;
         $afp->porcentaje = $request->porcentajeDescuento;
       

         $mensaje = 'La AFP <b>'.$afp['nombre'].'</b>';
         $mensaje .= ' ha sido editada correctamente';

         if ($request->ajax()) {
            $afp->save();
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
        $nombre = DB::table('afp')->where('id', $id)->value('nombre');

        // DB::table('afp')->where('id', $id)->delete();
        
        $afp = Afp::findOrFail($id);                 
        $afp->estado     = 0;

        $message = Helper::msgEliminado('F', 'AFP', $nombre);    

        if ($request->ajax()) {
            $afp->save();
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
