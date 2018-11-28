<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use Caffeinated\Shinobi\Models\Role;
use App\User;
use App\role_user;



//use App\Http\Requests\UsuarioRequest;

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
        $editar = 0;
        $pass   = null;
        $nombre = null;
        $correo = null;

        $rolRaw = Role::selectRaw('CONCAT(name, " (" , description, ")" ) as nombre, id')->get();        
        $roles  = $rolRaw->pluck('nombre', 'id');

        return view('administrador.users.create', compact('pass', 'nombre', 'correo', 'roles', 'editar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($request->ajax()) {
            $usuario = User::create([
                'sostenedor'      => $request['sostenedor'],
                'sostenedor'      => $request['sostenedor'],
                'rut'             => $request['rut'],
                'password'        => bcrypt($request->password),
                'name'            => $request['nombre'],
                'apellidoPaterno' => $request['apellidoPaterno'],
                'apellidoMaterno' => $request['apellidoMaterno'],                
                'direccion'       => $request['direccion'],
                'email'           => $request['correo']
            ]);

            $usuario->roles()->sync($request->get('rol'));

            $mensaje = 'El usuario <b>'.Helper::rut($request['rut']).' - '.$request['nombre'].'</b> ha sido agregado correctamente';
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
        $editar  = 1;
        $usuario = User::findOrFail($id);
        $roleRaw = Role_user::selectRaw('role_id')->where('user_id', $id)->get();
        $rol     = $roleRaw->pluck('role_id');
        $pass    = $usuario->pass;
        $nombre  = $usuario->name;
        $correo  = $usuario->email;

        $rolRaw = Role::selectRaw('CONCAT(name, " (" , description, ")" ) as nombre, id')->get();        
        $roles  = $rolRaw->pluck('nombre', 'id');

        return view('administrador.users.edit', 
            compact(  'pass'
                    , 'nombre'
                    , 'correo'
                    , 'usuario'
                    , 'roles'
                    , 'editar'
                    , 'rol'
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

        request()->validate([
            'rol'               => 'required',
            'rut'               => 'required|numeric|unique:users,rut,'.$id.',id' ,
            'password'          => 'required|max:50',
            'nombre'            => 'required|max:200',
            'apellidoPaterno'   => 'required|max:150',
            'apellidoMaterno'   => 'max:150',
            'direccion'         => 'max:200',
            'correo'            => 'required|email|unique:users,email,'.$id.',id'
          ]);

        $usuario = User::findOrFail($id);
        $usuario->sostenedor      = $request->sostenedor;
        $usuario->rut             = $request->rut;
        $usuario->password        = bcrypt($request->password);
        $usuario->name            = $request->nombre;
        $usuario->apellidoPaterno = $request->apellidoPaterno;
        $usuario->apellidoMaterno = $request->apellidoMaterno;
        $usuario->direccion       = $request->direccion;
        $usuario->email           = $request->correo;


        $mensaje = 'El usuario <b>'.Helper::rut($usuario['rut']).' - '.$request['nombre'].'</b>';
        $mensaje .= ' ha sido editado correctamente';

        if ($request->ajax()) {
            $usuario->save();
            $usuario->roles()->sync($request->get('rol'));
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
        $rut    = DB::table('users')->where('id', $id)->value('rut');
        $nombre = DB::table('users')->where('id', $id)->value('name');

        DB::table('users')->where('id', $id)->update(['estado' => 0]);
        $message = 'El usuario con <b>'.Helper::rut($rut).' - '.$nombre.'</b> fue eliminado correctamente';
        if ($request->ajax()) {
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
