<?php

$router->group(['namespace' => 'Backend',
    'prefix'=>'products',
    'middleware' => ['admin', 'auth'] ], function() use($router)
    {

    $router->get('/',[
        'as' => 'admin.product.index',
        'uses' => 'ProductController@index'
    ]);

    $router->get('create', [
        'as' => 'admin.product.create',
        'uses' => 'ProductController@create'
    ]);

    $router->post('store', [
        'as' => 'admin.product.store',
        'uses' => 'ProductController@store'
    ]);

    $router->get('edit/{id}', [
        'as' => 'admin.product.edit',
        'uses' => 'ProductController@edit'
    ]);

    $router->put('update/{id}', [
        'as' => 'admin.product.update',
        'uses' => 'ProductController@update'
    ]);

    $router->get('show/{id}', [
        'as' => 'admin.product.show',
        'uses' => 'ProductController@show'
    ]);

    $router->delete('delete/{id}', [
        'as' => 'admin.product.delete',
        'uses' => 'ProductController@destroy'
    ]);

    $router->group(['prefix'=>'category'],function($router){

        $router->get('/', [
            'as' => 'admin.product.category.index',
            'uses' => 'ProductCategoryController@index'
        ]);

        $router->get('create', [
            'as' => 'admin.product.category.create',
            'uses' => 'ProductCategoryController@create'
        ]);

        $router->post('store', [
            'as' => 'admin.product.category.store',
            'uses' => 'ProductCategoryController@store'
        ]);

        $router->get('edit/{id}', [
            'as' => 'admin.product.category.edit',
            'uses' => 'ProductCategoryController@edit'
        ]);

        $router->put('update/{id}', [
            'as' => 'admin.product.category.update',
            'uses' => 'ProductCategoryController@update'
        ]);

        $router->delete('delete/{id}', [
            'as' => 'admin.product.category.delete',
            'uses' => 'ProductCategoryController@destroy'
        ]);
    });
});