<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstablecimientoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Helpers\Helper;

// use App\Http\Requests\ImportTypeRequest;

use App\Establecimiento;
use App\tipo_dependencia;
use App\Sostenedor;
use App\Comuna;
// use Input;
use Illuminate\Support\Facades\Input;
// use App\Input;

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
    

    function SubirImagen(){
        $id     = Input::post('id');
        $file   = Input::file('avatar');
        $nombre = uniqid().".jpg";
        \Storage::disk('public')->put($nombre,  \File::get($file));
        $model = new preguntasModel();
        $respuesta = $model->ActualizarFotoPerfil($id, $nombre);
        return response()->json($respuesta);
    }

    public function store(Request $request)
    {
        
            dd($request->all(), $request->hasFile('image'));
        if ($request->ajax()) {

            // $id     = Input::post('id');
            // $foto = $request->photo->store('insignia');
            $file = Input::file('insignia');

            // $img = $request->file('insignia')->store('fields');
            $ins = $request->file('insignia');
            // dd($request->hasFile('insignia'));

            // $insig ->all= $request->file('insig'->all);

            
            $establecimiento = Establecimiento::create([
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
            ]);

            // $path = $request->file('avatar')->store('avatars');
            if ($request->file('insignia')) {
                $path = Storage::disk('public')->put('image', $request->file('file'));
                $$establecimiento->fill(['insignia' => asset($path)])->save();
            }

            // $post->tags()->sync($request->get)
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
        
        
        // $path = 'upload/'; //Este path es la carpeta donde se subira la imágen
        // $file = Input::file('imagen');
        dd($request->file('insig'));
        dd($request->all());
        Request()->validate([
            'rbd'             => 'required|unique:establecimientos,rbd,'.$id.',id' ,
            'nombre'          => 'required|max:200',
            'razonSocial'     => 'required|max:150',
            'rut'             => 'required|unique:establecimientos,rut,'.$id.',id' ,
            'rut'                 => 'required|unique:funcionarios,rut,'.$id.',id' ,
            'tipoDependencia' => 'required',
            'sostenedor'      => 'required',
            'comuna'          => 'required',
            'direccion'       => 'required|max:250',
            'fono'            => 'required|numeric|max:9999999999',
            'correo'          => 'max:150|email',
            
          ]);

        dd($request->file('insignia'));

        // $establecimiento = Establecimiento::findOrFail($id);

        // $establecimiento->fill($request->all())->save;

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
        //$establecimiento->insignia          = $img;

        if ($request->file('insignia')) {
            $path = Storage::disk('public')->put('image', $request->file('insignia'));
            $establecimiento->fill(['insignia' => asset($path)])->save();
        }
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
        $message = Helper::msgEliminado('M', 'Establecimiento', $nombre);

        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
