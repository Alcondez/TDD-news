<?php
//RSS Feed Route
Route::get('feed','ArticlesController@generateFeed');
//Homepage
Route::get('/', 'ArticlesController@index');
//Authentication routes
Route::auth();
//Email Confirmation and Password Setting Routes
Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
Route::get('user/newpassword', 'Auth\AuthController@renderPasswordView')->name('user.newpassword');
Route::post('user/passwordconfirm', 'Auth\AuthController@passwordConfirm')->name('user.passwordconfirm');

//Protected routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/articles/create', 'ArticlesController@create');
    Route::post('articles', 'ArticlesController@store');
    Route::delete('/articles/{articles}', 'ArticlesController@destroy')->name('articles.destroy');
});

//Article PDF Route
Route::get('/articles/pdf/{slug}', 'ArticlesController@generatePdf');

//Single Article Route
Route::get('/articles/{slug}', 'ArticlesController@show');
