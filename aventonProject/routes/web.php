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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/Trips', 'TripsController@index');

Route::get('/registerTrip', 'TripsController@create');

Route::post('/Trips', 'TripsController@store');

Route::post('/Trips/rate', 'TripsController@rateTrip');

Route::get('/postulate/{tripConfig}/{date}/{id}', 'TripsController@postulate');

Route::get('/Trips/detail/{tripConfig}/{date}/{id}', 'TripsController@detail');

Route::get('/Trips/detail/cancel/{id}', 'TripsController@cancelTrip');

Route::get('/Trips/Organized', 'TripsController@organized');

Route::get('/registerVehicle', 'VehicleController@register');

Route::post('/vehicleCreate', 'VehicleController@store');

Route::get('/Vehicles', 'VehicleController@index');

Route::get('/Users', function(){
     return 'es la ruta de usuarios';});

Route::get('/perfil', 'UserController@show');

Route::get('/myVehicles', 'UserController@showVehicles');

Route::get('/modifyVehicle/{id}', 'VehicleController@modifyVehicle');

Route::get('/removeVehicle/{id}', 'VehicleController@removeVehicle');

Route::post('/vehicleModifyStore', 'VehicleController@storeModify');

Route::get('/postQuestion/{tripConfig}/{date}/{id}', 'TripsController@postQuestion');

Route::get('/postAnswer/{question_id}', 'TripsController@postAnswer');

//Search Route
Route::post('/search', 'HomeController@filters');

Route::get('/acceptPostulation/{userId}/{tripId}/{tripConfig}', 'TripsController@acceptPostulation');

Route::get('/rejectPostulation/{userId}/{tripId}/{tripConfig}', 'TripsController@rejectPostulation');

Auth::routes();

Route::get('/tripprueba', 'HomeController@prueba');

Route::get('/registrationCompleted', 'HomeController@regCompleted');

Route::get('/myTrips', 'UserController@showTrips');
