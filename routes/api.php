<?php


use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'marcadores'],
    function () {
        Route::get('all', 'MarcadorController@index');
        Route::delete('delete/{id}', 'MarcadorController@destroy');
        Route::get('/show/{name}', 'MarcadorController@show');
        Route::get('/showlocation/{id}', 'MarcadorController@marcadorLocation');
        Route::post('update/{id}', 'MarcadorController@updateUbicacion');
        Route::get('near/{id}/scope/{scope?}', 'MarcadorController@marcadoresCercanos');
        Route::post('create', 'MarcadorController@crearMarcador');

    });