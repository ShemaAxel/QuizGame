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
$router->group(["prefix" => "api",'middleware' => 'auth'], function () use ($router) {
    $router->get('/students/all', ['uses' => 'StudentsController@all']);
    $router->post('/students/create', ['uses' => 'StudentsController@create']);
    $router->post('/students/login', ['uses' => 'StudentsController@login']);
    $router->get('/students/deactivate/{id}', ['uses' => 'StudentsController@deactivate']);
    $router->get('/students/activate/{id}', ['uses' => 'StudentsController@activate']);

});

//a group of all quizes endpoints
$router->group(["prefix" => "api",'middleware' => 'auth'], function () use ($router) {
    $router->get('/quizes/all', ['uses' => 'QuizesController@all']);
    $router->post('/quizes/create', ['uses' => 'QuizesController@create']);
    $router->post('/quiz/answers', ['uses' => 'QuizesController@correction']);
    $router->get('/quiz/deactivate/{id}', ['uses' => 'QuizesController@deleteQuiz']);
});

//a group of all level endpoints
$router->group(["prefix" => "api",'middleware' => 'auth'], function () use ($router) {
    $router->get('/levels/all', ['uses' => 'LevelsController@all']);
    $router->post('/level/create', ['uses' => 'LevelsController@create']);
    $router->get('/level/{id}', ['uses' => 'LevelsController@findById']);

});
//a group of all level endpoints
$router->group(["prefix" => "api"], function () use ($router) {
    $router->get('/history/{id}', ['uses' => 'HistoryController@findById']);
});
