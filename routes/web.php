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

Route::get('/', 'vistasController@home')->name('home')->middleware('permiso');

Route::get('login', 'Auth\LoginController@show')->name('login')->middleware('guest');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('register', 'Auth\RegisterController')->middleware('guest');

Route::get('admin',function(){
	return view('admin.dashboard');

});


//======================================RUTAS PARA EL CRUD DE CATEGORIAS========================================================
Route::resource('categorias','ControladorCategorias');
Route::resource('notificaciones','ControladorNotificaciones')->middleware('auth');
//======================================RUTAS PARA EL CRUD DE PLAN DE ACCION========================================================
Route::resource('plan','ControladorPlanDeAccion')->middleware('auth');
//==============================================================================================================================
Route::get('categoriaAsignada','ControladorPlanDeAccion@listaPlanes')->name('categoriaAsignada')->middleware('auth');
//==============================================================================================================================
Route::resource('recomendacion','ControladorRecomendaciones');
//==============================================================================================================================
Route::resource('evidencias','ControladorEvidencias')->middleware('auth');
//===============================================================================================================================
Route::resource('academicos','ControladorAcademicos')->middleware('admin');

//========================================================================================================================
Route::get('recomendacion/create/{idCategoria}/{ida}','ControladorRecomendaciones@create')->name('recomendacion.create2')->middleware('auth');

Route::post('recomendacion/create/{idCategoria}','ControladorRecomendaciones@store')->name('recomendacion.store2');

Route::get('editarPerfil/{academico}/edit', 'ControladorAcademicos@editPerfil')->name('academico.editPerfil')->middleware('auth');
Route::put('updatePerfil/{academico}', 'ControladorAcademicos@updatePerfil')->name('academico.updatePerfil')->middleware('auth');
//==============ruta para actualizar si un plan es completado o no=================
Route::put('plan/{plan}','ControladorPlanDeAccion@planCompletado')->name('plan.completado')->middleware('auth');
//========================================================================================================================
Route::get('plan/{plan}/reporte', 'ControladorPlanDeAccion@planReporte')->name('plan.reporte')->middleware('auth');
//========================================================================================================================
Route::get('recomendacion/{recomendacion}/reporte', 'ControladorRecomendaciones@recomendacionReporte')->name('recomendacion.reporte')->middleware('auth');
//========================================================================================================================
Route::get('categoria/{categoria}/reporte', 'ControladorCategorias@categoriaReporte')->name('categoria.reporte')->middleware('auth');
Route::get('categoria/lista', 'ControladorCategorias@listas')->name('categoria.lista')->middleware('auth');
Route::get('notificacion/lista', 'ControladorNotificaciones@lista')->name('notificacion.reporte')->middleware('auth');
//========================================================================================================================
Route::get('panelAdministrador', 'vistasController@panelAdmin')->name('admin.home');
Route::get('recomendacionesAdministrador', 'vistasController@recomendacionesAdmin')->name('admin.recomendaciones');

//=====================BORRAR RECOMENDACION PARA PANEL DE ADMINISTRADOR=====================================================
Route::delete('borrarRecomendacion/{id}','ControladorRecomendaciones@destroy2')->name('recomendacion.destroy2');

Route::get('Reporte/{id}', 'ReportController@generar')->name('reporte.plan')->middleware('auth');

Route::post('ReporteArea/{id}', 'ReportController@ReporteArea')->name('reporte.area')->middleware('auth');