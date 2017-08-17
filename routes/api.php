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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//warehouses
Route::get('/warehouses', 'Api\WarehouseController@index')->name('api-warehouse-list');
Route::get('/warehouses-simple-list', 'Api\WarehouseController@getSimpleList')->name('api-warehouse-simple-list');
Route::get('/warehouses/{id?}', 'Api\WarehouseController@show')->name('api-warehouse-show');
Route::get('/warehouses-with-products/{id?}', 'Api\WarehouseController@showWithProducts')->name('api-warehouse-show-with-products');
//wines
Route::get('/wines', 'Api\WineController@index')->name('api-wine-list');
Route::get('/wines/{id?}', 'Api\WineController@show')->name('api-wine-show');