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
Route::get('/', 'Backend\ProductController@guest')->name('userPage');
Route::get('/admin', 'Backend\ProductController@index')->name('adminPage');
Route::get('product/{id}/delete', 'Backend\ProductController@destroy')->name('deleteProduct');
Route::get('product/{id}/detail', 'Backend\ProductController@detail')->name('detailProduct');
Route::post('product/{id}/store', 'Backend\ProductController@storeDetail')->name('storeDetail');

//Create Page
Route::get('product/new', 'Backend\ProductController@show')->name('product.new');
Route::post('product/new/store', 'Backend\ProductController@store')->name('product.create');

 //Edit Page
Route::get('product/{id}/edit', 'Backend\ProductController@edit')->name('editProduct');
Route::post('product/{id}/update', 'Backend\ProductController@update')->name('updateProduct');
Route::get('product/{id}/edit/delete', 'Backend\ProductController@deleteImage')->name('deleteImage');

//Category Page
Route::get('category', 'Backend\CategoryController@index')->name('indexCategory');
Route::get('category/new', 'Backend\CategoryController@new')->name('newCategory');
Route::post('category/new/store', 'Backend\CategoryController@store')->name('storeCategory');
Route::get('category/{id}/delete', 'Backend\CategoryController@destroy')->name('deleteCategory');
Route::get('category/{id}/edit', 'Backend\CategoryController@edit')->name('editCategory');
Route::post('category/{id}/update', 'Backend\CategoryController@update')->name('updateCategory');
Route::get('category/{category_name}', 'Backend\CategoryController@product')->name('productCategory');


//Users Page
Route::get('login', 'Backend\UserController@login')->name('loginPage');
Route::post('login/store', 'Backend\UserController@loginStore')->name('store.login');
Route::get('register', 'Backend\UserController@signup')->name('registerPage');
Route::post('register/store', 'Backend\UserController@signupStore')->name('store.register');
Route::get('logout', 'Backend\UserController@logout')->name('logoutUser');
Route::get('profile/{id}/profile', 'Backend\UserController@profile')->name('profile');
Route::post('profile/{id}/edit', 'Backend\UserController@update')->name('editProfile');
Route::get('profile/{id}/password', 'Backend\UserController@password')->name('changePassword');
Route::post('profile/{id}/password/changed', 'Backend\UserController@updatePass')->name('updatePassword');

