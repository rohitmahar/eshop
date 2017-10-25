<?php

$router->group(['namespace' => 'Backend', 'middleware' => ['auth']],function() use($router){
    $router->get('backend/customers',[
        'as' => 'customers.index',
        'uses' => 'UserController@customer'
    ]);
    $router->get('backend/admins',[
        'as' => 'admins.index',
        'uses' => 'UserController@admin'
    ]);
    $router->get('backend/admins/create',[
        'as' => 'admins.create',
        'uses' => 'UserController@create'
    ]);
    $router->post('admin/register', [
        'as' => 'admins.register',
        'uses' => 'UserController@register'
    ]);
});