<?php

namespace App\Http\Controllers;

use App\Http\Requests\rrhhFuncionariosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Funcionario;
use App\Establecimiento;
use App\Afp;
use App\salud;
use App\tipo_contrato;
use App\Funcion;
use App\Funcionario_Ley;
use App\Ley;

class FuncionarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:funcionarios.create')->only(['create', 'store']);
        $this->middleware('permission:funcionarios.index')->only(['index']);
        $this->middleware('permission:funcionarios.edit')->only(['edit', 'update']);
        $this->middleware('permission:funcionarios.show')->only(['show']);
        $this->middleware('permission:funcionarios.destroy')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mantenedor.rrhhFuncionarios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editar = 0;

        // PERSONAL
        $estRaw = Establecimiento::selectRaw('CONCAT(rbd, " - " , nombre) as nombre, id')
                                    ->where('estado', '1')
                                    ->get();

        $afpRaw = Afp::select()->where('estado', 1)->get();
        $salRaw = Salud::select()->where('estado', 1)->get();

        $conRaw = tipo_contrato::selectRaw('CONCAT(codigo, " - " , tipoContrato) as nombre, id')
                                  ->where('estado', '1')
                                  ->get();

        $funRaw = Funcion::selectRaw('CONCAT(codigo, " - " , nombre) as nombre, id')
                            ->where('estado', '1')
                            ->get();
        

        $establecimientos = $estRaw->pluck('nombre', 'id');
        $afp              = $afpRaw->pluck('nombre', 'id');
        $salud            = $salRaw->pluck('nombre', 'id');
        $tipoContrato     = $conRaw->pluck('nombre', 'id');
        $funciones        = $funRaw->pluck('nombre', 'id');


        // SUBVENCIONES
        $horas = 0;

        // Consulta Subvenciones
        $arraySubvenciones =    DB::table('leys')
                                ->join('subvencions', 'subvencions.id', '=', 'leys.idSubvencion')             
                                ->selectRaw(' distinct 
                                              subvencions.id as idSubvencion
                                            , subvencions.nombre as nombreSubvencion')
                                ->where('subvencions.id', '>', 0)
                                ->where('leys.tipo', 'Haber')
                                ->orderBy('subvencions.nombre')
                                ->get();

        // Recorre subvenciones ya que por cada subvencion 
        // hay que mostrar sus leyes respectivas
        $funcionarioLey = array();
        foreach ($arraySubvenciones as $key => $subvencion) {
            
            $topeHora = Ley::selectRaw('tope as topeHora ')
                            ->where('idSubvencion', $subvencion->idSubvencion)
                            ->get();       

            // Consulta las leyes según subvención
            $leyes =   Ley::selectRaw('  id as idLey
                                            , codigo as codigoLey
                                            , nombre as nombreLey 
                                            , tope as topeHora ')
                            ->where('idSubvencion', $subvencion->idSubvencion)
                            ->where('tipo', 'Haber')
                            ->get();                            
            $arrayLeyes = array();
            foreach ($leyes as $idLey => $ley) {


                $horasFuncionarios = Funcionario_Ley::selectRaw('sum(horas) as horas')
                            ->where('idLey', $ley->idLey)
                            ->get(); 
            
                $topeHora = $ley->topeHora - $horasFuncionarios[0]['horas'];

                $arrayLeyes[$ley->idLey] = [   
                            'idLey'     => $ley->idLey,
                            'codigoLey' => $ley->codigoLey,
                            'nombreLey' => $ley->nombreLey,
                            'topeHora'  => $topeHora,
                            ];
                
            }

            // dd($arrayLeyes);
            $funcionarioLey[$key] = [   'idSubvencion' => $subvencion->idSubvencion,
                                        'subvencion'   => $subvencion->nombreSubvencion,
                                        'leyes'        => $arrayLeyes 
                                    ];
        }            
        
        return view('mantenedor.rrhhFuncionarios.create'
            , compact(
                  'editar'
                // Personal
                , 'establecimientos'
                , 'afp'
                , 'salud'
                , 'tipoContrato'
                , 'funciones'
                // Subvenciones
                , 'funcionarioLey'
                , 'horas'

            ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);        
        if ($request->ajax()) {                        
            
            // Validaciones
            if ($request->salud == 6) {

                if ($request->tipoContrato == 1) {
                    Request()->validate([
                            'establecimiento'       => 'required',
                            'rut'                   => 'required|numeric|unique:funcionarios',
                            'nombre'                => 'required|max:100',
                            'apellidoPaterno'       => 'required|max:50',
                            'apellidoMaterno'       => 'required|max:50',
                            'afp'                   => 'required',
                            'salud'                 => 'required',                                
                            'tipoContrato'          => 'required',
                            'horasCtoSemanal'       => 'required|numeric|max:44',
                            'fechaInicioContrato'   => 'required',                            
                            'funcion'               => 'required'
                        ]);   
                } else if ($request->tipoContrato == 3) {
                    Request()->validate([
                            'establecimiento'       => 'required',
                            'rut'                   => 'required|numeric|unique:funcionarios',
                            'nombre'                => 'required|max:100',
                            'apellidoPaterno'       => 'required|max:50',
                            'apellidoMaterno'       => 'required|max:50',                           
                            'funcion'               => 'required'
                        ]);   
                    
                } else {
                    {
                    Request()->validate([
                            'establecimiento'       => 'required',
                            'rut'                   => 'required|numeric|unique:funcionarios',
                            'nombre'                => 'required|max:100',
                            'apellidoPaterno'       => 'required|max:50',
                            'apellidoMaterno'       => 'required|max:50',
                            'afp'                   => 'required',
                            'salud'                 => 'required',                                
                            'tipoContrato'          => 'required',
                            'horasCtoSemanal'       => 'required|numeric|max:44',
                            'fechaInicioContrato'   => 'required',
                            'fechaTerminoContrato'  => 'required',
                            'funcion'               => 'required'
                        ]);   
                    
                }
                }
            }  elseif  (empty($request->salud)) {       
                if ($request->tipoContrato == 1) {
                    Request()->validate([
                        'establecimiento'       => 'required',
                        'rut'                   => 'required|numeric|unique:funcionarios',
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',                                
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',                        
                        'funcion'               => 'required'
                    ]);   
                } else if ($request->tipoContrato == 3) {
                    Request()->validate([
                        'establecimiento'       => 'required',
                        'rut'                   => 'required|numeric|unique:funcionarios',
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',                       
                        'funcion'               => 'required'
                    ]);   
                } else {
                    Request()->validate([
                        'establecimiento'       => 'required',
                        'rut'                   => 'required|numeric|unique:funcionarios',
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',                                
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',
                        'fechaTerminoContrato'  => 'required',
                        'funcion'               => 'required'
                    ]);   
                }  
                
            } else {
                if ($request->tipoContrato == 1) {
                    Request()->validate([
                        'establecimiento'       => 'required',
                        'rut'                   => 'required|numeric|unique:funcionarios',
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',            
                        'ufIsapre'              => 'required|numeric|max:6',
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',        
                        'funcion'               => 'required'
                    ]);          

                }  else if ($request->tipoContrato == 3) {
                    Request()->validate([
                        'establecimiento'       => 'required',
                        'rut'                   => 'required|numeric|unique:funcionarios',
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',                       
                        'funcion'               => 'required'
                    ]);   
                } else {
                    Request()->validate([
                        'establecimiento'       => 'required',
                        'rut'                   => 'required|numeric|unique:funcionarios',
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',            
                        'ufIsapre'              => 'required|numeric|max:6',
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',
                        'fechaTerminoContrato'  => 'required',
                        'funcion'               => 'required'
                    ]);                              
                }
            }
            
            // Mensajes de validación
            $messages = [
                'horasCtoSemanal.required' => 'El campo Horas Contrato Semanal es obligatorio.',
                'horasCtoSemanal.max'      => 'El campo Horas Contrato Semanal no puede ser mayor a :max caracteres.',
            ];

            
            // Transaction: Si se cae en el segundo create, 
            // no ingresa los datos del primer create                
            DB::transaction(function () use ($request){

                
                // Formateamos Fechas
                $fechaInicioContrato = date("Y-m-d", strtotime($request->fechaInicioContrato));
                if ($request->fechaTerminoContrato == null) {
                    $fechaTerminoContrato = $request->fechaTerminoContrato;
                } else {
                    $fechaTerminoContrato = date("Y-m-d", strtotime($request->fechaTerminoContrato));                                
                }
                
                // Crea Funcionario            
                $funcionario = Funcionario::Create([
                    'idEstablecimiento'     => $request->establecimiento,
                    'rut'                   => $request->rut,
                    'nombre'                => $request->nombre,
                    'apellidoPaterno'       => $request->apellidoPaterno,
                    'apellidoMaterno'       => $request->apellidoMaterno,
                    'idAfp'                 => $request->afp,
                    'idSalud'               => $request->salud,
                    'idTipoContrato'        => $request->tipoContrato,
                    'ufIsapre'              => $request->ufIsapre,
                    'horasCtoSemanal'       => $request->horasCtoSemanal,
                    'fechaInicioContrato'   => $fechaInicioContrato,
                    'fechaTerminoContrato'  => $fechaTerminoContrato,                
                    'idFuncion'             => $request->funcion
                ]);

                $horas = $request->horas;
                foreach ($horas as $ley => $hora) {     
                    
                    // Crea relacion Funcionario_Ley    
                    Funcionario_Ley::create([
                        'idFuncionario' => $funcionario->id,
                        'idLey' => $ley,
                        'idSubvencion' => $request->idSubvencion[$ley],
                        'horas' => $hora,
                    ]);                
                }

            });

            //MENSAJE
            $mensaje = 'El funcionario <b>'.$request['rut'].' - '.$request['nombre'].'</b> 
                        ha sido agregado correctamente';

            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        return view('mantenedor.rrhhFuncionarios.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editar = 1;

        // PERSONAL 
        $funcionario = Funcionario::findOrFail($id);

        $afpRaw = Afp::select()->where('estado', 1)->get();
        $salRaw = Salud::select()->where('estado', 1)->get();
        $estRaw = Establecimiento::selectRaw('CONCAT(rbd, " - " , nombre) as nombre, id')
                                    ->where('estado', '1')
                                    ->get();

        $conRaw = tipo_contrato::selectRaw('CONCAT(codigo, " - " , tipoContrato) as nombre, id')
                                    ->where('estado', '1')
                                    ->get();

        $funRaw = Funcion::selectRaw('CONCAT(codigo, " - " , nombre) as nombre, id')
                                    ->where('estado', '1')
                                    ->get();
        

        $establecimientos = $estRaw->pluck('nombre', 'id');
        $afp              = $afpRaw->pluck('nombre', 'id');
        $salud            = $salRaw->pluck('nombre', 'id');
        $tipoContrato     = $conRaw->pluck('nombre', 'id');
        $funciones        = $funRaw->pluck('nombre', 'id');


        // SUBVENCIONES

        // Consulta Subvenciones
        $arraySubvenciones =    DB::table('leys')
                                ->join('subvencions', 'subvencions.id', '=', 'leys.idSubvencion')             
                                ->selectRaw(' distinct 
                                              subvencions.id as idSubvencion
                                            , subvencions.nombre as nombreSubvencion')
                                ->where('subvencions.id', '>', 0)
                                ->where('leys.tipo', 'Haber')
                                ->orderBy('subvencions.nombre')
                                ->get();

        // Recorre subvenciones ya que por cada subvencion 
        // hay que mostrar sus leyes respectivas
        $funcionarioLey = array();        
               
        foreach ($arraySubvenciones as $key => $subvencion) {
            

            $topeHora = Ley::selectRaw('tope as topeHora ')
                            ->where('idSubvencion', $subvencion->idSubvencion)
                            ->where('tipo', 'Haber')
                            ->get();       


            // Consulta las leyes según subvención
            $arrayLeyes =   Ley::selectRaw('  id as idLey
                                            , codigo as codigoLey
                                            , nombre as nombreLey
                                            , tope as topeHora ')
                            ->where('idSubvencion', $subvencion->idSubvencion)
                            ->where('tipo', 'Haber')
                            ->get();         

            $leyes = array(); 
            foreach ($arrayLeyes as $keys => $ley) {

                $horasFuncionarios = Funcionario_Ley::selectRaw('sum(horas) as horas')
                            ->where('idLey', $ley->idLey)
                            ->get(); 

                $topeHora = $ley->topeHora - $horasFuncionarios[0]['horas'];


                $hora = 0;
                $hora = Funcionario_Ley::selectRaw('horas, idSubvencion, idLey, idFuncionario, id')
                            ->where('idFuncionario', $id)                            
                            ->where('idLey', $ley->idLey)
                            ->get();  

                if (is_null($hora[0]['horas'])) {
                    $hora = 0;
                } else {
                    $hora = $hora[0]['horas'];
                }

                $leyes[$keys] = [   'idLey'     => $ley->idLey,
                                    'codigoLey' => $ley->codigoLey,
                                    'nombreLey' => $ley->nombreLey,
                                    'horas'     => $hora,
                                    'topeHora'  => $topeHora,
                            ];
            }

            $funcionarioLey[$key] = [   'idSubvencion' => $subvencion->idSubvencion,
                                        'subvencion'   => $subvencion->nombreSubvencion,
                                        'leyes'        => $leyes
                                    ];

        }   

        return view('mantenedor.rrhhFuncionarios.edit'
            , compact(
                  'editar'
                //PERSONAL
                , 'funcionario'
                , 'establecimientos'
                , 'afp'
                , 'salud'
                , 'tipoContrato'
                , 'funciones'
                // SUBVENCIONES
                , 'funcionarioLey'
                , 'horas'
            ));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // Validaciones
        if ($request->salud == 6) {
            if ($request->tipoContrato == 1) {
                Request()->validate([
                        'establecimiento'       => 'required',                    
                        'rut'                   => 'required|unique:funcionarios,rut,'.$id.',id' ,
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',                                
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',                        
                        'funcion'               => 'required'
                    ]);   
            } else if ($request->tipoContrato == 3) {
                    Request()->validate([
                        'establecimiento'       => 'required',
                        'rut'                   => 'required|unique:funcionarios,rut,'.$id.',id' ,
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',                       
                        'funcion'               => 'required'
                    ]);   
            } else {
                Request()->validate([
                        'establecimiento'       => 'required',                    
                        'rut'                   => 'required|unique:funcionarios,rut,'.$id.',id' ,
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',                                
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',
                        'fechaTerminoContrato'  => 'required',
                        'funcion'               => 'required'
                    ]);                   
            }
        }  elseif  (empty($request->salud)) {  
            if ($request->tipoContrato == 1) {
                Request()->validate([
                        'establecimiento'       => 'required',                    
                        'rut'                   => 'required|unique:funcionarios,rut,'.$id.',id' ,
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',                                
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',                        
                        'funcion'               => 'required'
                    ]);   
            } else if ($request->tipoContrato == 3) {
                    Request()->validate([
                        'establecimiento'       => 'required',
                        'rut'                   => 'required|unique:funcionarios,rut,'.$id.',id' ,
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',                       
                        'funcion'               => 'required'
                    ]);   
            } else {
                Request()->validate([
                        'establecimiento'       => 'required',                    
                        'rut'                   => 'required|unique:funcionarios,rut,'.$id.',id' ,
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',                                
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',
                        'fechaTerminoContrato'  => 'required',
                        'funcion'               => 'required'
                    ]);                   
            }
        } else {
            if ($request->tipoContrato == 1) {
                Request()->validate([
                        'establecimiento'       => 'required',                    
                        'rut'                   => 'required|unique:funcionarios,rut,'.$id.',id' ,
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',            
                        'ufIsapre'              => 'required|numeric|max:6',
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',                        
                        'funcion'               => 'required'
                    ]);          
            } else if ($request->tipoContrato == 3) {
                    Request()->validate([
                        'establecimiento'       => 'required',
                        'rut'                   => 'required|unique:funcionarios,rut,'.$id.',id' ,
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',                       
                        'funcion'               => 'required'
                    ]);   
            } else {                
                Request()->validate([
                        'establecimiento'       => 'required',                    
                        'rut'                   => 'required|unique:funcionarios,rut,'.$id.',id' ,
                        'nombre'                => 'required|max:100',
                        'apellidoPaterno'       => 'required|max:50',
                        'apellidoMaterno'       => 'required|max:50',
                        'afp'                   => 'required',
                        'salud'                 => 'required',            
                        'ufIsapre'              => 'required|numeric|max:6',
                        'tipoContrato'          => 'required',
                        'horasCtoSemanal'       => 'required|numeric|max:44',
                        'fechaInicioContrato'   => 'required',
                        'fechaTerminoContrato'  => 'required',
                        'funcion'               => 'required'
                    ]);          
            }
        }
        
        // Mensajes de validación
        $messages = [
            'horasCtoSemanal.required' => 'El campo Horas Contrato Semanal es obligatorio.',
            'horasCtoSemanal.max'      => 'El campo Horas Contrato Semanal no puede ser mayor a :max caracteres.',
        ];

        // DB::transaction(function () use ($request, $id){
        
            // Formateamos Fechas
            $fechaInicioContrato = date("Y-m-d", strtotime($request->fechaInicioContrato));

            if ($request->fechaTerminoContrato == null) {
                $fechaTerminoContrato = $request->fechaTerminoContrato;
            } else {
                $fechaTerminoContrato = date("Y-m-d", strtotime($request->fechaTerminoContrato));                                               
            }
                
            $funcionario = Funcionario::findOrFail($id);        
            $funcionario->idEstablecimiento     = $request->establecimiento;
            $funcionario->rut                   = $request->rut;
            $funcionario->nombre                = $request->nombre;
            $funcionario->apellidoPaterno       = $request->apellidoPaterno;
            $funcionario->apellidoMaterno       = $request->apellidoMaterno;
            $funcionario->idAfp                 = $request->afp;
            $funcionario->idSalud               = $request->salud;
            $funcionario->idTipoContrato        = $request->tipoContrato;
            $funcionario->ufIsapre              = $request->ufIsapre;
            $funcionario->horasCtoSemanal       = $request->horasCtoSemanal;
            $funcionario->fechaInicioContrato   = $fechaInicioContrato;
            $funcionario->fechaTerminoContrato  = $fechaTerminoContrato;
            $funcionario->idFuncion             = $request->funcion;

            $horas = $request->horas;

            foreach ($horas as $ley => $hora) {     
                
                // Crea relacion Funcionario_Ley    
                Funcionario_Ley::where('idFuncionario', $id)
                    ->where('idLey', $ley)
                    ->where('idSubvencion', $request->idSubvencion[$ley])
                    ->update([ 'horas' => $hora ]);
            
            }

            $mensaje = 'El Funcionario <b>'.$request['rut'].' - '.$request['nombre'].'</b>';
            $mensaje .= ' ha sido editado correctamente';    



        // });
       
        if ($request->ajax()) {
            $funcionario->save();
            return response()->json([
                "message" => $mensaje
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $nombre = DB::table('funcionarios')->where('id', $id)->value('nombre');
        $rut = DB::table('funcionarios')->where('id', $id)->value('rut');

        DB::table('funcionario_ley')->where('idFuncionario', $id)->delete();   
        DB::table('funcionarios')->where('id', $id)->delete();   

        $texto   = Helper::rut($rut).' - '.$nombre;     
        $message = Helper::msgEliminado('M', 'Funcionario', $texto);

        if ($request->ajax()) {
            
            return response()->json([
               'id'        => $id,
               'message'   => $message
            ]);
        }
    }
}
