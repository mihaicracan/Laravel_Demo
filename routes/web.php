<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/signup', 'Auth\RegisterController@showRegistrationForm');
Route::post('/signup', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');

    Route::get('/tags', 'TagsController@showIndexView');
    Route::get('/tags/add', 'TagsController@showAddView');
    Route::get('/tags/edit/{id}', 'TagsController@showEditView');

    Route::post('/tags/add', 'TagsController@add');
});

