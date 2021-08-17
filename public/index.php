<?php

use App\Router;

require_once '../src/autoload.php';
require_once '../src/functions.php';
require_once '../src/constants.php';

loadFileToEnvironment(BASE_FOLDER_PATH . '/.env');

Router::get('/', 'HomeController@index');
Router::get('/saints/create', 'SaintsController@create');
Router::post('/saints/store', 'SaintsController@store');
Router::get('/saints/{id}/show', 'SaintsController@show');
Router::get('/saints/{id}/edit', 'SaintsController@edit');
Router::patch('/saints/{id}/update', 'SaintsController@update');
Router::delete('/saints/{id}/delete', 'SaintsController@destroy');

Router::get('/register', 'UsersController@register');
Router::post('/', 'UsersController@doRegister');
Router::get('/login', 'UsersController@login');
Router::post('/authenticate', 'UsersController@authenticate');

Router::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
