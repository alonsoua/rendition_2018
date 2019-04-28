<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
|
*/

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

/* Modelos */
use App\User;
use Caffeinated\Shinobi\Models\Role;
use App\Sostenedor;
use App\Establecimiento;
use App\Subvencion;
use App\Ley;
use App\Cuenta;
use App\Proveedor;
use App\Documento;
use App\Funcion;
use App\Funcionario;
use App\tipo_contrato;
use App\Imputacion;
use App\Liquidacion;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Rutas del men?
Route::middleware(['auth'])->group( function () {

    Route::get('/', function () {
        return view('inicio.index');
    });

    //Menu Administraci?
    Route::group(['prefix' => 'admin'], function () {
        
        //Usuarios
        Route::resource('users', 'UserController');

        //Roles
      	Route::resource('roles', 'RolController');

   	});

    //Menu Mantenedores
   	Route::group(['prefix' => 'mantenedores'], function () {
    	  
        //Sostenedores
      	Route::resource('sostenedores', 'SostenedorController');        
        //Establecimientos
        Route::resource('establecimientos', 'EstablecimientoController');
        //Subvenciones
        Route::resource('subvenciones', 'SubvencionController');
        //Leyes
        Route::resource('leyes', 'LeyController');
        //CargaMensual
        Route::resource('cargamensual', 'CargaMensualController');        
        //CalculoHoras
        Route::resource('calculohoras', 'CalculoHoraController');
          //Periodos en CalculoHoras
          Route::get('lst-periodos', 'CalculoHoraController@periodos');
          //cargaLeyes en CalculoHoras
          Route::get('lst-cargaLeyes', 'CalculoHoraController@cargaLeyes');
          //getDetalleMarzo
          Route::get('getDetalleMarzo', 'CalculoHoraController@detalleMarzo');
          //getAnteriorRegistro
          Route::get('getAnteriorRegistro', 'CalculoHoraController@getAnteriorRegistro');
          

        /* Gastos */
        //Cuentas
        Route::resource('cuentas', 'CuentaController');
        //Proveedores
        Route::resource('proveedores', 'ProveedorController');
        //Documentos
        Route::resource('documentos', 'DocumentoController');

        /* RR.HH */
        //Funciones
        Route::resource('funciones', 'FuncionController');
        //Funcionarios
        Route::resource('funcionarios', 'FuncionarioController');

   	});

    //Menu Gastos
    Route::group(['prefix' => 'gastos'], function () {
        
        //Imputaciones
        Route::resource('imputaciones', 'ImputacionController');
          //carga Cuentas en Imputaciones          
          Route::get('imputaciones/getCuentas/{id}', 'ImputacionController@getCuentas');

          //carga Documentos en Imputaciones          
          Route::get('imputaciones/getDocumentos/{id}', 'ImputacionController@getDocumentos');

          //carga Funcionarios en Imputaciones          
          Route::get('imputaciones/getFuncionarios/{id}', 'ImputacionController@getFuncionarios');
          Route::get('imputaciones/{idImputacion}/getFuncionarios/{id}', 'ImputacionController@getFuncionarios');

          //Modifica estado de imputación
          Route::get('modificarEstado/{id}/{estado}', 'ImputacionController@modificarEstado');
          
        //ReportesGastos
        Route::resource('reportesgastos', 'ReporteGastoController');       

    });


    //Menu RRHH
    Route::group(['prefix' => 'rrhh'], function () {
        
        //Liquidaciones
        Route::resource('liquidaciones', 'LiquidacionController');
          Route::get('liquidaciones/getFuncionarios/{id}', 'LiquidacionController@getFuncionarios');

          Route::get('liquidaciones/getPeriodos/{id}', 'LiquidacionController@getPeriodos');

          //horasContrato          
          Route::get('liquidaciones/horasContrato/{idFuncionario}/{idEstablecimiento}/{idPeriodo}', 'LiquidacionController@horasContrato');


        
        //ReportesRRHH
        Route::resource('reportesrrhh', 'ReporteRrhhController');       

    });

});


