<?php

Route::get('feed','ArticlesController@generateFeed');

Route::get('/', 'ArticlesController@index');
Route::get('/articles/create', 'ArticlesController@create');
Route::post('articles', 'ArticlesController@store');
Route::get('/articles/{slug}', 'ArticlesController@show');
Route::delete('/articles/{articles}', 'ArticlesController@destroy')->name('articles.destroy');

Route::auth();
Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
Route::get('user/newpassword', 'Auth\AuthController@renderPasswordView')->name('user.newpassword');
Route::post('user/passwordconfirm', 'Auth\AuthController@passwordConfirm')->name('user.passwordconfirm');
Route::get('/dashboard', 'HomeController@index');
