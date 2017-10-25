<?php

$router->group(['namespace' => 'Backend', 'middleware' => ['auth', 'admin'] ],function() use($router){
    $router->resource('settings', 'SettingController',
        [
            'only' => [
                'index', 'update'
            ]
        ]
    );
});