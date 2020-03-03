<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('search', 'LaborController@search');
Route::get('mitras', 'LaborController@index');
Route::get('mitra/{id}', 'LaborController@show');
Route::prefix('data_lib')->group(function () {
    Route::get('provinces', 'DataLibraryController@showProvinces');
    Route::get('regencies', 'DataLibraryController@showRegencies');
    Route::get('districts', 'DataLibraryController@showDistricts');
    Route::get('ethnics', 'DataLibraryController@showEthnics');
    Route::get('statuses', 'DataLibraryController@showStatuses');
    Route::get('jobs', 'DataLibraryController@showJobs');
});
Route::post('order', 'OrderController@store');
Route::post('order_payment', 'OrderPaymentController@store');

// Testing route




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
    Route::delete('files/{file_id}', 'LaborController@destroyImage');

    Route::get('orders', 'OrderController@index');
    Route::put('order', 'OrderController@store');
    Route::get('order/{id}', 'OrderController@show');
    Route::delete('order/{id}', 'OrderController@destroy');

    Route::get('order_payments', 'OrderPaymentController@index');
    Route::get('order_payment/{id}', 'OrderPaymentController@show');

    Route::post('revenue', 'RevenueController@store');
    Route::get('revenues', 'RevenueController@index');
    Route::post('expense_income', 'RevenueController@storeExpenseIncome');
    Route::get('expense_income/{type}', 'RevenueController@showExpenseIncome');
});
