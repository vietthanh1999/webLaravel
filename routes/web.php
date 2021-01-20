<?php

use Illuminate\Support\Facades\Route;

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



// Route::get('/', function () {
//     return view('welcome');
// });

Route::group([
    'namespace' => 'Frontend'
], function () {
    Route::get('/userlogin', 'UserController@index');
    Route::post('/userlogin', 'UserController@login');
    Route::get('/userlogout', 'UserController@logout');
    Route::get('/userregister', 'UserController@getRegister');
    Route::post('/userregister', 'UserController@register');

    Route::get('/blog', 'PageController@blog');
    Route::get('/blog_single/{id}','PageController@blog_single');
    Route::post('/rateblog','PageController@rateblog');
    Route::post('/blog_single/commentblog', 'PageController@commentblog');

    Route::get('/account', 'UserController@getaccount');
    Route::post('/account', 'UserController@postaccount');

    Route::get('/myproduct', 'ProductController@getmyproduct');
    Route::get('/addproduct', 'ProductController@getAddProduct');
    Route::post('/addproduct', 'ProductController@postAddProduct');
    Route::get('/editproduct/{id}', 'ProductController@edit');
    Route::post('/editproduct/{id}', 'ProductController@update');
    Route::get('/deleteproduct/{id}','ProductController@destroy');

    Route::get('/', 'HomeController@index');
    Route::get('/productdetail/{id}', 'HomeController@productdetail');

    Route::post('/ajaxcart','CartController@ajaxcart');
    Route::post('/ajaxcartdeleteproduct','CartController@deleteproduct');
    Route::post('/ajaxcart_quantity_up','CartController@quantityUp');
    Route::post('/ajaxcart_quantity_down','CartController@quantityDown');
    Route::post('/ajaxcart_total_price','CartController@totalPrice');
    Route::get('/cart','CartController@index','CartController@totalPrice');

    Route::post('/addtocartfromdetailproduct','CartController@addToCartFromProductDetail');

    Route::get('/checkout','CheckoutController@index');
    Route::post('/checkoutregister', 'CheckoutController@checkoutRegister');
    Route::get('/checkoutmail','CheckoutController@checkoutmail');
    Route::get('/sendmailorder','CheckoutController@sendMailOrder');

    Route::get('/search','SearchController@index');
    Route::post('/search','SearchController@search');
    Route::get('/searchadvanced','SearchController@getSearchAdvanced');
    Route::post('/searchadvanced','SearchController@postSearchAdvanced');

    Route::post('/ajaxpricerange', 'ProductController@ajaxPriceRange');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/index', 'Admin\DashBoardController@index')->name('dashBoard');


Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'country'], function () {
        Route::get('/', 'Admin\CountryController@index')->name('country');
        Route::get('/add', 'Admin\CountryController@addcountry')->name('getaddcountry');
        Route::post('/add', 'Admin\CountryController@create')->name('postaddcountry');

        Route::get('/delete/{id}', 'Admin\CountryController@delete')->name('getdeletecountry');

        Route::get('/edit/{id}', 'Admin\CountryController@edit')->name('geteditcountry');
        Route::post('/edit/{id}', 'Admin\CountryController@update')->name('posteditcountry');
    });


    Route::group(['prefix' => 'blog'], function () {
        Route::get('/','Admin\BlogController@index')->name('blog');

        Route::get('/add', 'Admin\BlogController@create')->name('createblog');
        Route::post('/add', 'Admin\BlogController@store')->name('storeblog');

        Route::get('/edit/{id}', 'Admin\BlogController@edit')->name('editblog');
        Route::post('/edit/{id}', 'Admin\BlogController@update')->name('updateblog');

        Route::get('/delete/{id}', 'Admin\BlogController@destroy')->name('getdeleteblog');
    });
    Route::get('/profile', 'Admin\UserController@index')->name('profile');
    Route::post('/profile', 'Admin\UserController@update')->name('updateprofile');
});




