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

// $router->group(['prefix' => '/api/v1', 'namespace' => 'App\Http\Controllers\V1'], function ($router) {
//     $router->get('/users', 'UserController@all');
//     // $router->put('car/{id}', 'CarController@updateCar');
//     // $router->delete('car/{id}', 'CarController@deleteCar');
//     // $router->get('car', 'CarController@index');
// });

$router->get('/users', 'V1\UserController@all');
$router->get('/user/{id}', 'V1\UserController@show');
