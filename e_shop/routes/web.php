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

//Product page
Route::get('/', 'Backend\ProductController@guest');
Route::get('/admin', 'Backend\ProductController@index');
Route::post('product/{id}/delete', 'Backend\ProductController@destroy')->name('deleteProduct');
Route::get('/product/{id}/detail', 'Backend\ProductController@detail')->name('detailProduct');
Route::post('/product/{id}/detail/store', 'Backend\ProductController@storeDetail')->name('storeDetail');

//Create Page
Route::get('product/new', 'Backend\ProductController@show')->name('product.new');
Route::post('product/new', 'Backend\ProductController@store')->name('product.create');

 //Edit Page
Route::get('product/{id}/edit', 'Backend\ProductController@edit')->name('editProduct');
Route::post('product/{id}/update', 'Backend\ProductController@update')->name('updateProduct');
Route::post('product/{id}/edit/delete', 'Backend\ProductController@deleteImage')->name('deleteImage');

//Category Page
Route::get('category/new', 'Backend\ProductController@category')->name('newCategory');
Route::post('category/new', 'Backend\ProductController@storeCategory')->name('storeCategory');

//Users Page
Route::get('/login', 'Backend\UserController@login')->name('loginPage');
Route::post('/login/log', 'Backend\UserController@loginStore')->name('store.login');
Route::get('/register', 'Backend\UserController@signup')->name('registerPage');
Route::post('/register/done', 'Backend\UserController@signupStore')->name('store.register');
Route::get('/profile/{id}', 'Backend\UserController@profile')->name('profile');
Route::post('/profile/{id}/edit', 'Backend\UserController@update')->name('editProfile');
Route::get('/profile/{id}/password', 'Backend\UserController@password')->name('changePassword');
Route::post('/profile/{id}/password/changed', 'Backend\UserController@updatePass')->name('updatePassword');

