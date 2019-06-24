<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use App\User;
use App\role_user;



class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles.create')->only(['create', 'store']);
        $this->middleware('permission:roles.index')->only(['index']);
        $this->middleware('permission:roles.edit')->only(['edit', 'update']);
        $this->middleware('permission:roles.show')->only(['show']);
        $this->middleware('permission:roles.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrador.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editar = 0;
      
        $permissions      = Permission::get();
       
        $permissionsAdmin = Permission::selectRaw('distinct description')
                            ->where('id', '<=', 99)
                            ->get();

        $permissionsMante = Permission::selectRaw('distinct description')
                            ->where('id', '>=', 100)
                            ->where('id', '<=', 199)
                            ->get();

        $permissionsGasto = Permission::selectRaw('distinct description')
                            ->where('id', '>=', 200)
                            ->where('id', '<=', 299)
                            ->get();

        $permissionsRrhh  = Permission::selectRaw('distinct description')
                            ->where('id', '>=', 300)
                            ->where('id', '<=', 399)                            
                            ->get();

        return view('administrador.roles.create',
        compact( 
                  'editar'
                , 'permissions'
                , 'permissionsAdmin'
                , 'permissionsMante'
                , 'permissionsGasto'
                , 'permissionsRrhh'
                ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {        
        if ($request->ajax()) {
            
            //Mensajes de validación
            $messages = [
                'name.required' => 'El campo nombre es obligatorio.',
                'name.max'      => 'El campo nombre no puede ser mayor a :max caracteres.',
            ];

            //Creamos el rol
            $role = Role::create([                
                'name'        => $request->name,     
                'slug'        => $request->name,
                'description' => $request->descripcion
            ]);

            //Actualizar permisos desde el la variable $role del rol creado
            $role->permissions()->sync($request->get('permissions'));

            //MENSAJE
            $mensaje = 'El rol <b>'.$request['name'].'</b>';
            $mensaje .= ' ha sido agregado correctamente';

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
        $editar = 1;
        
        $roles  = Role::findOrFail($id);

        $permissions      = Permission::get();
       
        $permissionsAdmin = Permission::selectRaw('distinct description')
                            ->where('id', '<=', 99)
                            ->get();

        $permissionsMante = Permission::selectRaw('distinct description')
                            ->where('id', '>=', 100)
                            ->where('id', '<=', 199)
                            ->get();

        $permissionsGasto = Permission::selectRaw('distinct description')
                            ->where('id', '>=', 200)
                            ->where('id', '<=', 299)
                            ->get();

        $permissionsRrhh  = Permission::selectRaw('distinct description')
                            ->where('id', '>=', 300)
                            ->where('id', '<=', 399)
                            ->get();

        return view('administrador.roles.edit',
        compact( 
                  'roles'
                , 'editar'
                , 'permissions'
                , 'permissionsAdmin'
                , 'permissionsMante'
                , 'permissionsGasto'
                , 'permissionsRrhh'
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
        //Request de validación
        Request()->validate([            
            'name'        => 'required|max:120|unique:roles,name,'.$id.',id',
            'descripcion' => 'required'
        ]);

        //Mensaje de validación
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max'      => 'El campo nombre no puede ser mayor a :max caracteres.',
        ];
        
        //Actualizar rol        
        $role = Role::findOrFail($id);  
        $role->name        = $request->name;    
        $role->slug        = $request->name;    
        $role->description = $request->descripcion;

        //MENSAJE
        $mensaje = 'El rol con nombre <b>'.$role['name'].'</b> ha sido editado correctamente';

        if ($request->ajax()) {   
            $role->save();         
            
            //Actualizar permisos
            $role->permissions()->sync($request->get('permissions'));
            
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

        // Consulta si el rol está asignado a usuarios
        $count = role_user::selectRaw('count(id) as count')
                            ->where('role_id', $id)
                            ->get();

        
        // Si está asignado setea id y message
        // de lo contrario elimina con normalidad.
        // La libreria auth no instala claves foraneas en las tablas que crea, 
        // por eso se verifica de esta manera.
        if ($count[0]['count'] > 0) {                  
          
          $id      = 0;
          $message = 0;

        } else {

          $nombre = DB::table('roles')->where('id', $id)->value('name');
          DB::table('roles')->where('id', $id)->delete();
          
          $message = Helper::msgEliminado('M', 'Rol', $nombre);                            
        }

        if ($request->ajax()) {
          return response()->json([
             'id'        => $id,
             'message'   => $message
          ]);
        }                  
    }
}
