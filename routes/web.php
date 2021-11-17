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

Route::get('/', 'ItemsController@top')->name('top');

Route::get('/items/{item}/edit_image','ItemsController@edit_image')->name('items.edit_image');

Route::patch('/items/{item}/edit_image','ItemsController@update_image')->name('items.update_image');

Auth::routes();

Route::resource('items','ItemsController');

Route::get('users/edit','UserController@edit')->name('users.edit');

Route::patch('/users','UserController@update')->name('users.update');

Route::get('/users/edit_image','UserController@edit_image')->name('users.edit_image');

Route::patch('/users/edit_image','UserController@update_image')->name('users.update_image');

Route::get('/users/show','UserController@show')->name('users.show');

//UsersControllerに書かないといけない？そっちだとリレーションうまくいかない
Route::get('/users/exhibitions','ItemsController@exhibitions')->name('users.exhibitions');

Route::get('/likes','LikeController@likesIndex')->name('likes.index');

Route::patch('/items/{item}/toggle_like','ItemsController@toggleLike')->name('items.toggle_like');

//ここもコントローラーどこに書く？
Route::get('/items/{item}/confirm','OrderController@confirm')->name('items.confirm');

Route::post('/items/{item}/finish','OrderController@finish')->name('items.finish');


