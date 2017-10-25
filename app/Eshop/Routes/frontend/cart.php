<?php

$router->group(
    ['namespace' => 'Frontend'],
    function () use ($router) {

        $router->get(
            'show/carts',
            [
                'as'   => 'show.carts',
                'uses' => 'CartController@carts',
            ]
        );

        $router->get('carts/order-form', [
            'as' => 'orders.order-form',
            'uses' => 'CartController@orderForm'
        ]);

        $router->post(
            'addto/cart/{id}',
            array(
                'as'   => 'addto.cart',
                'uses' => 'CartController@add',
            )
        );

        $router->get(
          'update/{cart}/cart',
          [
              'as' => 'update.cart',
              'uses' => 'CartController@update'
          ]
        );

        $router->delete(
            'delete/cart/{rowId}',
            array(
                'as'   => 'delete.cart',
                'uses' => 'CartController@delete',
            )
        );
    }
);