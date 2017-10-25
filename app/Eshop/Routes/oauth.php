<?php

$router->group(['namespace' => 'Auth\OAuth'],function() use($router){
    $router->get('auth/google',array(
        'as' => 'oauth.google',
        'uses' => 'GoogleOAuthController@redirectToProvider'
    ));

    $router->get('auth/google/callback',array(
        'as' => 'oauth.google.callback',
        'uses' => 'GoogleOAuthController@handleProviderCallback'
    ));

    $router->get('auth/facebook',array(
        'as' => 'oauth.facebook',
        'uses' => 'FacebookOAuthController@redirectToProvider'
    ));

    $router->get('auth/facebook/callback',array(
        'as' => 'oauth.facebook.callback',
        'uses' => 'FacebookOAuthController@handleProviderCallback'
    ));

    $router->get('auth/twitter',array(
        'as' => 'oauth.twitter',
        'uses' => 'TwitterOAuthController@redirectToProvider'
    ));

    $router->get('auth/twitter/callback',array(
        'as' => 'oauth.twitter.callback',
        'uses' => 'TwitterOAuthController@handleProviderCallback'
    ));
});