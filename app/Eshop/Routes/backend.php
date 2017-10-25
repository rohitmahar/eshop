<?php


$router->group(['namespace' => 'Backend', 'middleware' => ['admin','auth']], function() use($router) {
    $router->get('dashboard', [
        'as' => 'dashboard.index',
        'uses' => 'DashboardController@dashboard'
    ]);
    $router->get('image-manager', [
        'as' => 'backend.image-manager',
        'uses' => 'FileManagerController@index'
    ]);
});
