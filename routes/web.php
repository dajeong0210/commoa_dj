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
Route::get('/shop', 'ShopController@index');
Route::resource('/product', 'ProductController');
Route::get('/category/{category_name}', 'CategoryController@show');
Route::post('/viewcount/{product_id}', 'ProductController@viewCount');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/apply', 'ApplyController');
    Route::get('/bookmark', 'BookmarkController@index');
    Route::post('/bookmark/{shop_id}', 'BookmarkController@store');
    Route::get('/favorite', 'FavoriteController@index');
    Route::post('/favorite/{product_id}', 'FavoriteController@store');
    Route::resource('/info', 'InfoController');
    Route::get('/shop/create', 'ShopController@create');
    Route::get('/shop/{id}/edit', 'ShopController@edit');
    Route::put('/shop/{id}', 'ShopController@update');
    Route::post('/shop', 'ShopController@store');
    Route::get('/product/create', 'ProductController@create');
    Route::get('/product/{p_id}/edit', 'ProductController@edit');
    Route::resource('/myinfo', 'InfoController');
    Route::get('/mypage', 'UserController@index');
    Route::resource('/myproduct', 'MyproductController');
});
