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

//Route::group(['middleware'=>'admin'],function (){

//});
use Illuminate\Support\Facades\Auth;
Auth::routes();
Route::get('register/verify/{token}','Auth\RegisterController@verify');
Route::get('login/google', 'Auth\GoogleController@redirectToProvider')->name('google.login');
Route::get('auth/google/callback', 'Auth\GoogleController@handleProviderCallback');

Route::prefix('api')->group(function () {
    Route::get('/categories', 'Backend\CategoryController@apiIndex');
    Route::post('/categories/attribute', 'Backend\CategoryController@apiIndexAttribute');
    Route::get('/province','Frontend\AddressController@getAllProvince');
    Route::get('/cities/{provinceId}','Frontend\AddressController@getAllCities');
    Route::get('/products/{id}','Frontend\ProductController@apiGetProduct');
    Route::get('/sort-products/{id}/{sort}/{paginate}','Frontend\ProductController@apiGetSortedProduct');
    Route::get('/category-attribute/{id}','Frontend\ProductController@apiGetCategoryAttributes');
    Route::get('/filter-products/{id}/{sort}/{paginate}/{attributes}','Frontend\ProductController@apiGetFilterProducts');
    Route::post('/rating/new','Frontend\ProductController@setRating');
    Route::get('/rating/{id}','Frontend\ProductController@getRating');
    Route::post('favorite/{product}/add', 'Frontend\FavoriteController@favoriteProduct')->name('favorite.add');
    Route::post('unfavorite/{product}', 'Frontend\ProductController@unFavoriteProduct');
});
Route::prefix('admins')->group(function (){
   Route::get('login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
   Route::post('login','Auth\AdminLoginController@login')->name('admin.login.submit');
   Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
   Route::post('password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
   Route::get('password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
   Route::post('password/reset','Auth\AdminResetPasswordController@reset');
   Route::get('password/reset/{token}','Auth\AdminResetPasswordController@ShowResetForm')->name('admin.password.reset');
   Route::get('/', 'Backend\AdminController@index')->name('admin.dashboard');
   Route::get('categories.delete/{id}','Backend\CategoryController@delete')->name('categories.delete');
   Route::get('categories.indexSetting/{id}','Backend\CategoryController@indexSetting')->name('categories.indexSetting');
   Route::post('categories.saveSetting/{id}','Backend\CategoryController@saveSetting');
   Route::resource('categories','Backend\CategoryController');
   Route::get('attributes.delete/{id}','Backend\AttributeGroupController@delete')->name('attributes.delete');
   Route::resource('attributes','Backend\AttributeGroupController');
   Route::get('attributes-value.delete/{id}','Backend\AttributeValueController@delete')->name('attributes-value.delete');
   Route::resource('attributes-value','Backend\AttributeValueController');
   Route::get('brands.delete/{id}','Backend\BrandController@delete')->name('brands.delete');
   Route::resource('brands','Backend\BrandController');
   Route::get('cities.delete/{id}','Backend\CityController@delete')->name('cities.delete');
   Route::resource('province','Backend\ProvinceController');
   Route::get('province.delete/{id}','Backend\ProvinceController@delete')->name('province.delete');
   Route::resource('cities','Backend\CityController');
   Route::post('photos/upload','Backend\PhotoController@upload')->name('photos.upload');
   Route::resource('photos','Backend\PhotoController');
   Route::get('products.delete/{id}','Backend\ProductController@delete')->name('products.delete');
   Route::resource('products','Backend\ProductController');
   Route::get('coupons.delete/{id}','Backend\CouponController@delete')->name('coupons.delete');
   Route::resource('coupons','Backend\CouponController');
   Route::get('coupons/action/{id}/{status}','Backend\CouponController@action')->name('coupon.action');
   Route::get('slides.delete/{id}','Backend\SlideController@delete')->name('slides.delete');
   Route::get('slides/publish/{id}/{status}','Backend\SlideController@publish')->name('slides.publish');
   Route::resource('slides','Backend\SlideController');
   Route::resource('orders','Backend\OrderController');
   Route::get('neworders','Backend\OrderController@newOrders')->name('orders.new');
   Route::get('unpaidorders','Backend\OrderController@unpaidOrders')->name('orders.unpaid');
   Route::get('newusers','Backend\UserController@newUsersIndex')->name('new.users');
   Route::get('order/pay/{id}','Backend\OrderController@orderPay')->name('order.pay');
   Route::get('orders/lists/{id}','Backend\OrderController@getOrderLists')->name('orders.lists');
   Route::get('orders/send/{id}','Backend\OrderController@send')->name('order.send');
   Route::get('comments','Backend\CommentController@index')->name('comments.index');
   Route::patch('comments','Backend\CommentController@edit')->name('comments.edit');
   Route::get('comments','Backend\CommentController@index')->name('comments.index');
   Route::get('comments.show/{id}','Backend\CommentController@show')->name('comments.show');
   Route::get('comments.delete/{id}','Backend\CommentController@delete')->name('comments.delete');
   Route::post('comments/action/{id}','Backend\CommentController@action')->name('comments.action');
});
Route::group(['middleware'=>'auth'],function (){
    Route::get('/profile','Frontend\HomeController@profile')->name('user.profile');
    Route::post('/coupon','Frontend\CouponController@addCoupon')->name('coupon.add');
    Route::get('/order-verify','Frontend\OrderController@verify')->name('order.verify');
    Route::get('/payment-verify/{id}','Frontend\PaymentController@verify')->name('payment.verify');
    Route::get('orders','Frontend\OrderController@index')->name('profile.orders');
    Route::get('orders/lists/{id}','Frontend\OrderController@getOrderLists')->name('profile.orders.lists');
    Route::get('comment/store/{productId}/{userId}','Frontend\CommentController@store')->name('comment.store');
    Route::get('orders','Frontend\OrderController@index')->name('orders.userindex');
    Route::get('orders/products/{id}','Frontend\OrderController@getOrderLists')->name('orders.products');
    Route::get('favorites','Frontend\FavoriteController@index')->name('favorites.index');
    Route::get('payments/lists','Frontend\PaymentController@index')->name('payments.index');
    Route::get('addresses','Frontend\AddressController@index')->name('addresses.index');
    Route::get('addresses/create','Frontend\AddressController@create')->name('address.create');
    Route::get('addresses/store','Frontend\AddressController@store')->name('address.store');
    Route::get('addresses/edit/{id}','Frontend\AddressController@edit')->name('address.edit');
    Route::get('addresses.delete/{id}','Frontend\AddressController@delete')->name('address.delete');
    Route::post('addresses/update/{id}','Frontend\AddressController@update')->name('address.update');
    Route::get('/logout','Auth\LoginController@userLogout')->name('user.logout');
});
Route::resource('/','Frontend\HomeController');
Route::post('/autocomplete/fetch','Frontend\SearchController@fetch')->name('autocomplete.fetch');
Route::get('verification','Auth\VerificationController@verify')->name('verification.verify');
Route::get('contactme','Frontend\AddressController@contactme')->name('contact.me');
Route::get('/add-to-cart/{id}','Frontend\CartController@addToCart')->name('cart.add');
Route::post('/remove-to-cart/{id}','Frontend\CartController@removeItem')->name('cart.remove');
Route::post('/search/fetch','Frontend\LiveSearchController@fetch')->name('search.fetch');
Route::get('/cart','Frontend\CartController@getCart')->name('cart.get');
Route::get('product/single/{id}','Frontend\ProductController@getProduct')->name('products.single');
Route::get('category/single/{id}','Frontend\ProductController@categoryProduct')->name('category.single');
Route::get('category/{id}','Frontend\ProductController@getProductByCategory')->name('category.index');



