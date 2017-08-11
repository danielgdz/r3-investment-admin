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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//warehouses
Route::get('/warehouses', 'Web\WarehousesController@index')->name('warehouses');
Route::get('/warehouse/create', 'Web\WarehousesController@create')->name('warehouse-create');
Route::post('/warehouse/store', 'Web\WarehousesController@store')->name('warehouse-store');
Route::get('/warehouse/edit/{id?}', 'Web\WarehousesController@edit')->name('warehouse-edit');
Route::put('/warehouse/{id?}', 'Web\WarehousesController@update')->name('warehouse-update');
Route::delete('/warehouses/{id?}', 'Web\WarehousesController@destroy')->name('warehouse-delete');
//wines
Route::get('/wines', 'Web\WinesController@index')->name('wines');
Route::get('/wine/create', 'Web\WinesController@create')->name('wine-create');
Route::post('/wine/store', 'Web\WinesController@store')->name('wine-store');
Route::get('/wine/edit/{id?}', 'Web\WinesController@edit')->name('wine-edit');
Route::put('/wine/{id?}', 'Web\WinesController@update')->name('wine-update');
Route::delete('/wines/{id?}', 'Web\WinesController@destroy')->name('wine-delete');
