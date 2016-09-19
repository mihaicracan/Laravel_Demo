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
    return redirect('/books');
});

Auth::routes();
Route::get('/signup', 'Auth\RegisterController@showRegistrationForm');
Route::post('/signup', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function () {

    /**
     * Views
     */
    Route::get('/tags', 'TagsController@showIndexView');
    Route::get('/tags/add', 'TagsController@showAddView');
    Route::get('/tags/edit/{id}', 'TagsController@showEditView');

    Route::get('/authors', 'AuthorsController@showIndexView');
    Route::get('/authors/add', 'AuthorsController@showAddView');
    Route::get('/authors/edit/{id}', 'AuthorsController@showEditView');

    Route::get('/books', 'BooksController@showIndexView');
    Route::get('/books/add', 'BooksController@showAddView');
    Route::get('/books/edit/{id}', 'BooksController@showEditView');

    /**
     * Actions
     */
    Route::post('/tags/add', 'TagsController@add');
    Route::post('/tags/edit/{id}', 'TagsController@edit');
    Route::get('/tags/delete/{id}', 'TagsController@delete');

    Route::post('/authors/add', 'AuthorsController@add');
    Route::post('/authors/edit/{id}', 'AuthorsController@edit');
    Route::get('/authors/delete/{id}', 'AuthorsController@delete');

    Route::post('/books/add', 'BooksController@add');
    Route::post('/books/edit/{id}', 'BooksController@edit');
    Route::get('/books/delete/{id}', 'BooksController@delete');
    Route::post('/books/rent/{id}', 'BooksController@rent');
    Route::get('/books/unrent/{id}', 'BooksController@unrent');
});

