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
    return view('index');
});

// API routing
$router->group(['prefix' => 'api'], function () use ($router) {
    // tasks
    $router->get('tasks', ['uses' => 'TaskController@index']);
    $router->get('task/statuses', ['uses' => 'TaskController@statuses']);
    $router->get('task/{task_id}/newstatus/{status_id}', ['uses' => 'TaskController@updateStatus']);

    // projects
    $router->get('projects', ['uses' => 'ProjectController@index']);
    $router->get('project/statuses', ['uses' => 'ProjectController@statuses']);
    $router->get('project/{project_id}/newstatus/{status_id}', ['uses' => 'ProjectController@updateStatus']);
});
