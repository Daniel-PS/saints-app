<?php

use App\Router;

require_once '../src/autoload.php';
require_once '../src/functions.php';
require_once '../src/constants.php';

loadFileToEnvironment(BASE_FOLDER_PATH . '/.env');

Router::get('/', 'HomeController@index');

Router::get('/saints', 'SaintsController@index');
Router::get('/saints/create', 'SaintsController@create');
Router::post('/saints/store', 'SaintsController@store');
Router::get('/saints/{id}', 'SaintsController@show');
Router::get('/saints/{id}/edit', 'SaintsController@edit');
Router::patch('/saints/{id}/update', 'SaintsController@update');
Router::delete('/saints/{id}/delete', 'SaintsController@destroy');

Router::get('/register', 'AuthController@register');
Router::post('/', 'AuthController@doRegister');
Router::get('/login', 'AuthController@login');
Router::post('/authenticate', 'AuthController@authenticate');
Router::get('/logout', 'AuthController@logout');

Router::get('/users/{id}', 'UsersController@show');
Router::get('/users/{id}/edit', 'UsersController@edit');
Router::get('/users/', 'UsersController@update');

Router::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
