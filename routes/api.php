<?php

use Illuminate\Http\Request;
use App\Usuario;
use App\User;
use App\Helpers\Helper;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('users', function(){

   return datatables()
   ->eloquent(User::query()->where('activo', 1)->orderBy('name'))
   ->addColumn('opciones', 'administrador.users.partials.opciones')
   ->rawColumns(['opciones'])
   ->toJson();

});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
