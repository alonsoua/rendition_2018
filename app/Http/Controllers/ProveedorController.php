<?php

namespace App\Http\Controllers;

use App\Http\Requests\GastosProveedoresRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Proveedor;
use App\Comuna;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:proveedores.create')->only(['create', 'store']);
        $this->middleware('permission:proveedores.index')->only(['index']);
        $this->middleware('permission:proveedores.edit')->only(['edit', 'update']);
        $this->middleware('permission:proveedores.show')->only(['show']);
        $this->middleware('permission:proveedores.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.gastosProveedores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editar = 0;
        $comunas = Comuna::pluck('nombre', 'id');
        $telefono = '';
        
        return view('mantenedor.gastosProveedores.create', compact('comunas', 'telefono', 'editar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GastosProveedoresRequest $request)
    {
        if ($request->ajax()) {
            Proveedor::create([
                'tipoPersona' => $request->tipoPersona,
                'rut'         => $request->rut,
                'razonSocial' => $request->razonSocial,
                'giro'        => $request->giro,
                'idComuna'    => $request->comuna,
                'direccion'   => $request->direccion,
                'fono'        => $request->telefono,
                'correo'      => $request->correo
            ]);

            //MENSAJE
            $mensaje = 'El proveedor <b>'.$request['rut'].' - '.$request['razonSocial'].'</b>';
            $mensaje .= ' ha sido agregado correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editar = 1;
        $proveedor = Proveedor::findOrFail($id);
        $telefono = $proveedor->fono;
        // $subRaw       = Subvencion::selectRaw('CONCAT(porcentajeMax, "% - " , nombre) as nombre, id')
        //                 ->where('estado', '1')->get();
        // $subvenciones = $subRaw->pluck('nombre',  'id'); 

        $comunas = Comuna::pluck('nombre', 'id');

        return view('mantenedor.gastosProveedores.edit', compact('proveedor', 'comunas', 'telefono', 'editar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Request()->validate([
            'tipoPersona'   => 'required',
            'rut'           => 'required|unique:proveedors,rut,'.$id.',id' ,
            'razonSocial'   => 'required|max:100',
            'giro'          => 'max:45',
            'comuna'        => 'required',
            'direccion'     => 'required|max:250',
            'telefono'      => 'required|numeric|max:9999999999',
            'correo'        => 'max:150|email|min:0'

          ]);

            $proveedor = Proveedor::findOrFail($id);        
            $proveedor->tipoPersona = $request->tipoPersona;
            $proveedor->rut         = $request->rut;
            $proveedor->razonSocial = $request->razonSocial;         
            $proveedor->giro        = $request->giro;
            $proveedor->idComuna    = $request->comuna;
            $proveedor->direccion   = $request->direccion;
            $proveedor->fono        = $request->telefono;
            $proveedor->correo      = $request->correo;

            $mensaje = 'El proveedor <b>'.$proveedor['rut'].' - '.$proveedor['razonSocial'].'</b> ';
            $mensaje .= 'ha sido editado correctamente';

            if ($request->ajax()) {
                $proveedor->save();
                return response()->json([
                    "message" => $mensaje
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $rut         = DB::table('proveedors')->where('id', $id)->value('rut');
        $razonSocial = DB::table('proveedors')->where('id', $id)->value('razonSocial');
       
        DB::table('proveedors')->where('id', $id)->delete();

        $texto   = Helper::rut($rut).' - '.$razonSocial;
        $message = Helper::msgEliminado('M', 'Proveedor', $texto);        
        
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
