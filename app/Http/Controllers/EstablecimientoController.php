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
        $editar  = 0;
        $tDepRaw = tipo_dependencia::select()->where('estado', '1')->get();
        $sostRaw = Sostenedor::selectRaw('CONCAT(rut, " - " , nombre, " ", apellidoPaterno, " ", apellidoMaterno) as nombre, id')->where('estado', '1')->get();
        
        $tipoDependencias = $tDepRaw->pluck('nombre', 'id');
        $sostenedores     = $sostRaw->pluck('nombre',  'id');
        $comunas          = Comuna::pluck('nombre', 'id');

        return view('mantenedor.establecimientos.create'
            , compact(
                  'tipoDependencias'
                , 'sostenedores'
                , 'comunas'
                , 'editar'
            ));
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

            if ($request->hasFile('insignia')) {

            }
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
                'correo'            => $request->correo,
                'insignia'          => $request->insignia
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
        $editar = 1;
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
                , 'editar'
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
            'rbd'             => 'required|unique:establecimientos,rbd,'.$id.',id,' ,
            'nombre'          => 'required|max:200',
            'razonSocial'     => 'required|max:150',
            'rut'             => 'required|numeric|unique:establecimientos,rut,'.$id.',id' ,
            'tipoDependencia' => 'required',
            'sostenedor'      => 'required',
            'comuna'          => 'required',
            'direccion'       => 'required|max:250',
            'fono'            => 'required|numeric|max:9999999999',
            'correo'          => 'max:150|email'
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
         $establecimiento->insignia          = $img;

         $mensaje = 'El Establecimiento <b>'.$establecimiento['nombre'].'</b> ha sido editado correctamente';

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

        DB::table('establecimientos')->where('id', $id)->delete();
        $message = 'El establecimiento <b>'.$nombre.'</b> fue eliminado correctamente';
        
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
