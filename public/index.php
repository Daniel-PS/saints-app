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

Router::get('/saints/{id}/remove-authorship', 'SaintsController@removeAuthorship');

Router::get('/saints/{id}/comments/create', 'CommentsController@create');
Router::post('/saints/{id}/comments', 'CommentsController@store');
Router::get('/saints/{id}/comments/{id}/edit', 'CommentsController@edit');
Router::patch('/saints/{id}/comments/{id}', 'CommentsController@update');
Router::delete('/saints/{id}/comments/{id}', 'CommentsController@destroy');

Router::get('/register', 'AuthController@register');
Router::post('/', 'AuthController@doRegister');
Router::get('/login', 'AuthController@login');
Router::post('/authenticate', 'AuthController@authenticate');
Router::get('/logout', 'AuthController@logout');

Router::get('/users/{id}', 'UsersController@show');
Router::get('/users/{id}/edit', 'UsersController@edit');
Router::patch('/users', 'UsersController@update');

Router::get('/approval/saints', 'ApprovalController@saints');
Router::patch('/approval/saints/approve', 'ApprovalController@approveSaint');
Router::delete('/approval/saints/remove', 'ApprovalController@removeSaint');
Router::get('/approval/comments', 'ApprovalController@comments');
Router::patch('/approval/comments/approve', 'ApprovalController@approveComment');
Router::delete('/approval/comments/remove', 'ApprovalController@removeComment');

Router::post('/devote', 'DevotionsController@store');
Router::get('/the-good-samaritan', 'HomeController@goodSamaritan');

Router::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
