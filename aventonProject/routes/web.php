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

Route::get('/', 'TripsController@index');

Route::get('/Trips', 'TripsController@index');

Route::get('/Trips/{id}', 'TripsController@details');

Route::get('/registerVehicle', 'VehicleController@register');

Route::post('/vehicleCreate', 'VehicleController@store');

Route::get('/Users', function(){
     return 'es la ruta de usuarios';});
