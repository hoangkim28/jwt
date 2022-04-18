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

Route::post('login', 'AuthController@login')->middleware('api');

Route::group(['middleware' => ['api','jwt.verify']], function ($router) {

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::patch('user/{id}', 'UserController@update')->name('user.update');
    Route::get('users', 'UserController@index')->name('user.list');
});

Route::post('user', 'UserController@store')->name('user.store');
Route::get('user/{id}', 'UserController@find')->name('user.detail');
