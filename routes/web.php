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
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('desactivado');
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


Route::group(['middleware' => ['auth'], 'middleware' => ['desactivado']], function () {

  Route::group(['middleware' => 'administrador'], function () {

    Route::get('user-desactivar/{doc}', 'HomeController@desactivar');
    Route::resource('clientes', 'Actividad\Client\FinalController', ['except' => ['show']]);
    Route::get('sedes/{id}/edit', 'Actividad\Client\SedeController@edit');
    Route::put('sedes/{id}', 'Actividad\Client\SedeController@update');
    Route::get('actividades-client/{id}/edit', 'Actividad\Actividades\ActividadClientController@edit');
    Route::post('actividades-client/actualizar/{id}', 'Actividad\Actividades\ActividadClientController@actualizar');
    Route::post('clientes-permitir/{id}', 'Actividad\Client\FinalController@permitir');
    Route::get('ajustes', 'Actividad\Actividades\ActividadController@inicio');
    Route::resource('profesores', 'Actividad\ProfesorController');
    Route::resource('actividad', 'Actividad\Actividades\ActividadController');
    Route::resource('intermediario', 'Actividad\Client\IntermediarioController');
    Route::post('sedes/{id}', 'Actividad\Client\SedeController@store');
    Route::resource('actividades', 'Actividad\Actividades\ActividadController');
    Route::resource('personas', 'Actividad\Client\PersonaController');
    Route::get('personas/{id}/cliente', 'Actividad\Client\PersonaController@cliente');
    Route::get('programar', 'Actividad\Actividades\ActividadClientController@programarCreate');
    Route::get('programar/clientes/{id}', 'Actividad\Actividades\ActividadClientController@clientes');
    Route::post('programar/', 'Actividad\Actividades\ActividadClientController@programarStorage');
    Route::get('programar/{id}', 'Actividad\Actividades\ActividadClientController@programarShow');
    Route::get('informe', 'Actividad\Actividades\InformeController@index');
    Route::post('informe/intermediarioexcel', 'Actividad\Actividades\InformeController@intermediarioExcel');
    Route::post('informe/profesorexcel', 'Actividad\Actividades\InformeController@profesorExcel');
    Route::post('informe/clientepdf', 'Actividad\Actividades\InformeController@clientePdf');

  });

  Route::group(['middleware' => ['administrador'], 'middleware' => ['cliente']], function () {
    Route::get('clientes', 'Actividad\Client\FinalController@index');
    Route::get('clientes/{id}', 'Actividad\Client\FinalController@show');
    Route::get('sedes/create/{id}', 'Actividad\Client\SedeController@create');
    Route::resource('sedes', 'Actividad\Client\SedeController');
    Route::get('actividades-client/create/{id}', 'Actividad\Actividades\ActividadClientController@create');
    Route::resource('actividades-client', 'Actividad\Actividades\ActividadClientController');
    Route::post('actividades-client/{id}', 'Actividad\Actividades\ActividadClientController@store');
    Route::get('descargar/{id}', 'Actividad\Actividades\ActividadAsignacionController@descargar');

  });

  Route::group(['middleware' => ['administrador'], 'middleware' => ['profesor']], function () {
    Route::resource('asignacion', 'Actividad\Actividades\ActividadAsignacionController', ['except' => ['show']]);
    Route::get('finalizar/{id}', 'Actividad\Actividades\ActividadAsignacionController@finalizar');
    Route::post('finalizar/{id}', 'Actividad\Actividades\ActividadAsignacionController@finalizarCheck');
    Route::put('finalizar/{id}/', 'Actividad\Actividades\ActividadAsignacionController@finalizarupdate');
    Route::get('calendario', 'Actividad\Actividades\ActividadAsignacionController@calendarioIndex');
    Route::get('calendario/{id}', 'Actividad\Actividades\ActividadAsignacionController@calendarioProfe');
    Route::get('confirmar/{id}', 'Actividad\Actividades\ActividadAsignacionController@confirmar');

  });

  Route::resource('asistencia', 'Actividad\Actividades\AsistenciaController');
  Route::post('asistencia/{id}', 'Actividad\Actividades\AsistenciaController@ingreso');
  Route::post('asistencia/{id}/eliminar', 'Actividad\Actividades\AsistenciaController@ingresoActualizar');
  Route::get('asistencia-descargar/{id}', 'Actividad\Actividades\AsistenciaController@descargar');
  Route::get('asignacion/{id}', 'Actividad\Actividades\ActividadAsignacionController@show');
  Route::post('buscar/nit', 'Actividad\BuscadorController@nit');

});
