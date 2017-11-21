<?php

Debugbar::disable();

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

Route::get('/401','ApiController@unauthorized')->name('login');

Route::group(['prefix' => '/user'], function(){
    Route::post('/auth','UserController@login');

});

Route::group(['middleware' => ['auth:api']], function() {

    Route::group(['middleware' => 'roles', 'roles' => ['ROLE_ADMIN']], function(){

    });

    Route::group(['prefix' => '/user'], function(){
        Route::get('/me','UserController@me');
    });

});