<?php

Auth::routes(['verify' => true]);

// ログイン必須
Route::group(['middleware' => 'verified'], function() {
    //
});

Route::get('/', function () { return view('top'); });
Route::group(['prefix' => 'user'], function() {
    Route::get('register', function () { return view('user.register'); })->name('user.register');
    Route::get('login', function () { return view('user.login'); })->name('user.login');
    Route::get('mypage', function () { return view('user.mypage'); })->name('user.mypage');
    Route::get('edit', function () { return view('user.edit'); })->name('user.edit');;
    Route::get('change_password', function () { return view('user.change_password'); })->name('user.change_password');;
    Route::get('change_email', function () { return view('user.change_email'); })->name('user.change_email');;
    Route::get('favorite', function () { return view('user.favorite'); })->name('user.favorite');;
});

Route::group(['prefix' => 'post'], function() {
    Route::get('mypost', function () { return view('post.mypost'); })->name('post.mypost');;
    Route::get('search', function () { return view('post.search'); })->name('post.search');;
});

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
