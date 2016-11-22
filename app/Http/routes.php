<?php


Route::get('/', 'ArticlesController@index');
Route::get('/articles/{slug}', 'ArticlesController@show');

Route::auth();
Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
Route::get('user/newpassword', 'Auth\AuthController@renderPasswordView')->name('user.newpassword');
Route::post('user/passwordconfirm', 'Auth\AuthController@passwordConfirm')->name('user.passwordconfirm');
Route::get('/home', 'HomeController@index');
