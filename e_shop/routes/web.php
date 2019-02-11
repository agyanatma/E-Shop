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
              
Route::get('/loginaccount', 'Frontend\UserController@loginaccount')->name('loginaccountPage');
Route::post('/loginaccount/log', 'Frontend\UserController@loginaccountStore')->name('store.loginaccount');
Route::get('/registeraccount', 'Frontend\UserController@registeraccount')->name('registeraccountPage');
Route::post('/registeraccount/reg', 'Frontend\UserController@registeraccountStore')->name('store.registeraccount');
Route::get('/logout', 'Frontend\UserController@logout')->name('logoutUser');

Route::get('/searchcontent', 'Frontend\ProductController@searchcontent');
Route::get('/', 'Frontend\ProductController@user')->name('userPage');

Route::get('product/{id}/detailproduct/', 'Frontend\ProductController@detailproduct')->name('detailproduct');
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

//Route::group(['middleware'=>['checkUser']],function(){
    
    //ORDERING
    //Route::post('order/store', 'Backend\OrderController@addCart')->name('addCart');
   
    
    



//ProductPage
//Route::get('product', 'Frontend\ProductController@index');
//Route::get('/', 'Frontend\ProductController@index');

//Route::get('/index', 'Frontend\ProductController@index');
//Route::get('/shop', 'Frontend\ProductController@shop');
//Route::get('/tambahproduct', 'Frontend\ProductController@tambahproduct');
//Route::get('/detailproduct', 'Frontend\ProductController@detailproduct');
//Route::get('/wishlist', 'Frontend\ProductController@wishlist');
//Route::get('product', 'Frontend\ProductController@index');
//Route::get('/category/{id}/image', 'Frontend\ProductController@index');
//Route::get('category/{category_name}', 'Frontend\CategoryController@product')->name('productCategory');


//CategoryPage
//Route::get('/category', 'Frontend\CategoryController@category');

//UsersPage
Route::get('/user', 'Frontend\UserController@user');

Route::get('user/{id}/user', 'Frontend\UserController@user')->name('user');
Route::post('user/{id}/edit', 'Frontend\UserController@update')->name('editUser');
Route::get('user/{id}/password', 'Frontend\UserController@gantipassword')->name('gantipassword');
Route::post('user/{id}/password/changed', 'Frontend\UserController@updatepassword')->name('updatepassword');
//Route::get('/upload/{Logo.png}','Frontend\UserController@registeraccount'); 


//CartPage
Route::post('product/{id}/addcart', 'Frontend\OrderController@langsungbayar')->name('addcartlangsung');
Route::post('product/addcart/{id}', 'Frontend\OrderController@checkout')->name('addCart');
Route::get('/order/cart/', 'Frontend\OrderController@cart')->name('cart');
Route::get('order/{id}/delete', 'Frontend\OrderController@deletecart')->name('deleteCart');
Route::get('/pembayaran/', 'Frontend\OrderController@getcheckoutgan')->name('checkoutgan');
Route::get('order/bayar/{id}', 'Frontend\OrderController@updatestatus')->name('bayar');
Route::post('/product/bayar', 'Frontend\OrderController@langsungbayar')->name('langsungbayar');
//Route::get('/product/bayar', 'Frontend\OrderController@getcheckoutgan')->name('langsungbayar');
//Route::get('/pembayaran', 'Frontend\OrderController@getcheckoutgan')->name('langsungbayar');
//Route::match('POST' 'GET'), ('/product/bayar', 'Frontend\OrderController@langsungbayar')->name('langsungbayar');

//Route::get('/pembayaran', 'Frontend\ProductController@getpembayaran')->name('pembayaranCart');
//Route::post('pembayaran', 'Frontend\ProductController@postpembayaran')->name('pembayaranCart');
//Route::get('/pembayaran/{id}', 'Frontend\OrderController@checkoutgan')->name('paid');
// Route::post('/pembayaran', 'Frontend\OrderController@postCheckoutgan')->name('checkoutGan');
// Route::get('/cartblog', 'Frontend\CartController@index')->name('cart.index');
//Route::post('/cartblogindex', 'Frontend\CartController@store')->name('cart.store');

Route::get('/add-to-cart/{id}', 'Frontend\ProductController@getAddToCart')->name('product.addToCart');
Route::get('/shopping-cart', 'Frontend\ProductController@getCart')->name('product.shoppingCart');

Route::patch('update-cart', 'OrderController@update');
 
Route::delete('remove-from-cart', 'OrderController@remove');
//Route::get('/checkout', 'Frontend\ProductController@getCheckout')->name('checkoutCart');
//Route::post('checkout', 'Frontend\ProductController@postCheckout')->name('checkoutCart');

Route::get('/', 'Backend\ProductController@main')->name('userPage');
//OrderPage
//Route::get('/order', 'Frontend\OrderController@order');



//});

//Route::get('cart', 'Frontend\Cartcontroller@index')->name('cart.index');
                                        /*BACKEND PAGE*/
//Route::get('/', 'Backend\ProductController@guest')->name('userPage');

//LOGIN REGISTER
Route::get('login', 'Backend\UserController@login')->name('loginPage');
Route::post('login/store', 'Backend\UserController@loginStore')->name('store.login');
Route::get('register', 'Backend\UserController@signup')->name('registerPage');
Route::post('register/store', 'Backend\UserController@signupStore')->name('store.register');
Route::get('logout', 'Backend\UserController@logout')->name('logoutUser');

//INDEX
Route::get('category/{category_name}', 'Backend\CategoryController@product')->name('productCategory');
Route::get('product/{id}/detail', 'Backend\ProductController@detail')->name('detailProduct');






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
    Route::get('admin/category/{id}/edit/delete', 'Backend\CategoryController@deleteImage')->name('delete.category');

    //CRUD ORDER
    Route::get('admin/order', 'Backend\OrderController@index')->name('indexOrder');
    Route::get('admin/order/{id}/delete', 'Backend\OrderController@destroy')->name('deleteOrder');
    Route::get('admin/order/{id}/edit', 'Backend\OrderController@edit')->name('editOrder');
    Route::get('admin/order/{id}/pay', 'Backend\OrderController@bayar')->name('payOrder');

    //CRUD USER
    Route::get('admin/user/{id}/change', 'Backend\UserController@admin')->name('admin');
    Route::get('admin/user/{id}/destroy', 'Backend\UserController@destroy')->name('adminDelete');
    Route::get('admin/user/datatables', 'Backend\UserController@dataTables')->name('table.user');

});
