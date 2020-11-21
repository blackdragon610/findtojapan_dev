<?php

/*
    ルータの設定
*/


//Manage
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'common:admin'], function() {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('', 'Admin\IndexController@index')->name('');
        Route::any('logout', 'Admin\Auth\AuthController@logout')->name('logout');

        Route::resource('user', 'Admin\UserController');

        Route::resource('company', 'Admin\CompanyController');
        Route::resource('post', 'Admin\PostController');
        Route::resource('user', 'Admin\UserController');
        Route::any('language/google', 'Admin\LanguageController@google')->name("language.google");
        Route::resource('language', 'Admin\LanguageController');
        Route::resource('page', 'Admin\PageController');
        Route::resource('qa', 'Admin\QaController');
        Route::resource('admin_user', 'Admin\AdminUserController');
    });

    Route::get('login', 'Admin\LoginController@index')->name('login');
    Route::post('auth', 'Admin\Auth\AuthController@login')->name('auth');
});


//Company
Route::group(['prefix' => 'company', 'as' => 'company.', 'middleware' => 'common:company'], function() {
    Route::group(['middleware' => 'auth:company'], function () {
        Route::get('', 'Company\IndexController@index')->name('');
        Route::any('logout', 'Company\Auth\AuthController@logout')->name('logout');

        Route::resource('event', 'Company\EventController');
        Route::any('event/{eventId}/participation', 'Company\EventController@participation')->name("event.participation");


        Route::resource('post', 'Company\PostController');
        Route::resource('user', 'Company\UserController');
    });

    Route::get('login', 'Company\LoginController@index')->name('login');
    Route::post('auth', 'Company\Auth\AuthController@login')->name('auth');
});

