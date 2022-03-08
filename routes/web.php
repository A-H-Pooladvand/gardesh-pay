<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'posts', 'as' => 'post.'], function () use ($router) {
    $router->get('/', 'Api\Post\PostController@index');
    $router->get('{id}', 'Api\Post\PostController@show');
    $router->post('/', 'Api\Post\PostController@store');
    $router->put('{id}', 'Api\Post\PostController@update');
    $router->delete('{id}', 'Api\Post\PostController@destroy');
});

$router->group(['prefix' => 'comments', 'as' => 'comment.'], function () use ($router) {
    $router->post('/', 'Api\Comment\CommentController@store');
    $router->put('/', 'Api\Comment\CommentController@update');
    $router->delete('{id}', 'Api\Comment\CommentController@destroy');
});
