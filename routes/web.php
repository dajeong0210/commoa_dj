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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('/shop', 'ShopController');
Route::resource('/product', 'ProductController');
Route::get('/category/{category_name}', 'CategoryController@show');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/apply', 'ApplyController');
    Route::resource('/bookmark', 'BookmarkController');
    Route::post('/bookmark/{shop_id}', 'BookmarkController@store');
    Route::resource('/favorite', 'FavoriteController');
    Route::post('/favorite/{product_id}', 'FavoriteController@store');
    Route::resource('/info', 'InfoController');
    Route::get('/shop/create', 'ShopController@create');
    Route::get('/shop/{s_id}/edit', 'ShopController@edit');
    Route::get('/product/create', 'ProductController@create');
    Route::get('/product/{p_id}/edit', 'ProductController@edit');
});
