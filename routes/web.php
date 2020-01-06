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

Route::prefix('api')->group(function () {
    Route::get('/categories', 'Backend\CategoryController@apiIndex');
    Route::post('/categories/attribute', 'Backend\CategoryController@apiIndexAttribute');
    Route::get('/province','Auth\RegisterController@getAllProvince');
    Route::get('/cities/{provinceId}','Auth\RegisterController@getAllCities');
    Route::get('/products/{id}','Frontend\ProductController@apiGetProduct');
    Route::get('/sort-products/{id}/{sort}/{paginate}','Frontend\ProductController@apiGetSortedProduct');
    Route::get('/category-attribute/{id}','Frontend\ProductController@apiGetCategoryAttributes');
    Route::get('/filter-products/{id}/{sort}/{paginate}/{attributes}','Frontend\ProductController@apiGetFilterProducts');
});
Route::prefix('admins')->group(function (){
   Route::get('/','Backend\MainController@mainpage');
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
   Route::post('photos/upload','Backend\PhotoController@upload')->name('photos.upload');
   Route::resource('photos','Backend\PhotoController');
   Route::get('products.delete/{id}','Backend\ProductController@delete')->name('products.delete');
   Route::resource('products','Backend\ProductController');
   Route::get('coupons.delete/{id}','Backend\CouponController@delete')->name('coupons.delete');
   Route::resource('coupons','Backend\CouponController');
   Route::get('slides.delete/{id}','Backend\SlideController@delete')->name('slides.delete');
   Route::resource('slides','Backend\SlideController');
});
Route::group(['middleware'=>'auth'],function (){
    Route::get('/profile','Auth\RegisterController@profile')->name('user.profile');
    Route::post('/coupon','Frontend\CouponController@addCoupon')->name('coupon.add');
    Route::get('/order-verify','Frontend\OrderController@verify')->name('order.verify');
    Route::get('/payment-verify/{id}','Frontend\PaymentController@verify')->name('payment.verify');
});
Route::resource('/','Frontend\HomeController');
Route::get('verification','Auth\VerificationController@verify')->name('verification.verify');
Route::get('/add-to-cart/{id}','Frontend\CartController@addToCart')->name('cart.add');
Route::get('/user-acc','Auth\RegisterController@acc')->name('user.acc');
Route::post('/remove-to-cart/{id}','Frontend\CartController@removeItem')->name('cart.remove');
Route::get('/cart','Frontend\CartController@getCart')->name('cart.get');
Route::get('products/{slug}','Frontend\ProductController@getProduct')->name('product.single');
Route::get('category/{id}','Frontend\ProductController@getProductByCategory')->name('category.index');




