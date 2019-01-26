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



//Route::group(['middleware'=>['guest']],function(){
    //MAIN PAGE
    Route::get('/', 'Backend\ProductController@guest')->name('userPage');

    //LOGIN REGISTER
    Route::get('login', 'Backend\UserController@login')->name('loginPage');
    Route::post('login/store', 'Backend\UserController@loginStore')->name('store.login');
    Route::get('register', 'Backend\UserController@signup')->name('registerPage');
    Route::post('register/store', 'Backend\UserController@signupStore')->name('store.register');
    Route::get('logout', 'Backend\UserController@logout')->name('logoutUser');

    //INDEX
    Route::get('category/{category_name}', 'Backend\CategoryController@product')->name('productCategory');
    Route::get('product/{id}/detail', 'Backend\ProductController@detail')->name('detailProduct');
//});

//ADMIN ONLY===================================================================================================================================
Route::get('admin', function(){
    return view('pages.admin.login');
})->name('adminLogin');
Route::post('admin/login', 'Backend\UserController@loginAdmin')->name('store.admin');
Route::group(['middleware'=>['checkAdmin']],function(){
    Route::get('admin/dashboard', 'Backend\UserController@dashboard')->name('adminPage');

    //CRUD PRODUCT
    Route::get('admin/product', 'Backend\ProductController@index')->name('adminPage');
    Route::get('admin/product/{id}/delete', 'Backend\ProductController@destroy')->name('deleteProduct');
    Route::post('admin/product/{id}/store', 'Backend\ProductController@storeDetail')->name('storeDetail');
    Route::get('admin/product/new', 'Backend\ProductController@show')->name('product.new');
    Route::post('admin/product/new/store', 'Backend\ProductController@store')->name('product.create');
    Route::get('admin/product/{id}/edit', 'Backend\ProductController@edit')->name('editProduct');
    Route::post('admin/product/{id}/update', 'Backend\ProductController@update')->name('updateProduct');
    Route::get('admin/product/{id}/edit/delete', 'Backend\ProductController@deleteImage')->name('deleteImage');

    //CRUD CATEGORY
    Route::get('admin/category', 'Backend\CategoryController@index')->name('indexCategory');
    Route::get('admin/category/new', 'Backend\CategoryController@new')->name('newCategory');
    Route::post('admin/category/new/store', 'Backend\CategoryController@store')->name('storeCategory');
    Route::get('admin/category/{id}/delete', 'Backend\CategoryController@destroy')->name('deleteCategory');
    Route::get('admin/category/{id}/edit', 'Backend\CategoryController@edit')->name('editCategory');
    Route::post('admin/category/{id}/update', 'Backend\CategoryController@update')->name('updateCategory');

    //CRUD ORDER
    Route::get('admin/order', 'Backend\OrderController@index')->name('indexOrder');
    Route::get('admin/order/{id}/delete', 'Backend\OrderController@destroy')->name('deleteOrder');
    Route::get('admin/order/{id}/edit', 'Backend\OrderController@edit')->name('editOrder');
    Route::get('admin/order/{id}/update', 'Backend\OrderController@update')->name('updateOrder');

});




//USER ONLY======================================================================================================================================
Route::group(['middleware'=>['checkUser']],function(){
    //CRUD USER PROFILE
    Route::get('profile/{id}', 'Backend\UserController@profile')->name('profile');
    Route::post('profile/{id}/edit', 'Backend\UserController@update')->name('editProfile');
    Route::get('profile/{id}/password', 'Backend\UserController@password')->name('changePassword');
    Route::post('profile/{id}/password/changed', 'Backend\UserController@updatePass')->name('updatePassword');

    //ORDERING
    //Route::post('order/store', 'Backend\OrderController@addCart')->name('addCart');
    Route::post('product/addcart', 'Backend\OrderController@checkout')->name('addCart');
    Route::post('order/{id}/checkout/bayar', 'Backend\OrderController@status')->name('paid');
    
    

});
