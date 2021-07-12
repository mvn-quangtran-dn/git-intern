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

Route::get('/', function () {
    return view('home.welcome');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['is.Admin', 'login'],
], function(){

    Route::get('users/{id}/friends/{friendID}', 'UserController@index')
        ->name('user.friend'); 
    
});

Route::get('users/{id}/friends/{friendID}', 'UserController@index')
->name('user.friend'); 

