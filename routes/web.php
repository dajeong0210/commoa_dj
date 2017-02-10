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

Route::get('/shop', 'ShopController@index');
Route::resource('/product', 'ProductController');
Route::resource('/office', 'ProductController');
Route::resource('/game', 'ProductController');
Route::resource('/graphic', 'ProductController');
Route::get('/category/{category_name}', 'CategoryController@show');
Route::post('/viewcount/{product_id}', 'ProductController@viewCount');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/mypage', 'MyPageController@index');
    Route::get('/myinfo', 'MyPageController@userIndex');
    Route::put('/myinfo/{id}', 'MyPageController@userUpdate');
    Route::get('/bookmark', 'MyPageController@bookmarkIndex');
    Route::post('/bookmark/{id}', 'MyPageController@bookmarkStore');
    Route::get('/favorite', 'MyPageController@favoriteIndex');
    Route::post('/favorite/{id}', 'MyPageController@favoriteStore');

    Route::group(['middleware' => 'User'], function () {
        Route::get('/apply/create', 'ApplyController@create');
        Route::post('/apply', 'ApplyController@store');
        Route::put('/apply/{id}', 'ApplyController@update');
        Route::delete('/apply/{id}', 'ApplyController@destroy');
        Route::get('/apply/{id}/edit', 'ApplyController@edit');
    });

    Route::group(['middleware' => 'ShopAdmin'], function () {
        Route::resource('/myproduct', 'MyProductController');
        Route::get('/shop/{s_id}/edit', 'ShopController@edit');
        Route::put('/shop/{s_id}', 'ShopController@update');
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
        Route::resource('/admin/product', 'MyProductController');
        Route::resource('/admin/shop', 'ShopController');
        Route::get('/admin/user', 'AdminController@userIndex');
        Route::get('/admin/user/{id}/edit', 'AdminController@userShow');
        Route::put('/admin/user/{id}', 'AdminController@userUpdate'); 
        Route::delete('/admin/user/{id}', 'AdminController@userDelete');
        Route::put('/admin/permission/{id}', 'AdminController@permissionUpdate');
        Route::get('/admin/banner', 'AdminController@bannerIndex');
        Route::put('/admin/banner/{id}', 'AdminController@bannerUpdate');
        Route::get('/admin/recommend', 'AdminController@recommendIndex');
        Route::put('/admin/recommend/{id}', 'AdminController@recommendUpdate');
        Route::delete('/admin/recommend/{id}', 'AdminController@recommendDelete');
        Route::get('/admin/popup/{id}', 'AdminController@recommendPopup');
    });
    
});