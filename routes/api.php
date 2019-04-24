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

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('users', 'UserController@index');
    Route::post('user', 'UserController@register');
    Route::put('user/{id}', 'UserController@update');
    Route::get('user/{id}', 'UserController@show');
    Route::delete('user/{id}', 'UserController@destroy');
});
