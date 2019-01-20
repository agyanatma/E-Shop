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

/*Route::get('/', function (){
    return view('index');
});*/
Route::get('/', 'PagesController@index');
Route::get('/index', 'PagesController@index');
Route::get('/indexuser', 'PagesController@indexuser');
Route::get('/order', 'PagesController@order');
Route::get('/product', 'PagesController@product');
Route::get('/category', 'PagesController@category');
Route::get('/user', 'PagesController@user');

Route::get('/shop', 'PagesController@shop');
Route::get('/add-to-cart/{id}',[
    'uses' => 'ProductController@getAddToCart',
    'as' => 'product.AddToCart'
]);
Route::get('/tambahproduct', 'PagesController@tambahproduct');
Route::get('/registeraccount', 'PagesController@registeraccount');
Route::get('/loginaccount', 'PagesController@loginaccount');
Route::get('/wishlist', 'PagesController@wishlist');


//Product page
Route::get('product', 'Backend\ProductController@index');
Route::get('product', 'Backend\ProductController@index');
Route::post('product/{id}/delete', 'Backend\ProductController@destroy')->name('deleteProduct');

//Create Page
Route::get('product/new', 'Backend\ProductController@show')->name('product.new');
Route::post('product/new', 'Backend\ProductController@store')->name('product.create');
Route::get('create', 'Backend\ProductController@show');

 //Edit Page
Route::get('product/{id}/edit', 'Backend\ProductController@edit')->name('editProduct');
Route::post('product/{id}/update', 'Backend\ProductController@update')->name('updateProduct');
Route::post('product/{id}//edit/delete', 'Backend\ProductController@deleteImage')->name('deleteImage');
Route::get('/index', 'ProductController@index');