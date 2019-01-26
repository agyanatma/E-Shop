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

//ProductPage
Route::get('product', 'Frontend\ProductController@index');
Route::get('/', 'Frontend\ProductController@index');
Route::get('/index', 'Frontend\ProductController@index');
Route::get('/shop', 'Frontend\ProductController@shop');
Route::get('/tambahproduct', 'Frontend\ProductController@tambahproduct');
Route::get('/detailproduct', 'Frontend\ProductController@detailproduct');
Route::get('/wishlist', 'Frontend\ProductController@wishlist');
Route::get('product', 'Frontend\ProductController@index');
Route::get('/category/{id}/image', 'Frontend\ProductController@index');
Route::get('category/{category_name}', 'Frontend\CategoryController@product')->name('productCategory');
Route::get('product/{id}/detailproduct', 'Frontend\ProductController@detailproduct')->name('detailproduct');
Route::get('/searchcontent', 'Frontend\ProductController@searchcontent');
Route::get('/css/costum1.css', function(){
    return view('css.costum1.css');
});

//SortPage
Route::get('/sortheadphone', 'Frontend\SortController@sortheadphone');
Route::get('/sortkeyboard', 'Frontend\SortController@sortkeyboard');
Route::get('/sortleptop', 'Frontend\SortController@sortleptop');
Route::get('/sortmonitor', 'Frontend\SortController@sortmonitor');
Route::get('/sortprocessor', 'Frontend\SortController@sortprocessor');
Route::get('/sortbattery', 'Frontend\SortController@sortbattery');
Route::get('/sortcpu', 'Frontend\SortController@sortcpu');
Route::get('/sorthdmi', 'Frontend\SortController@sorthdmi');
Route::get('/sortmotherboard', 'Frontend\SortController@sortmotherboard');
Route::get('/sortmouse', 'Frontend\SortController@sortmouse');
Route::get('/sortpowercable', 'Frontend\SortController@sortpowercable');
Route::get('/sortprinter', 'Frontend\SortController@sortprinter');
Route::get('/lainlain', 'Frontend\SortController@lainlain');
//CategoryPage
Route::get('/category', 'Frontend\CategoryController@category');

//UsersPage
Route::get('/user', 'Frontend\UserController@user');
Route::get('/loginaccount', 'Frontend\UserController@loginaccount')->name('loginaccountPage');
Route::post('/loginaccount/log', 'Frontend\UserController@loginaccountStore')->name('store.loginaccount');
Route::get('/registeraccount', 'Frontend\UserController@registeraccount')->name('registeraccountPage');
Route::post('/registeraccount/reg', 'Frontend\UserController@registeraccountStore')->name('store.registeraccount');
Route::get('/logout', 'Frontend\UserController@logout')->name('logoutUser');
Route::get('user/{id}/user', 'Frontend\UserController@user')->name('user');
Route::post('user/{id}/edit', 'Frontend\UserController@update')->name('editUser');
Route::get('user/{id}/password', 'Frontend\UserController@password')->name('changePassword');
Route::post('user/{id}/password/changed', 'Frontend\UserController@updatePass')->name('updatePassword');
//Route::get('/upload/{Logo.png}','Frontend\UserController@registeraccount'); 


//CartPage
Route::post('/cart', 'Frontend\CartController@index')->name('cart.index');

//OrderPage
Route::get('/order', 'Frontend\OrderController@order');

                                        /*BACKEND PAGE*/



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
    //Route::get('category/{category_name}', 'Backend\CategoryController@product')->name('productCategory');
    //Route::get('product/{id}/detail', 'Backend\ProductController@detail')->name('detailProduct');
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
    Route::post('order/store', 'Backend\OrderController@addCart')->name('addCart');
    Route::get('order/{id}/checkout', 'Backend\OrderController@checkout')->name('checkout');
    Route::post('order/{id}/checkout/bayar', 'Backend\OrderController@status')->name('paid');
    
    

});
