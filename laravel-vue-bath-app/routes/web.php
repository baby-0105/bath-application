<?php

/**
 * ログイン必須
 */

Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::get('mypage', 'User\MyPageController@show')->name('user.mypage');
        Route::get('edit', 'User\EditController@show')->name('user.edit.show');
        Route::post('edit', 'User\EditController@submit')->name('user.edit.submit');
        Route::get('change_email', 'User\ChangeEmailController@show')->name('user.change_email.show');
        Route::post('change_email', 'User\ChangeEmailController@sendEmail')->name('user.change_email.sendEmail');
        Route::get('favorite', function () { return view('user.favorite'); })->name('user.favorite');
    });

    Route::group(['prefix' => 'post', 'namespace' => 'Post'], function() {
        Route::get('mypost', 'MyPostController@index')->name('post.mypost');
        Route::post('mypost', 'MyPostController@delete')->name('post.delete');
        Route::get('topost', 'ToPostController@show')->name('post.topost');
        Route::post('topost', 'ToPostController@submit')->name('post.submit');
    });

    /**
     * ログイン済みの、SNS認証ユーザーの場合
     */
    Route::group(['middleware' => 'check.sns', 'prefix' => 'user', 'namespace' => 'User'], function() {
        Route::get('change_password', 'ChangePasswordController@show')->name('user.change_password.show');
        Route::post('change_password', 'ChangePasswordController@submit')->name('user.change_password.submit');
    });
});

/**
 * 以下、ログイン必要なし
 */

Route::get('check_scraping', 'Bath\ScrapingController@getBath');

Route::get('/', function () { return view('top'); })->name('top');
Route::get("reset/{token}", "User\ResetEmailController@reset");

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
});

Route::get('bath/search', 'Bath\SearchController@show')->name('bath.search');
Route::post('bath/search', 'Bath\SearchController@getInfo')->name('bath.search.getInfo');

Route::namespace('User')->group(function() {
    Route::group(['prefix' => 'user'], function() {
        Route::post('check_email', 'RegisterController@sendAndCreate')->name('user.check_email');
        Route::get('verify/{token}', 'RegisterController@showVerify');
    });

    Route::post('/user/login', 'LoginController@login')->name('user.login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});
