<?php

namespace App\Http\Controllers;

use App\Http\Requests\GastosDocumentosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Documento;


class DocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:documentos.create')->only(['create', 'store']);
        $this->middleware('permission:documentos.index')->only(['index']);
        $this->middleware('permission:documentos.edit')->only(['edit', 'update']);
        $this->middleware('permission:documentos.show')->only(['show']);
        $this->middleware('permission:documentos.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.gastosDocumentos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $subRaw       = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
        //                 ->where('estado', '1')->get();
        
        // $subvenciones = $subRaw->pluck('nombre',  'id');
        
        return view('mantenedor.gastosDocumentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GastosDocumentosRequest $request)
    {
        if ($request->ajax()) {
            Documento::create([
                'codigo'      => $request->codigo,
                'nombre'      => $request->nombre,
                'descripcion' => $request->descripcion,
                'exento'      => $request->exento,
            ]);

            //MENSAJE
            $mensaje = 'El documento <b>'.$request['codigo'].' - '.$request['nombre'].'</b>';
            $mensaje .= ' ha sido agregado correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documento = Documento::findOrFail($id);

        // $subRaw       = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
        //                 ->where('estado', '1')->get();
        // $subvenciones = $subRaw->pluck('nombre',  'id'); 

        return view('mantenedor.gastosDocumentos.edit', compact('documento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Request()->validate([
            'codigo'        => 'required|max:10|unique:documentos,codigo,'.$id.',id' ,
            'nombre'        => 'required|max:100',
            'descripcion'   => 'required'
          ]);

            $documento = Documento::findOrFail($id);        
            $documento->codigo      = $request->codigo;
            $documento->nombre      = $request->nombre;         
            $documento->descripcion = $request->descripcion;   
            $documento->exento      = $request->exento; 

            $mensaje = 'El documento <b>'.$documento['codigo'].' - '.$documento['nombre'].'</b>';
            $mensaje .= ' ha sido editado correctamente';

            if ($request->ajax()) {
                $documento->save();
                return response()->json([
                    "message" => $mensaje
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $nombre = DB::table('documentos')->where('id', $id)->value('nombre');
        $codigo = DB::table('documentos')->where('id', $id)->value('codigo');
       
        DB::table('documentos')->where('id', $id)->delete();

        $texto   = $codigo.' - '.$nombre;
        $message = Helper::msgEliminado('M', 'Tipo de Documento', $texto);
        
        
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
