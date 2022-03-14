<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/receitas'], function () use ($router) {
    $router->post('/', 'ReceitaController@store');
    $router->get('', 'ReceitaController@index');
    $router->get('{id}', 'ReceitaController@get');
    $router->put('{id}', 'ReceitaController@update');
    $router->delete('{id}', 'ReceitaController@destroy');
});