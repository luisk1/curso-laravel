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

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/', 'InicioController@index')->name('inicio');
Route::get('seguridad/login', 'Seguridad\LoginController@index')->name('login');
Route::post('seguridad/login', 'Seguridad\LoginController@login')->name('login_post');
Route::get('seguridad/logout', 'Seguridad\LoginController@logout')->name('logout');
Route::post('ajax-sesion', 'AjaxController@setSession')->name('ajax')->middleware('auth');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'superadmin']], function () {
    Route::get('', 'AdminController@index');
    
    /*RUTAS DE PERMISO*/
    Route::get('permiso', 'PermisoController@index')->name('permiso');
    Route::get('permiso/crear', 'PermisoController@crear')->name('crear_permiso');
    Route::post('permiso', 'PermisoController@guardar')->name('guardar_permiso');
    Route::get('permiso/{id}/editar', 'PermisoController@editar')->name('editar_permiso');
    Route::put('permiso/{id}', 'PermisoController@actualizar')->name('actualizar_permiso');
    Route::delete('permiso/{id}', 'PermisoController@eliminar')->name('eliminar_permiso');
    /*RUTAS DEL MENU*/
    Route::get('menu', 'MenuController@index')->name('menu');
    Route::get('menu/crear', 'MenuController@crear')->name('crear_menu');
    Route::post('menu', 'MenuController@guardar')->name('guardar_menu');
    Route::get('menu/{id}/editar', 'MenuController@editar')->name('editar_menu');
    Route::put('menu/{id}', 'MenuController@actualizar')->name('actualizar_menu');
    Route::get('menu/{id}/eliminar', 'MenuController@eliminar')->name('eliminar_menu');
    Route::post('menu/guardar-orden', 'MenuController@guardarOrden')->name('guardar_orden');
    /*RUTAS ROL*/
    Route::get('rol', 'RolController@index')->name('rol');
    Route::get('rol/crear', 'RolController@crear')->name('crear_rol');
    Route::post('rol', 'RolController@guardar')->name('guardar_rol');
    Route::get('rol/{id}/editar', 'RolController@editar')->name('editar_rol');
    Route::put('rol/{id}', 'RolController@actualizar')->name('actualizar_rol');
    Route::delete('rol/{id}', 'RolController@eliminar')->name('eliminar_rol');
    /*RUTAS MENU_ROL*/
    Route::get('menu-rol', 'MenuRolController@index')->name('menu_rol');
    Route::post('menu-rol', 'MenuRolController@guardar')->name('guardar_menu_rol');
    /*RUTAS PERMISO_ROL*/
    Route::get('permiso-rol', 'PermisoRolController@index')->name('permiso_rol');
    Route::post('permiso-rol', 'PermisoRolController@guardar')->name('guardar_permiso_rol');
});
Route::get('gestionarorden','Admin\ordenController@index');
Route::post('/guardarorden/','Admin\ordenController@guardar');
Route::post('eliminarorden/{id}','Admin\ordenController@eliminar');
Route::get('cargarorden','Admin\ordenController@mostrar');
Route::put('/editarorden/{id}', 'Admin\ordenController@editar');
/*RUTAS DE citas*/
Route::get('gestionarcita','Admin\citasController@index');
Route::post('guardarcita/','Admin\citasController@guardar');
Route::post('guardarordencita/','Admin\citasController@guardarordencita');
Route::get('buscarfecha/{fecha}','Admin\citasController@buscarfecha');
Route::get('ordendisponible','Admin\citasController@mostrar');
Route::get('gestionarordencita','Admin\ordencitaController@index');
Route::get('citadisponible','Admin\ordencitaController@mostrarcita');
Route::get('citaasignada','Admin\ordencitaController@cargarcitaasignada');
Route::get('citaasignadamostrar','Admin\ordencitaController@mostrarcitaasignada');
Route::put('atendercita', 'Admin\ordencitaController@atender');
Route::get('citaatendidamostrar','Admin\ordencitaController@mostrarcitaatendida');
Route::put('terminarcita', 'Admin\ordencitaController@terminar');
/*RUTAS DE USUARIO*/
Route::get('gestionarusuario', 'Admin\UsuarioController@index')->name('usuario');
Route::post('crearusuario/{datos}/{pass}/{cedula}', 'Admin\UsuarioController@guardar')->name('crear_usuario');
Route::post('usuario', 'Admin\UsuarioController@guardar')->name('guardar_usuario');
Route::get('usuario/{id}/editar', 'Admin\UsuarioController@editar')->name('editar_usuario');
Route::put('usuario/{id}', 'Admin\UsuarioController@actualizar')->name('actualizar_usuario');
Route::delete('usuario/{id}', 'Admin\UsuarioController@eliminar')->name('eliminar_usuario');    
