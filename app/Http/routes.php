<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/quit', 'Auth\QuitController@index');

Route::post('/use', 'Auth\LoginController@index');

Route::get('/article', 'ArticleController@index');

Route::get('/reply', 'Auth\ReplyController@index');

Route::get('/comment', 'CommentController@index');
