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

Route::get('order', 'OrdersController@index');

// delivery
Route::post('delivery/load', 'DeliveryController@load');
Route::post('delivery/dispatch', 'DeliveryController@dispatchDelivery');
Route::post('delivery/deliver', 'DeliveryController@deliverOrder');
