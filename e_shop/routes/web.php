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
Route::get('/', 'Backend\ProductController@index');
Route::post('product/{id}/delete', 'Backend\ProductController@destroy')->name('deleteProduct');

//Create Page
Route::get('product/new', 'Backend\ProductController@show')->name('product.new');
Route::post('product/new', 'Backend\ProductController@store')->name('product.create');

 //Edit Page
Route::get('product/{id}/edit', 'Backend\ProductController@edit')->name('editProduct');
Route::post('product/{id}/update', 'Backend\ProductController@update')->name('updateProduct');
Route::post('product/{id}//edit/delete', 'Backend\ProductController@deleteImage')->name('deleteImage');

//Category Page
Route::get('categories/new', 'Backend\CategoryController@show')->name('showCategory');
Route::post('categories/new', 'Backend\CategoryController@store')->name('newCategory');