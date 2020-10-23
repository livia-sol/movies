<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lists-movies', 'MoviesController@indexJson')->name('movies.indexJson');
Route::get('/add-movie', 'MoviesController@storeJson')->name('movies.storeJson');
Route::get('/delete-movie/{id?}', 'MoviesController@destroy')->name('movies.destroy');

Route::get('/menu', 'MoviesController@index')->name('movies.index');
Route::get('/menu-opened', 'MoviesController@showMenu')->name('movies.showMenu');

//Aditional features
Route::get('/insert-movie', 'MoviesController@create')->name('movies.create');
Route::post('/store', 'MoviesController@store')->name('movies.store');