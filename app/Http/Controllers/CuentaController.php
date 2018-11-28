<?php

namespace App\Http\Controllers;

use App\Http\Requests\GastosCuentasRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Cuenta;
use App\Subvencion;
use App\CuentaSubvencion;

class CuentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:cuentas.create')->only(['create', 'store']);
        $this->middleware('permission:cuentas.index')->only(['index']);
        $this->middleware('permission:cuentas.edit')->only(['edit', 'update']);
        $this->middleware('permission:cuentas.show')->only(['show']);
        $this->middleware('permission:cuentas.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.gastosCuentas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editar = 0;
        $subRaw = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
                    ->where('estado', '1')->where('id','>', 0)->get();
        
        $subvenciones = $subRaw->pluck('nombre',  'id');        
        
        return view('mantenedor.gastosCuentas.create', compact('subvenciones', 'editar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GastosCuentasRequest $request)
    {
        
        if ($request->ajax()) {

            $cuenta = Cuenta::create([
                'codigo'         => $request->codigo,
                'nombre'         => $request->nombre,
                'descripcion'    => $request->descripcion,
            ]);
            
            //Agregamos relación cuenta subvenciones
            $subvencion = $request->subvenciones;            
            foreach ($subvencion as $key => $value) {
                $cuentaSubvencion = CuentaSubvencion::create([
                    'idCuenta'     => $cuenta->id,
                    'idSubvencion' => $value,                    
                ]);
            }           
            
            //MENSAJE
            $mensaje = 'La cuenta <b>'.$request['codigo'].' - '.$request['nombre'].'</b>';
            $mensaje .= ' ha sido agregada correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editar = 1;
        $cuenta = Cuenta::findOrFail($id);

        $subRaw = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
                    ->where('estado', '1')->where('id','>', 0)->get();
        $subvenciones = $subRaw->pluck('nombre',  'id'); 


        $csRaw  = DB::table('cuenta_subvencion')
                    ->selectRaw('subvencions.id as idSub')
                    ->leftJoin('subvencions', 'cuenta_subvencion.idSubvencion', '=', 'subvencions.id')
                    ->where('cuenta_subvencion.idCuenta', $id)->get();
        $cuentaSub = $csRaw->pluck('idSub');         

        return view('mantenedor.gastosCuentas.edit', 
            compact(  'cuenta'
                    , 'editar'
                    , 'subvenciones'
                    , 'cuentaSub'
                ));            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Request()->validate([
            'codigo'        => 'required|max:10|unique:cuentas,codigo,'.$id.',id' ,
            'nombre'        => 'required|max:100',
            'descripcion'   => 'required',
            'subvenciones'  => 'required|array'
          ]);

        $cuenta = Cuenta::findOrFail($id);        
        $cuenta->codigo       = $request->codigo;
        $cuenta->nombre       = $request->nombre;         
        $cuenta->descripcion  = $request->descripcion;      

        //Elimina relación cuenta - subvencion
        $subvenciones = CuentaSubvencion::where('idCuenta', '=' , $id);
        $subvenciones->delete();

        //Agrega cuenta - subvencion
        $subvencion = $request->subvenciones;        
        foreach ($subvencion as $key => $idSubvencion) {
            $cuentaSubvencion = CuentaSubvencion::create([
                'idCuenta'     => $cuenta->id,
                'idSubvencion' => $idSubvencion,                    
            ]);
        }      
        
        $mensaje = 'La cuenta <b>'.$cuenta['codigo'].' - '.$cuenta['nombre'].'</b> ha sido editada correctamente';
        if ($request->ajax()) {
            $cuenta->save();
            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $nombre = DB::table('cuentas')->where('id', $id)->value('nombre');
        $codigo = DB::table('cuentas')->where('id', $id)->value('codigo');
       
        DB::table('cuentas')->where('id', $id)->update(['estado' => 0]);
        $message = 'La cuenta <b>'.$codigo.' - '.$nombre.'</b> fue eliminada correctamente';
        
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
