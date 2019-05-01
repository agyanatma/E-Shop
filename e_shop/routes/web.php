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
                                        /*FRONTEND PAGE*/

Route::get('/', 'Frontend\ProductController@user')->name('userPage');     
Route::get('/loginaccount', 'Frontend\UserController@loginaccount')->name('loginaccountPage');
Route::post('/loginaccount/log', 'Frontend\UserController@loginaccountStore')->name('store.loginaccount');
Route::get('/registeraccount', 'Frontend\UserController@registeraccount')->name('registeraccountPage');
Route::post('/registeraccount/reg', 'Frontend\UserController@registeraccountStore')->name('store.registeraccount');
Route::get('/logout', 'Frontend\UserController@logout')->name('logoutUser');
Route::get('/searchcontent', 'Frontend\ProductController@searchcontent');
Route::get('product/{id}/detailproduct/', 'Frontend\ProductController@detailproduct')->name('detailproduct');

//SortPage
Route::get('/lainlain', 'Frontend\SortController@lainlain')->name('lainlain');
Route::get('/sort/category/{id}', 'Frontend\SortController@sortbycategory')->name('sortbycategory');

Route::group(['middleware'=>['checkUser']],function(){
    
//UsersPage
Route::get('/user', 'Frontend\UserController@user');
Route::get('user/{id}/user', 'Frontend\UserController@user')->name('user');
Route::post('user/{id}/edit', 'Frontend\UserController@update')->name('editUser');
Route::get('user/{id}/settings', 'Frontend\UserController@settings')->name('settings');
Route::get('user/{id}/password', 'Frontend\UserController@gantipassword')->name('gantipassword');
Route::post('user/{id}/password/changed', 'Frontend\UserController@updatepassword')->name('updatepassword');
Route::get('/order/{id}/detail', 'Frontend\UserController@detail')->name('detailorder');
Route::get('/historyorder/{id}/', 'Frontend\UserController@historyorder')->name('historyorder');
//wishlist
Route::post('product/{id}/wishlist', 'Frontend\WishlistController@tambahwishlist')->name('addWishlist');
Route::get('/wishlist/', 'Frontend\WishlistController@wishlist')->name('wishlist');
Route::get('wishlist/{id}/deletewishlist', 'Frontend\WishlistController@deletewishlist')->name('deletewishlist');
Route::get('wishlist/ubahwishlist', 'Frontend\WishlistController@ubahwishlist')->name('ubahwishlist');
Route::get('searchwishlist/', 'Frontend\WishlistController@searchwishlist')->name('searchwishlist');

//CartPage
Route::post('product/{id}/addcart', 'Frontend\OrderController@tambahlangsung')->name('addcartlangsung');
Route::post('product/addcart/{id}', 'Frontend\OrderController@checkout')->name('addCart');
Route::get('/order/cart/', 'Frontend\OrderController@cart')->name('cart');
Route::post('/order/cart/{id}/', 'Frontend\OrderController@updatecart')->name('updatecart');
Route::get('order/{id}/delete', 'Frontend\OrderController@deletecart')->name('deleteCart');

Route::get('/order/{id}', 'Frontend\OrderController@getcheckoutgan')->name('checkoutgan');
Route::get('/order/payment/{id}', 'Frontend\OrderController@paymentgan')->name('paymentcard');
Route::post('/order/payment/order/{id}/', 'Frontend\OrderController@paymentordergan')->name('paymentcardpost');
Route::post('/product/langsungbayar/{id}', 'Frontend\OrderController@langsungbayar')->name('langsungbayar');
Route::get('/langsungbayargan/', 'Frontend\OrderController@langsungbayargan')->name('langsungbayargan');
Route::post('order/pay/{id}/', 'Frontend\OrderController@bayar')->name('bayar');
Route::get('/product/langsungbayar/{id}/bayar', 'Frontend\OrderController@updatestatusbayarlangsung')->name('bayarlangsung');


});


