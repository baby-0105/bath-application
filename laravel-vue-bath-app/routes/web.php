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

Auth::routes(['verify' => true]);

// ログイン必須
Route::group(['middleware' => 'verified'], function() {
    //
});

Route::get('/', function () { return view('top'); });
Route::get('/user/register', function () { return view('user.register'); });
Route::get('/user/login', function () { return view('user.login'); });

Route::namespace('User')->group(function() {
    Route::group(['prefix' => 'user'], function() {
        Route::post('check_email', 'RegisterController@sendAndCreate')->name('user.check_email');
        Route::get('verify/{token}', 'RegisterController@showVerify');
    });

    Route::post('/user/login', 'LoginController@login')->name('user.login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});
