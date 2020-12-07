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
Route::get('change-locale/{lang}', function ($lang){
    Session::put('language', $lang);
    return redirect()->back();
})->name('change.locale');


Route::group([
    'namespace' => 'Admin',
    'as' => 'admin.',
    'prefix' => 'admin',
], function(){
    Route::get('/', 'LoginController@showLogin')->name('admin');
    Route::get('login', 'LoginController@showLogin')->name('login');
    Route::post('post/login', 'LoginController@login')->name('post.login');

    Route::group([
        'middleware' => 'admin',
    ], function(){
        Route::get('dashboard', 'AdminController@index')->name('dashboard');
        Route::get('logout', 'LoginController@logout')->name('logout');

        Route::resource('categories', 'CategoryController');
    });
});

Route::group([
    'namespace' => 'Web',
    'middleware' => 'redirect', 
], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@index')->name('home.index');
    Route::post('home/search', 'HomeController@search')->name('home.search');

    Route::get('categories/{cate_slug}', 'CategoryController@showCateBySlug')->name('categories.showCateBySlug');
    Route::get('product-details/{product_slug}', 'ProductController@showProductDetails')->name('products.showProductDetails');
    
    Route::get('login', 'LoginController@showLogin')->name('login');
    Route::post('post/login', 'LoginController@login')->name('post.login');
    Route::get('register', 'LoginController@showRegister')->name('register');
    Route::resources([
        'users' => 'ProfileController',
        'cart' => 'CartController'
    ]);
    Route::post('cart/update', 'CartController@updateAllCart')->name('cart.update.all');
    Route::get('cart/delete/{rowId}', 'CartController@delete')->name('cart.delete');

    Route::group([
        'middleware' => 'auth',
    ], function(){
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
});
