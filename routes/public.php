<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index');

Route::get('post/{post}-{slug}', [
    'as' => 'posts.show',
    'uses' => 'PostController@show'
]);

Route::get('posts-pendientes/{category?}', [
    'uses' => 'PostController@index',
    'as' => 'posts.pending'
]);

Route::get('posts-compleados/{category?}', [
    'uses' => 'PostController@index',
    'as' => 'posts.completed'
]);

Route::get('{category?}/', [ //? indica que es opcional
    'uses' => 'PostController@index',
    'as' => 'posts.index'
]);