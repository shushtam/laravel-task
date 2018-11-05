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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'seller']], function () {
    Route::get('/products/create', 'SellerController@create');
    Route::get('/products', 'SellerController@index');
    Route::post('/products', 'SellerController@store');
    Route::get('/products/{id}/edit', 'SellerController@edit');
    Route::post('/products/{id}/update', 'SellerController@update');
    Route::get('/view-orders', 'SellerController@viewOrders');
    Route::get('/images/{id}/delete', 'SellerController@deleteImage');
    Route::get('/approve-order/{order}', 'SellerController@approveOrder');
});

Route::group(['middleware' => ['auth', 'admin-seller']], function () {
    Route::get('/products/{id}/delete', 'SellerController@delete');
});

Route::group(['middleware' => ['auth', 'customer']], function () {
    Route::post('/make-order', 'CustomerController@makeOrder');
    Route::get('/view-products', 'CustomerController@viewProducts');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/confirm-product/{id}', 'AdminController@confirmProduct');
    Route::get('/confirm-order/{order}', 'AdminController@confirmOrder');
    Route::get('/sellers/{id}/delete', 'AdminController@deleteSeller');
});




