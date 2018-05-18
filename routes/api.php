<?php

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

Route::group(['prefix' => 'task'], function () {
    Route::get('/', 'ApiTaskController@index');
    Route::get('/{id}', 'ApiTaskController@show');
    Route::post('/', 'ApiTaskController@store');
    Route::put('/{id}', 'ApiTaskController@update');
    Route::delete('/{id}', 'ApiTaskController@destroy');
});
