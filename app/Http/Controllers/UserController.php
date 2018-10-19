<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:users.create')->only(['create', 'store']);
        $this->middleware('permission:users.index')->only(['index']);
        $this->middleware('permission:users.edit')->only(['edit', 'update']);
        $this->middleware('permission:users.show')->only(['show']);
        $this->middleware('permission:users.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrador.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            Usuario::create([
                'sostenedor'=> $request['sostenedor'],
                'rut'       => $request['rut'],
                'password'  => encrypt($request['password']),
                'name'      => $request['name'],
                'direccion' => $request['direccion'],
                'email'     => $request['email']
            ]);

            $mensaje = 'El usuario con rut <b>'.Helper::rut($request['rut']).'</b> ha sido agregado correctamente';
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
        $usuarios = Usuario::find($id);
        return view('administrador.users.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('administrador.users.edit')->with('usuario', $usuario);
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
        request()->validate([
            'rut'       => 'required|numeric|unique:users,rut,'.$id.',id' ,
            'pass'      => 'max:50',
            'nombre'    => 'required|max:60',
            'direccion' => 'max:200',
            'correo'    => 'required|max:150|email'
          ]);

         $usuario = Usuario::findOrFail($id);
         $usuario->sostenedor = $request->sostenedor;
         $usuario->rut        = $request->rut;
         $usuario->pass       = encrypt($request->pass);
         $usuario->nombre     = $request->nombre;
         $usuario->direccion  = $request->direccion;
         $usuario->correo     = $request->correo;

         $mensaje = 'El usuario con rut <b>'.Helper::rut($usuario['rut']).'</b> ha sido editado correctamente';

         if ($request->ajax()) {
            $usuario->save();
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
    public function destroy($id)
    {
        $rut = DB::table('users')->where('id', $id)->value('rut');
         DB::table('users')->where('id', $id)->update(['activo' => 0]);
         $message = 'El usuario con rut <b>'.Helper::rut($request['rut']).'</b>  fue eliminado correctamente';
         if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
         }
    }
}