/* BACKEND */


//ADMIN ONLY===================================================================================================================================
Route::get('admin', 'Backend\UserController@login')->name('login.admin');

Route::post('admin/login', 'Backend\UserController@loginStore')->name('store.admin');
Route::group(['middleware'=>['checkAdmin']],function(){
    Route::get('admin/dashboard', 'Backend\UserController@dashboard')->name('dashboard.admin');
    
    //CRUD PRODUCT
    Route::get('admin/product', 'Backend\ProductController@index')->name('product.admin');
    Route::get('admin/product/new', 'Backend\ProductController@create')->name('create.product');
    Route::post('admin/product/new/store', 'Backend\ProductController@store')->name('store.product');
    Route::get('admin/product/{id}/show', 'Backend\ProductController@show')->name('show.product');
    Route::get('admin/product/{id}/edit', 'Backend\ProductController@edit')->name('edit.product');
    Route::post('admin/product/{id}/update', 'Backend\ProductController@update')->name('update.product');
    Route::get('admin/product/{id}/delete', 'Backend\ProductController@destroy')->name('destroy.product');
    Route::get('admin/product/{id}/edit/imagedel', 'Backend\ProductController@deleteImage')->name('imagedel.product');
    Route::get('admin/product/datatables', 'Backend\ProductController@dataTables')->name('table.product');
    //CRUD CATEGORY
    Route::get('admin/category', 'Backend\CategoryController@index')->name('category.admin');
    Route::get('admin/category/new', 'Backend\CategoryController@create')->name('create.category');
    Route::post('admin/category/new/store', 'Backend\CategoryController@store')->name('store.category');
    Route::get('admin/category/{id}/show', 'Backend\CategoryController@show')->name('show.category');
    Route::get('admin/category/{id}/edit', 'Backend\CategoryController@edit')->name('edit.category');
    Route::post('admin/category/{id}/update', 'Backend\CategoryController@update')->name('update.category');
    Route::get('admin/category/{id}/delete', 'Backend\CategoryController@destroy')->name('destroy.category');
    Route::get('admin/category/datatables', 'Backend\CategoryController@dataTables')->name('table.category');

    //CRUD ORDER
    Route::get('admin/order', 'Backend\OrderController@index')->name('order.admin');
    Route::get('admin/order/{id}/show', 'Backend\OrderController@show')->name('show.order');
    Route::get('admin/order/{id}/delete', 'Backend\OrderController@destroy')->name('destroy.order');
    Route::get('admin/order/{id}/edit', 'Backend\OrderController@edit')->name('edit.order');
    Route::get('admin/order/payment', 'Backend\OrderController@payment')->name('payment.order');
    Route::get('admin/order/datatables', 'Backend\OrderController@dataTables')->name('table.order');
    

    //CRUD USER
    Route::get('admin/user', 'Backend\UserController@index')->name('index.admin');
    Route::get('admin/user/{id}/show', 'Backend\UserController@show')->name('show.admin');
    Route::get('admin/user/{id}/edit', 'Backend\UserController@edit')->name('edit.admin');
    Route::post('admin/user/{id}/edited', 'Backend\UserController@editStore')->name('edited.admin');
    Route::get('admin/user/{id}/destroy', 'Backend\UserController@destroy')->name('destroy.admin');
    Route::get('admin/user/add', 'Backend\UserController@register')->name('add.user');
    Route::post('admin/user/registed', 'Backend\UserController@registerStore')->name('registed.user');
    Route::get('admin/user/datatables', 'Backend\UserController@dataTables')->name('table.user');

    Route::get('profile/{id}', 'Backend\UserController@profile')->name('profile');
    Route::post('profile/{id}/edit', 'Backend\UserController@update')->name('editProfile');
    Route::get('profile/{id}/password', 'Backend\UserController@password')->name('changePassword');
    Route::post('profile/{id}/password/changed', 'Backend\UserController@updatePass')->name('updatePassword');
    
});
