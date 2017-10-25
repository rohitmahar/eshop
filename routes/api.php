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
*/
Route::group(['namespace' => 'API'], function() {
    Route::get('/user', [
        'as' => 'api.user',
        'uses' => 'UserController@getCurrentUser'
    ]);
    Route::get('slider', [
        'as' => 'api.slider',
        'uses' => 'SliderController@getAllSliders'
    ]);
    Route::get('product', [
       'as' => 'api.product',
       'uses' => 'ProductController@getPaginatedProducts'
    ]);
    Route::get('category/{category}/products', [
        'as' => 'api.category.products',
        'uses' => 'ProductController@getPaginatedProductsByCategory'
    ]);
    Route::get('category/{category}', [
        'as' => 'api.product.category',
        'uses' => 'ProductCategoryController@getCategory'
    ]);
    Route::get('sub-category/{categoryId}', [
        'as' => 'api.sub-category',
        'uses' => 'CategoryController@getSubCategory'
    ]);
    Route::get('all-category', [
        'as' => 'api.all-category',
        'uses' => 'CategoryController@getAllCategory'
    ]);
    Route::get('category', [
        'as' => 'api.category',
        'uses' => 'CategoryController@getCategory'
    ]);
    Route::get('product/purchased-order', [
        'as' => 'api.product.purchased-order',
        'uses' => 'OrderController@getPaginatedPurchasedOrders'
    ]);
});

$router->group(['namespace' => 'API'], function() use($router) {
    Route::get('product/order', [
        'as' => 'api.product.order',
        'uses' => 'OrderController@getPaginatedOrders'
    ]);
    Route::get('product/delivered-order', [
        'as' => 'api.product.delivered-order',
        'uses' => 'OrderController@getDeliveredPaginatedOrders'
    ]);
    Route::get('customer', [
        'as' => 'api.customer',
        'uses' => 'UserController@getPaginatedCustomers'
    ]);
    Route::get('admin', [
        'as' => 'api.admin',
        'uses' => 'UserController@getAdmins'
    ]);
});