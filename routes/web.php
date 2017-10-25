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

$router->group(['namespace' => 'Frontend'], function() use($router) {
    $router->get('/',[
        'as' => 'homepage', 
        'uses' => 'ProductController@index'
    ]);
    $router->get('/homepage',[
        'as' => 'homepage',
        'uses' => 'ProductController@index'
    ]);

    $router->get('terms-conditions', [
       'as' => 'terms',
        'uses' => 'ProductController@terms'
    ]);

    $router->get('product/{product}/detail', [
        'as' => 'product.detail',
        'uses' => 'ProductController@detail'
    ]);

    $router->get('category/{category}/products' , [
        'as' => 'products.index',
        'uses' => 'ProductController@products'
    ]);

    $router->get('contact', [
        'as' => 'eshop.contact',
        'uses' => 'ContactController@contact'
    ]);
    
    $router->post('contact/email', [
        'as' => 'contact.email',
        'uses' => 'ContactController@sendMail'
    ]);
});
$router->group(['namespace' => 'Frontend', 'middleware' => 'auth'], function() use($router) {
    $router->get('profile/setting',[
        'as' => 'profile.setting',
        'uses' => 'ProfileSettingController@setting'
    ]);
    $router->get('profile/purchase', [
        'as' => 'profile.purchase',
        'uses' => 'ProfileSettingController@purchase'
    ]);
    $router->put('profile/update/{id}', [
       'as' => 'profile.update',
       'uses' => 'ProfileSettingController@profileUpdate'
    ]);
    $router->post('password/update', [
        'as' => 'password.update',
        'uses' => 'ProfileSettingController@passwordReset'
    ]);
    $router->post('order', [
        'as' => 'product.order',
        'uses' => 'OrderController@store'
    ]);
});
Auth::routes();


