<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('/product', 'ProductController', ['only' => [
    'index', 'show'
]]);
Route::resource('/shop', 'ShopController', ['only' => [
    'index', 'show'
]]);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/apply', 'ApplyController');
    Route::resource('/bookmark', 'BookmarkController');
    Route::resource('/favorite', 'FavoriteController');
    Route::resource('/info', 'InfoController');
    Route::resource('/shop', 'ShopController', ['except' => [
        'index', 'show'
    ]]);
    Route::resource('/product', 'ProductController', ['except' => [
        'index', 'show'
    ]]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
