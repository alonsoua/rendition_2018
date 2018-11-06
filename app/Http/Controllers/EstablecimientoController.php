<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstablecimientoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Establecimiento;
use App\tipo_dependencia;
use App\Sostenedor;
use App\Comuna;

class EstablecimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:establecimientos.create')->only(['create', 'store']);
        $this->middleware('permission:establecimientos.index')->only(['index']);
        $this->middleware('permission:establecimientos.edit')->only(['edit', 'update']);
        $this->middleware('permission:establecimientos.show')->only(['show']);
        $this->middleware('permission:establecimientos.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.establecimientos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $tDepRaw = tipo_dependencia::select()->where('estado', '1')->get();
        $sostRaw = Sostenedor::selectRaw('CONCAT(rut, " - " , nombre, " ", apellidoPaterno, " ", apellidoMaterno) as nombre, id')->where('estado', '1')->get();
        
        $tipoDependencias = $tDepRaw->pluck('nombre', 'id');
        $sostenedores     = $sostRaw->pluck('nombre',  'id');
        $comunas          = Comuna::pluck('nombre', 'id');

        return view('mantenedor.establecimientos.create', compact('tipoDependencias', 'sostenedores', 'comunas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstablecimientoRequest $request)
    {
        if ($request->ajax()) {
            Establecimiento::create([
                'rbd'               => $request->rbd,
                'nombre'            => $request->nombre,
                'razonSocial'       => $request->razonSocial,
                'rut'               => $request->rut,
                'idTipoDependencia' => $request->tipoDependencia,
                'idSostenedor'      => $request->sostenedor,
                'idComuna'          => $request->comuna,
                'direccion'         => $request->direccion,
                'fono'              => $request->fono,
                'correo'            => $request->correo
            ]);

            //MENSAJE
            $mensaje = 'El establecimiento <b>'.$request['nombre'].'</b> ha sido agregado correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $establecimiento  = Establecimiento::findOrFail($id);
        
        $tDepRaw = tipo_dependencia::select()->where('estado', '1')->get();
        $sostRaw = Sostenedor::selectRaw('CONCAT(rut, " - " , nombre, " ", apellidoPaterno, " ", apellidoMaterno) as nombre, id')->where('estado', '1')->get();       

        $tipoDependencias = $tDepRaw->pluck('nombre', 'id');
        $sostenedores     = $sostRaw->pluck('nombre',  'id');
        $comunas          = Comuna::pluck('nombre', 'id');


        return view('mantenedor.establecimientos.edit', 
            compact(
                  'establecimiento'
                , 'tipoDependencias'
                , 'sostenedores'
                , 'comunas'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Request()->validate([
            'nombre'            => 'required|max:200',
             'rbd'              => 'required|max:20|unique:establecimientos,rbd,'.$id.',id' ,
            'razonSocial'       => 'required|max:150',
            'rut'               => 'required|numeric|unique:establecimientos,rut,'.$id.',id' ,
            'tipoDependencia'   => 'required',
            'sostenedor'        => 'required',
            'comuna'            => 'required',
            'direccion'         => 'required|max:250',
            'fono'              => 'required|max:45',
            'correo'            => 'max:150|email'
          ]);

         $establecimiento = Establecimiento::findOrFail($id);        
         $establecimiento->rbd               = $request->rbd;
         $establecimiento->nombre            = $request->nombre;
         $establecimiento->razonSocial       = $request->razonSocial;
         $establecimiento->rut               = $request->rut;
         $establecimiento->idTipoDependencia = $request->tipoDependencia;
         $establecimiento->idSostenedor      = $request->sostenedor;
         $establecimiento->idComuna          = $request->comuna;
         $establecimiento->direccion         = $request->direccion;
         $establecimiento->fono              = $request->fono;
         $establecimiento->correo            = $request->correo;

         $mensaje = 'El Establecimiento con nombre <b>'.$establecimiento['nombre'].'</b> ha sido editado correctamente';

         if ($request->ajax()) {
            $establecimiento->save();
            return response()->json([
                "message" => $mensaje
            ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $nombre = DB::table('establecimientos')->where('id', $id)->value('nombre');
        DB::table('establecimientos')->where('id', $id)->update(['estado' => 0]);
        $message = 'El establecimiento con nombre <b>'.$nombre.'</b> fue eliminado correctamente';
        
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
