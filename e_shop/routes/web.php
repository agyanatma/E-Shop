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