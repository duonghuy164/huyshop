<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('','ClientController@index');

Route::get('getproducttype','AjaxController@getProductType');

Route::group(['prefix'=>'admin'],function(){
      //appstore.com/admin/,...
	Route::resource('category','CategoryController');
	Route::resource('producttype','ProductTypeController');
	Route::resource('product','ProductsController');
	Route::post('updatePro/{id}','ProductsController@update');
});

Route::get('callback/{social}','HomeController@handleProviderCallback');

Route::get('login/{social}','HomeController@redirectProvider')->name('login.social');

Route::get('logout','HomeController@logout');

Route::post('signup','HomeController@signup')->name('signup');








Route::post('login','HomeController@login')->name('login');

Route::resource('cart','CartController');

Route::get('addcart/{id}','CartController@addCart')->name('addCart');

Route::get('checkout','CartController@checkout')->name('checkout');

Route::resource('customer','CustomerController');

