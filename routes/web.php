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

Route::get('/login', "\App\Http\Controllers\LoginController@index")->name('login');
Route::post('/login', "\App\Http\Controllers\LoginController@login");
Route::get('/logout', "\App\Http\Controllers\LoginController@logout");

Route::get('/register', "\App\Http\Controllers\RegisterController@index");
Route::post('/register', "\App\Http\Controllers\RegisterController@register");

// 个人主页
Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');
Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');

// 个人设置
Route::get('/user/me/setting', '\App\Http\Controllers\UserController@setting');
Route::post('/user/me/setting', '\App\Http\Controllers\UserController@settingStore');


Route::group(['prefix' => 'news'], function () {
    Route::get('/', '\App\Http\Controllers\NewsController@index');
    Route::get('create', '\App\Http\Controllers\NewsController@create');
    Route::post('/', '\App\Http\Controllers\NewsController@store');
    Route::get('search', '\App\Http\Controllers\NewsController@search');
    Route::get('{new}', '\App\Http\Controllers\NewsController@show');
    Route::get('{new}/edit', '\App\Http\Controllers\NewsController@edit');
    Route::put('{new}', '\App\Http\Controllers\NewsController@update');
    Route::post('img/upload', '\App\Http\Controllers\NewsController@imageUpload');
    Route::get('{new}/delete', '\App\Http\Controllers\NewsController@delete');

    // 评论
    Route::post('{new}/comment', '\App\Http\Controllers\NewsController@comment');
    // 赞
    Route::get('{new}/zan', '\App\Http\Controllers\NewsController@zan');
    Route::get('{new}/unzan', '\App\Http\Controllers\NewsController@unzan');

});