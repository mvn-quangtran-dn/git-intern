<?php
use App\Http\Controllers\UserController;
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

// Route::resource('users', 'UserController');
Route::group([], function (){
    //list user
    Route::get('users', 'UserController@index')->name('users.index');
    //show form create user 
    Route::get('users/create', 'UserController@create')->name('users.create');
    //store users
    Route::post('users', 'UserController@store')->name('users.store');
    //show user detail
    Route::get('users/{id}', 'UserController@show')->name('users.show');
    //delete user
    Route::delete('users/{id}', 'UserController@destroy')->name('users.destroy');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Show form login
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

//Submit login form
Route::post('/login', 'Auth\LoginController@login')->name('login');

//show registration form 
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

//store user registration
Route::post('register', 'Auth\RegisterController@register')->name('register');
