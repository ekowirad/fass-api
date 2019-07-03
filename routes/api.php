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

Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');

// Testing route
Route::post('labor', 'LaborController@store');
Route::post('search', 'LaborController@search');
Route::put('labor', 'LaborController@store');

// Route::post('carrier', 'LaborController@storeCarrier');

Route::post('order', 'OrderController@store');
Route::get('order/{id}', 'OrderController@show');



Route::group(['middleware' => 'auth:api'], function () {
    Route::get('users', 'UserController@index');
    Route::post('user', 'UserController@register');
    Route::put('user/{id}', 'UserController@update');
    Route::get('user/{id}', 'UserController@show');
    Route::delete('user/{id}', 'UserController@destroy');

    Route::post('labor', 'LaborController@store');
    Route::put('labor', 'LaborController@store');
    Route::get('labors/{id}', 'LaborController@indexPrt');
    Route::get('labor/{id}', 'LaborController@show');
    Route::delete('labor/{id}', 'LaborController@destroy');

    Route::post('carrier', 'LaborController@storeCarrier');
    Route::put('carrier', 'LaborController@storeCarrier');

    Route::post('files', 'LaborController@storeImage');
    Route::delete('files', 'LaborController@destroyImage');

    Route::prefix('data_lib')->group(function () {
        Route::get('provinces', 'DataLibraryController@showProvinces');
        Route::get('regencies', 'DataLibraryController@showRegencies');
        Route::get('districts', 'DataLibraryController@showDistricts');
        Route::get('ethnics', 'DataLibraryController@showEthnics');
    });
});
