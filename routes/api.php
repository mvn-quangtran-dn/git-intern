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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//api get list user
Route::group([
    'namespace' => 'API',
    'prefix' => 'v1',
    // 'middleware' => ''
], function (){

    // Route::apiResource('users', 'UserController');
    Route::get('users', 'UserController@index');
    Route::delete('users/{id}', 'UserController@destroy');

});