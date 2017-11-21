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



Route::group(['prefix' => '/user'], function(){
    Route::post('/auth','UserController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:api']], function() {

    Route::group(['middleware' => 'roles', 'roles' => ['ROLE_ADMIN']], function(){

    });

    Route::group(['prefix' => '/user'], function(){

    });

});