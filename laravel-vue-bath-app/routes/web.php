<?php

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
    Route::get('/login/google', 'LoginController@redirectToGoogle');
    Route::get('/login/google/callback', 'LoginController@handleGoogleCallback');
});

Route::namespace('User')->group(function() {
    Route::get('auth/login/facebook', 'FacebookController@redirectToFacebookProvider');
    Route::get('auth/facebook/callback', 'FacebookController@handleFacebookProviderCallback');
});
