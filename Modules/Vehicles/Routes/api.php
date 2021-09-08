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

Route::post('vehicle', 'VehiclesController@store');
Route::get('vehicle', 'VehiclesController@index');
Route::get('vehicle/{vehicle_uuid}', 'VehiclesController@show');
Route::put('vehicle/{vehicle_uuid}', 'VehiclesController@update');
Route::delete('vehicle/{vehicle_uuid}', 'VehiclesController@destroy');