/* ADMINISTRACIÓN */

    //Users Table
    Route::get('usersTable', function(){

        return datatables()
        ->eloquent(User::query())
        ->addColumn('opciones', 'administrador.users.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();

    });

    //Roles Table
    Route::get('rolesTable', function(){

        return datatables()
        ->eloquent(Role::query())
        ->addColumn('opciones', 'administrador.roles.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();

    });
/* FIN ADMINISTRACIÓN */


/* MANTENEDORES */
    
    //Sostenedores Table
    Route::get('sostenedoresTable', function(){

       return datatables()
       ->eloquent(Sostenedor::query())
       ->addColumn('opciones', 'mantenedor.sostenedores.partials.opciones')
       ->rawColumns(['opciones'])
       ->toJson();

    });

    //Establecimientos Table
    Route::get('establecimientosTable', function(){

        $establecimiento = Establecimiento::with('sostenedor')->select('establecimientos.*');

        return datatables()
        ->eloquent($establecimiento)
        ->addColumn('opciones', 'mantenedor.establecimientos.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();


    });

    //Subvenciones Table
    Route::get('subvencionesTable', function(){

       return datatables()
       ->eloquent(Subvencion::query()->where('id','>', 0))
       ->addColumn('opciones', 'mantenedor.subvenciones.partials.opciones')
       ->rawColumns(['opciones'])
       ->toJson();

    });

    //Leyes Table
    Route::get('leyesTable', function(){

        $leyes = Ley::with('subvencion')->select('leys.*');
        return datatables()
        ->eloquent($leyes)
        ->addColumn('opciones', 'mantenedor.leyes.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();

    });


    /* GASTOS */
    
      //Cuentas Table
      Route::get('cuentasTable', function(){

         $cuenta  = Cuenta::selectRaw(' 

                              DISTINCT 
                                cuentas.id as id
                              , cuentas.codigo as codigo
                              , cuentas.nombre as nombre
                              , GROUP_CONCAT(" ", subvencions.nombre) as NombreSubvencion                                                 
                              ')
                    ->leftJoin('cuenta_subvencion', 'cuentas.id', '=', 'cuenta_subvencion.idCuenta')
                    ->leftJoin('subvencions', 'cuenta_subvencion.idSubvencion', '=', 'subvencions.id')                   
                    ->groupby('cuentas.id', 'cuentas.codigo', 'cuentas.nombre');                                
                   
         return datatables()
          ->eloquent($cuenta)         
         ->addColumn('opciones', 'mantenedor.gastosCuentas.partials.opciones')
         ->rawColumns(['opciones'])
         ->toJson();

      });

      //Proveedores Table
      Route::get('proveedoresTable', function(){

         return datatables()
         ->eloquent(Proveedor::query())
         ->addColumn('opciones', 'mantenedor.gastosProveedores.partials.opciones')
         ->rawColumns(['opciones'])
         ->toJson();

      });

      //Documentos Table
      Route::get('documentosTable', function(){

         return datatables()
         ->eloquent(Documento::query())
         ->addColumn('opciones', 'mantenedor.gastosDocumentos.partials.opciones')
         ->rawColumns(['opciones'])
         ->toJson();

      });
    /* FIN GASTOS */

    
    /* RRHH */  

      //Funciones Table
      Route::get('funcionesTable', function(){

         return datatables()
         ->eloquent(Funcion::query())
         ->addColumn('opciones', 'mantenedor.rrhhFunciones.partials.opciones')
         ->rawColumns(['opciones'])
         ->toJson();

      });

      //Funcionarios Table
      Route::get('funcionariosTable', function(){

        $funcionarios = Funcionario::with('establecimiento', 'tipo_contrato', 'funcion')->select('funcionarios.*');
        
        return datatables()
        ->eloquent($funcionarios)             
        ->addColumn('opciones', 'mantenedor.rrhhFuncionarios.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();

      });
    /* FIN RRHH */
/* FIN MANTENEDORES */


/* GASTOS */

      //Imputaciones Table
      Route::get('imputacionesTable', function(){

        $imputaciones = Imputacion::with('establecimiento', 'cuenta', 'subvencion', 'documento', 'proveedor')
                                    ->select('imputacions.*');     

        return datatables()
        ->eloquent($imputaciones)             
        ->addColumn('opciones', 'gastos.imputaciones.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();

      });
/* FIN GASTOS */


/* RRHH */

      //Liquidaciones Table
      Route::get('liquidacionesTable', function(){

        $liquidaciones = Liquidacion::select('liquidacions.*')
                              ->with('funcionario', 'establecimiento', 'periodo');

        return datatables()
        ->eloquent($liquidaciones)             
        ->addColumn('opciones', 'RRHH.liquidaciones.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();
      });
/* FIN RRHH */