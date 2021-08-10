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

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    // 'namespace' => 'Admin',
    // 'middleware' => ['is.Admin', 'login'],
], function(){

    Route::get('users/{id}/friends/{friendID}', 'Admin\UserController@index')
        ->name('user.friend'); 
    
});

Route::get('users/{id}/friends/{friendID}', 'UserController@index')
->name('user.friend'); 

//show page nhaajp email forgot password
Route::get('users/{id}/forgot-pass', 'UserController@forgotPassword')->name('forgot');
//submit form forgot-pass
Route::post('users/{id}/forgot-pass', 'UserController@sendForgotPassMail')->name('users.forgot-pass');
//link show page reset new pass
Route::get('users/{id}/reset-pass', 'UserController@resetPassword')->name('users.reset-pass')->middleware('signed');


Route::get('users/update', 'UserController@update');
Route::get('users/{user}', 'UserController@show');

// Route::resource('users', 'UserController');

// Route::get('users/{user}', 'UserController@show');
Route::get('categories/{cate}', 'CategoryController@show');

Route::get('test-redirect', function (){
    // return redirect()->to('/users');
    // return redirect()->route('users.show', 1);
    return redirect('/users');
});

Route::get('users', [UserController::class, 'index']);

Route::get('profiles', 'ProfileController@index')->name('profiles.index');
Route::get('profiles/restore/{id?}', 'ProfileController@restore')->name('profiles.restore');
Route::get('profiles/{id}', 'ProfileController@destroy')->name('profiles.destroy');
Route::get('profiles/{id}/update', 'ProfileController@update')->name('profiles.update');
Route::get('contacts', 'ContactController@index');

//get role of user by id
Route::get('users/{user}/roles', 'UserController@getRoles');


Route::get('roles/{role}/users', 'RoleController@getUsers');
Route::get('users/{userId}/set-role/{roleId}', 'UserController@setRoles');
Route::get('users/{user}/remove-role/{role}', 'UserController@removeRoles');
Route::get('users/{user}/sync-role/{role}', 'UserController@syncRoles');

Route::get('countries/{country}/posts', 'CountryController@getPosts');

Route::get('users/{user}/images', 'UserController@getImages');






Route::get('users/{user}/upload', 'UserController@showFormUpload');
Route::post('users/{user}/upload', 'UserController@upload')->name('users.upload');
Route::get('categories/{cate}', 'UserController@upload')->name('users.upload');
Route::get('/hellob', 'UserController@abc')->name('users.abc');
