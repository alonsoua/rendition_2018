<?php

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Helper;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//RUTAS
Route::middleware(['auth'])->group( function () {

    Route::get('/', function () {
        return view('main');
    });

    Route::group(['prefix' => 'admin'], function () {
        //Usuarios
        Route::resource('users', 'UserController');
        //Roles
      	//Route::resource('roles', 'RolController');
   	});

   	Route::group(['prefix' => 'mantenedores'], function () {
    	//Sostenedores
      	Route::resource('sostenedores', 'SostenedorController');
   	});
});

//Users permisos
Route::get('usersPermisos', function(){

   return datatables()
   ->eloquent(User::query()->where('estado', 1)->orderBy('name'))
   ->addColumn('opciones', 'administrador.users.partials.opciones')
   ->rawColumns(['opciones'])
   ->toJson();

});