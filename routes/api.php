<?php

use Illuminate\Http\Request;

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

Route::apiResource('users', 'UsersController');
Route::post('users/login','UsersController@login');
Route::apiResource('aulas', 'AulasController');
Route::apiResource('articulos', 'ArticulosController');
Route::get('aulas/{aula}/articulos','AulasController@articulos');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
