<?php

$router->group(['namespace' => 'Backend', 'middleware' => ['auth', 'admin']], function() use($router){
    $router->get('backend/sliders/{slider}/confirm', [
        'as'=> 'sliders.confirm',
        'uses' => 'SliderController@confirm'
    ]);
    $router->resource('backend/sliders', 'SliderController');
});