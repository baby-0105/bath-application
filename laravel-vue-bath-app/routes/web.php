<?php

/**
 * ログイン必須
 */

Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::get('mypage', 'User\MyPageController@show')->name('user.mypage');
        Route::get('edit', function () { return view('user.edit'); })->name('user.edit');
        Route::get('change_password', function () { return view('user.change_password'); })->name('user.change_password');
        Route::get('change_email', function () { return view('user.change_email'); })->name('user.change_email');
        Route::get('favorite', function () { return view('user.favorite'); })->name('user.favorite');
    });

    Route::group(['prefix' => 'post', 'namespace' => 'Post'], function() {
        Route::get('mypost', 'MyPostController@index')->name('post.mypost');
        Route::post('mypost', 'MyPostController@delete')->name('post.delete');
        Route::get('topost', 'ToPostController@show')->name('post.topost');
        Route::post('topost', 'ToPostController@submit')->name('post.submit');
    });
});

/**
 * 以下、ログイン必要なし
 */

Route::get('/', function () { return view('top'); })->name('top');


Route::group(['prefix' => 'user'], function() {
    Route::get('register', function () { return view('user.register'); })->name('user.register');
    Route::get('login', function () { return view('user.login'); })->name('user.login');
});
Route::namespace('Auth')->group(function() {
    Route::get('/login/{sns}', 'SocialController@redirectToProvider')->where('sns', 'facebook|google')->name('login.sns');
    Route::get('/login/{sns}/callback', 'SocialController@handleProviderCallback')->where('sns', 'facebook|google');
    Route::post('/', 'SocialController@updateProfile')->name('update.profile');
});

Route::group(['prefix' => 'post'], function() {
    Route::get('index', function () { return view('post.index'); })->name('post.index');
    Route::get('search', function () { return view('post.search'); })->name('post.search');
});

Route::namespace('User')->group(function() {
    Route::group(['prefix' => 'user'], function() {
        Route::post('check_email', 'RegisterController@sendAndCreate')->name('user.check_email');
        Route::get('verify/{token}', 'RegisterController@showVerify');
    });

    Route::post('/user/login', 'LoginController@login')->name('user.login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});
