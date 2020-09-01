<?php

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

//a group of all student endpoints
$router->group(["prefix" => "api"], function () use ($router) {
    $router->get('/students/all', ['uses' => 'StudentsController@all']);
    $router->post('/students/create', ['uses' => 'StudentsController@create']);
});

//a group of all quizes endpoints
$router->group(["prefix" => "api"], function () use ($router) {
    $router->get('/quizes/all', ['uses' => 'QuizesController@all']);
    $router->post('/quizes/create', ['uses' => 'QuizesController@create']);
    $router->post('/quiz/answers', ['uses' => 'QuizesController@correction']);
});

//a group of all level endpoints
$router->group(["prefix" => "api"], function () use ($router) {
    $router->get('/levels/all', ['uses' => 'LevelsController@all']);
    $router->post('/level/create', ['uses' => 'LevelsController@create']);
});
