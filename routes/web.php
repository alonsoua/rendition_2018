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
| // Route::get('/home', 'HomeController@index')->name('home');
|
*/

use Illuminate\Http\Request;
use App\Helpers\Helper;

/* Modelos */
use App\User;
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


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Rutas del men?
Route::middleware(['auth'])->group( function () {

    Route::get('/', function () {
        return view('main');
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
        //ReportesGastos
        Route::resource('reportesgastos', 'ReporteGastoController');       

    });

    //Menu rrhh
    Route::group(['prefix' => 'rrhh'], function () {
        
        //Imputaciones
        Route::resource('liquidaciones', 'LiquidacionController');
        //ReportesGastos
        Route::resource('reportesrrhh', 'ReporteRrhhController');       

    });

});

/* ADMINISTRACIÓN */

    //Users Table
    Route::get('usersTable', function(){

        return datatables()
        ->eloquent(User::query()->where('estado', 1)->orderBy('name'))
        ->addColumn('opciones', 'administrador.users.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();

    });

/* FIN ADMINISTRACIÓN */


/* MANTENEDORES */
    
    //Sostenedores Table
    Route::get('sostenedoresTable', function(){

       return datatables()
       ->eloquent(Sostenedor::query()->where('estado', 1)->orderBy('rut'))
       ->addColumn('opciones', 'mantenedor.sostenedores.partials.opciones')
       ->rawColumns(['opciones'])
       ->toJson();

    });

    //Establecimientos Table
    Route::get('establecimientosTable', function(){

        $establecimiento = Establecimiento::with('sostenedor')->select('establecimientos.*')->where('estado', 1)->orderBy('nombre');

        return datatables()
        ->eloquent($establecimiento)
        ->addColumn('opciones', 'mantenedor.establecimientos.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();


    });

    //Subvenciones Table
    Route::get('subvencionesTable', function(){

       return datatables()
       ->eloquent(Subvencion::query()->where('estado', 1)->orderBy('nombre'))
       ->addColumn('opciones', 'mantenedor.subvenciones.partials.opciones')
       ->rawColumns(['opciones'])
       ->toJson();

    });

    //Leyes Table
    Route::get('leyesTable', function(){

        $leyes = Ley::with('subvencion')->select('leys.*')->where('estado', 1)->orderBy('nombre');
        return datatables()
        ->eloquent($leyes)
        ->addColumn('opciones', 'mantenedor.leyes.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();

    });


    /* GASTOS */
    
      //Cuentas Table
      Route::get('cuentasTable', function(){

         return datatables()
         ->eloquent(Cuenta::query()->where('estado', 1)->orderBy('nombre'))
         ->addColumn('subvencion', 'Relacion Subvencion')
         ->rawColumns(['subvencion'])
         ->addColumn('opciones', 'mantenedor.gastosCuentas.partials.opciones')
         ->rawColumns(['opciones'])
         ->toJson();

      });

      //Proveedores Table
      Route::get('proveedoresTable', function(){

         return datatables()
         ->eloquent(Proveedor::query()->where('estado', 1)->orderBy('razonSocial'))
         ->addColumn('opciones', 'mantenedor.gastosProveedores.partials.opciones')
         ->rawColumns(['opciones'])
         ->toJson();

      });

      //Documentos Table
      Route::get('documentosTable', function(){

         return datatables()
         ->eloquent(Documento::query()->where('estado', 1)->orderBy('nombre'))
         ->addColumn('opciones', 'mantenedor.gastosDocumentos.partials.opciones')
         ->rawColumns(['opciones'])
         ->toJson();

      });
    /* FIN GASTOS */

    
    /* RRHH */  

      //Funciones Table
      Route::get('funcionesTable', function(){

         return datatables()
         ->eloquent(Funcion::query()->where('estado', 1)->orderBy('nombre'))
         ->addColumn('opciones', 'mantenedor.rrhhFunciones.partials.opciones')
         ->rawColumns(['opciones'])
         ->toJson();

      });

      //Funcionarios Table
      Route::get('funcionariosTable', function(){

        $funcionarios = Funcionario::with('establecimiento', 'tipo_contrato', 'funcion')->select('funcionarios.*')->where('funcionarios.estado', 1)->orderBy('funcionarios.nombre');
        
        return datatables()
        ->eloquent($funcionarios)             
        ->addColumn('opciones', 'mantenedor.rrhhFuncionarios.partials.opciones')
        ->rawColumns(['opciones'])
        ->toJson();

      });
    /* FIN RRHH */
/* FIN MANTENEDORES */