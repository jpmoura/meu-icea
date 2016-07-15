<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getHome']);

Route::post('/login', ['as' => 'doLoginPost', 'uses' => 'UserController@doLogin']);
Route::get('/login', ['as' => 'getLogin', 'uses' => 'HomeController@getLogin']);
Route::get('/sair', ['as' => 'doLogout', 'uses' => 'UserController@doLogout']);

Route::get('/sobre', ['as' => 'sobreView', 'uses' => 'HomeController@getAbout']);
