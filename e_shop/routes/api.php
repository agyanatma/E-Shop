<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/product', 'Api\ProductController@index');
Route::get('/category', 'Api\CategoryController@index');
Route::get('/order', 'Api\OrderController@index');
Route::get('/user', 'Api\UserController@index');

Route::post('/register', 'Api\UserController@register');
Route::post('/login', 'Api\UserController@login');

Route::group(['middleware'=>['auth:api']],function(){
    Route::get('/user/profile', 'Api\UserController@profile');
    Route::put('user/profile/{user}', 'Api\UserController@update');
});