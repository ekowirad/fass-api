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
Route::get('labors', 'LaborController@index');
Route::post('carrier', 'LaborController@storeCarrier');
Route::post('image', 'LaborController@storeImage');
Route::delete('image', 'LaborController@destroyImage');



Route::group(['middleware' => 'auth:api'], function () {
    Route::get('users', 'UserController@index');
    Route::post('user', 'UserController@register');
    Route::put('user/{id}', 'UserController@update');
    Route::get('user/{id}', 'UserController@show');
    Route::delete('user/{id}', 'UserController@destroy');

    Route::post('prt', 'LaborController@store');
    Route::put('prt', 'LaborController@store');

    Route::prefix('location')->group(function (){
        Route::get('provinces', 'LocationController@showProvinces');
        Route::get('regencies', 'LocationController@showRegencies');
        Route::get('districts', 'LocationController@showDistricts');
    });
});
