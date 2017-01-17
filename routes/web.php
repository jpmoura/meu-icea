<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Rotas para usuários autenticados
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);
    Route::get('sobre', ['as' => 'sobre', 'uses' => 'PagesController@sobre']);

    Route::get('reserva', ['as' => 'loginReserva', 'uses' => 'PagesController@reserva']);
    Route::get('sisnti', ['as' => 'loginSisNti', 'uses' => 'PagesController@sisnti']);
});

Route::get('/login', ['as' => 'showLogin', 'uses' => 'Auth\LoginController@showLogin']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);
Route::get('/sair', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);