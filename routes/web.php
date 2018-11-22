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

Route::group(['prefix' => 'news'], function () {
    Route::get('/', '\App\Http\Controllers\NewsController@index');
    Route::get('create', '\App\Http\Controllers\NewsController@create');
    Route::post('/', '\App\Http\Controllers\NewsController@store');
    Route::get('{new}', '\App\Http\Controllers\NewsController@show');
    Route::get('{new}/edit', '\App\Http\Controllers\NewsController@edit');
    Route::put('{new}', '\App\Http\Controllers\NewsController@update');
    Route::post('img/upload', '\App\Http\Controllers\NewsController@imageUpload');
    Route::get('{new}/delete', '\App\Http\Controllers\NewsController@delete');
});