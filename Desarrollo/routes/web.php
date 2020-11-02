<?php
/*
/Rutas de conexión entre Front End y Back End
*/

Route::view('/', 'app') -> name('index');

//ruta de los servicios
Route::get('services/page={page}', 'ServiceController@serviceall');//Ruta de los servicios paginados

//Rutas de las sesiones
Route::post('login', 'LoginController@login'); //Ruta de inicio de sesión

