<?php

namespace App\Http\Controllers;

use App\Http\Requests\SostenedorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Sostenedor;
use App\Region;
use App\Provincia;
use App\Comuna;

class SostenedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sostenedores.create')->only(['create', 'store']);
        $this->middleware('permission:sostenedores.index')->only(['index']);
        $this->middleware('permission:sostenedores.edit')->only(['edit', 'update']);
        $this->middleware('permission:sostenedores.show')->only(['show']);
        $this->middleware('permission:sostenedores.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.sostenedores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        // $com = DB::table('comunas')                

        //     ->leftJoin('provincias', 'provincias.id', '=', 'comunas.idProvincia')
        //     ->leftJoin('regiones', 'regiones.id', '=', 'provincias.idRegion')
        //     //->where('comunas.estado', 1)
        //     ->orderBy('regiones.id')
        //     ->select(DB::raw('regiones.nombre as nombreRegion, comunas.nombre as nombreComuna, comunas.id as idComuna'))->distinct()->get();

        $comunas = Comuna::pluck('nombre', 'id');
        $editar  = 0;
        return view('mantenedor.sostenedores.create', compact('comunas', 'editar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SostenedorRequest $request)
    {

        if ($request->ajax()) {
            Sostenedor::create([
                'rut'               => $request->rut,
                'nombre'            => $request->nombre,
                'apellidoPaterno'   => $request->apellidoPaterno,
                'apellidoMaterno'   => $request->apellidoMaterno,
                'idComuna'          => $request->comuna,
                'direccion'         => $request->direccion,
                'fono'              => $request->fono,
                'correo'            => $request->correo
                
            ]);

            //MENSAJE
            $mensaje = 'El sostenedor <b>'.$request['rut'].' - '.$request['nombre'].'</b>';
            $mensaje .= ' ha sido agregado correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sostenedor  $sostenedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $sostenedor = Sostenedor::find($id);

        // return view('mantenedor.sostenedores.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sostenedor  $sostenedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editar = 1;
        $sostenedor = Sostenedor::findOrFail($id);

        $comunas = Comuna::pluck('nombre', 'id');

        return view('mantenedor.sostenedores.edit', compact('sostenedor', 'comunas', 'editar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sostenedor  $sostenedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Request()->validate([
            'rut'               => 'required|unique:sostenedors,rut,'.$id.',id' ,
            'nombre'            => 'required|max:200',
            'apellidoPaterno'   => 'required|max:150',
            'apellidoMaterno'   => 'required|max:150',
            'comuna'            => 'required',
            'direccion'         => 'max:250',
            'fono'              => 'numeric|max:9999999999',
            'correo'            => 'max:150|email'
          ]);

         $sostenedor = Sostenedor::findOrFail($id);        
         $sostenedor->rut               = $request->rut;
         $sostenedor->nombre            = $request->nombre;
         $sostenedor->apellidoPaterno   = $request->apellidoPaterno;
         $sostenedor->apellidoMaterno   = $request->apellidoMaterno;
         $sostenedor->idComuna          = $request->comuna;
         $sostenedor->direccion         = $request->direccion;
         $sostenedor->fono              = $request->fono;
         $sostenedor->correo            = $request->correo;

         $mensaje = 'El sostenedor <b>'.Helper::rut($sostenedor['rut']).' - '.$sostenedor['nombre'].'</b>';
         $mensaje .= ' ha sido editado correctamente';

         if ($request->ajax()) {
            $sostenedor->save();
            return response()->json([
                "message" => $mensaje
            ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sostenedor  $sostenedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $rut    = DB::table('sostenedors')->where('id', $id)->value('rut');
        $nombre = DB::table('sostenedors')->where('id', $id)->value('nombre');

        DB::table('sostenedors')->where('id', $id)->delete();

        $texto   = Helper::rut($rut).' - '.$nombre;
        $message = Helper::msgEliminado('M', 'Sostenedor', $texto);    

        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}

