<?php
/*
/Rutas de conexión entre Front End y Back End
*/

Route::view('/', 'app') -> name('index');

//Rutas de las sesiones
Route::post('login', 'LoginController@login'); //Ruta de inicio de sesión
Route::post('signup', 'LoginController@signup'); //Ruta de crear sesión
Route::get('services/level={level}/token={token}', 'LoginController@getUser');//Ruta de obtención de datos
Route::post('changeAccess', 'LoginController@close');//Ruta para cerrar sesión

//Ruta de las apis
Route::get('validate/{isType}/{apidate}', 'UserController@getValidate'); //RuTa de obtencion de apis

//Rutas de las direcciones
Route::get('dep', 'DirectionController@dep');
Route::post('prov', 'DirectionController@prov');
Route::post('dist', 'DirectionController@dist');

//Rutas de los usuarios
Route::post('edit_data', 'UserController@update');//Ruta de actualizacion de los datos
Route::get('details/provider/{ide}/{id_provider}', 'UserController@providerdetails');//Ruta de los detalles de usuarios

//Ruta de los servicios y de la comunicacion respectiva
Route::get('services/page={page}', 'ServiceController@serviceall'); //Ruta de los servicios paginados
Route::post('create_service', 'ServiceController@createservice');//Ruta de creacion de servicios
Route::get('services/id={ide}', 'ServiceController@serviceid');//Ruta de creacion de servicios 
Route::get('service_details/{service_id}', 'ServiceController@serviceiddetails');//Ruta de detalle de servicios 
Route::get('service_details/{service_id}', 'ServiceController@serviceiddetails');//Ruta de detalle de servicios 
//Route::get('services/page={page}/pmin={pmin}&pmax={pmax}', 'ServiceController@serviceall');//Ruta de los servicios paginados
Route::get('services/pmin={pmin}&pmax={pmax}/OrderByvalue={value}', 'ServiceController@serviceall');//Ruta de los servicios paginados