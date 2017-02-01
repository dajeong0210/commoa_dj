<?php

use Illuminate\Support\Facades\Auth;
use App\User;

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

    Route::get('/myinfo', 'InfoController@index');
    Route::put('/myinfo/{id}', 'InfoController@update');
    Route::get('/mypage', 'UserController@index');
    Route::get('/bookmark', 'BookmarkController@index');
    Route::post('/bookmark/{shop_id}', 'BookmarkController@store');
    Route::get('/favorite', 'FavoriteController@index');
    Route::post('/favorite/{product_id}', 'FavoriteController@store');

    Route::group(['middleware' => 'User'], function () {
        Route::get('/apply/create', 'ApplyController@create');
        Route::post('/apply', 'ApplyController@store');
        Route::put('/apply/{id}', 'ApplyController@update');
        Route::delete('/apply/{id}', 'ApplyController@destroy');
        Route::get('/apply/{id}/edit', 'ApplyController@edit');
    });

    Route::group(['middleware' => 'ShopAdmin'], function () {
        Route::resource('/myproduct', 'MyproductController');
        Route::get('/shop/{s_id}/edit', 'ShopController@edit');
        Route::put('/shop/{s_id}', 'ShopController@update');
        Route::get('/product/create', 'ProductController@create');
        Route::get('/product/{p_id}/edit', 'ProductController@edit');
    });

    Route::group(['middleware' => 'SystemAdmin'], function () {
        Route::get('/admin', 'AdminController@index');
        Route::get('/apply', 'ApplyController@index');
        Route::get('/admin/category', 'AdminController@category');
        Route::get('/admin/cpu-vga', 'AdminController@cpuvga');
        Route::get('/apply/{id}', 'ApplyController@show');
        Route::post('/shop', 'ShopController@store');
        Route::put('/admin/category/{id}', 'AdminController@categoryUpdate');
        Route::delete('/admin/category/{id}', 'AdminController@categoryDelete');
        Route::post('/categorycnt/{id}', 'AdminController@categoryCnt');
        Route::post('/cpu/{id}', 'AdminController@findCpu');
        Route::post('/vga/{id}', 'AdminController@findVga');
        Route::put('/cpu-edit/{id}', 'AdminController@cpuUpdate');
        Route::put('/vga-edit/{id}', 'AdminController@vgaUpdate');
        Route::post('/cpu', 'AdminController@cpuCreate');
        Route::post('/vga', 'AdminController@vgaCreate');
        Route::post('/cpu-delete/{id}', 'AdminController@cpuCnt');
        Route::post('/vga-delete/{id}', 'AdminController@vgaCnt');
        Route::delete('/cpu/{id}', 'AdminController@cpuDelete');
        Route::delete('/vga/{id}', 'AdminController@vgaDelete');
        Route::get('/products', 'MyProductController@index');
    });


});
