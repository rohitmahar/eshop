<?php

$router->group(['namespace' => 'Backend', 'prefix' => 'orders', 'middleware' => ['admin', 'auth']], function() use($router) {
    $router->get('/', [
        'as' => 'admin.product.orders',
        'uses' => 'OrderController@index'
    ]);
    $router->get('/{order}/confirm', [
        'as' => 'admin.confirm.orders',
        'uses' => 'OrderController@confirm'
    ]);
    $router->delete('{order}/delete', [
        'as' => 'admin.orders.destroy',
        'uses' => 'OrderController@destroy'
    ]);
    $router->get('delivered', [
        'as' => 'product.order.delivered',
        'uses' => 'OrderController@delivered'
    ]);
    $router->get('/{order}/delivered', [
        'as' => 'orders.send.delivered',
        'uses' => 'OrderController@moveToDelivered'
    ]);
    $router->get('/{order}/back-order', [
        'as' => 'back.to.orders',
        'uses' => 'OrderController@moveToOrdered'
    ]);
});