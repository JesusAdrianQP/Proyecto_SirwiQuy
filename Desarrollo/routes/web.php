<?php
/*--------------------------------------------------------------------------------------
                            Rutas de conexión principales
/*------------------------------------------------------------------------------------*/
Route::view('/', 'landing') -> name('landing');/*Landing Page de SirwiyQuy*/

Route::view('/home', 'app') -> name('home');/*Inicio de carga SPA*/

/*------------------------------------------------------------------------------------
                      Rutas de conexión entre Front End y Back End
/-------------------------------------------------------------------------------------*/
//Rutas de las sesiones
Route::post('login', 'LoginController@login'); //Ruta de inicio de sesión
Route::post('signup', 'LoginController@signup'); //Ruta de crear sesión
Route::get('level={level}/token={token}', 'LoginController@getUser');//Ruta de obtención de datos
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

//Ruta de los servicios
Route::get('services/page={page}', 'ServiceController@serviceall'); //Ruta de los servicios paginados
Route::post('create_service', 'ServiceController@createservice');//Ruta de creacion de servicios
Route::get('service_details/{service_id}', 'ServiceController@serviceiddetails');//Ruta de detalle de servicios 
Route::get('service/{service_id}/cost', 'ServiceController@pricesdetails');//Ruta de los detalles de los precios 
Route::get('services/page={page}/pmin{pmin}&pmax={pmax}/OrderByvalue={value}/title={title}/district={district}/category={category}', 'ServiceController@serviceall');//Ruta de los servicios paginados

/*--------------------------Comunicación - Request y Response ----------------------*/
Route::post('request', 'CommunicationController@requestService');/*Solicitud de Servicio*/
Route::get('notifications/page={page}/id={id}&filter={filter}', 'CommunicationController@notifications_id');/*Listado de Notificaciones*/
Route::post('delete/notification', 'CommunicationController@deleterequests');/*Borrar solicitudes - Negar solicitud*/
Route::get('notification_details/{notification_id}', 'CommunicationController@details');/**Detalles por id de la solicitud*/
Route::post('updatestatus', 'CommunicationController@update_status');/**Actualización del status - response o request */
Route::post('mail_acept', 'CommunicationController@acept');/**Aceptar solicitud */
Route::get('paypal/{linkPaypal}/{id_response}', 'CommunicationController@responsedetails');/**PayPal */
Route::get('responses/page={page}/id={id}', 'CommunicationController@list_response');/**Lista de solicitudes respondidas */