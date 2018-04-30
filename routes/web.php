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

// Index Page //////////////////////////////
Route::get('/', 'PagesController@index'); // Route::get('Dir Location', 'Controller@FunctionName');

// About Page //////////////////////////////
Route::get('/about', 'PagesController@about');

// Services Page //////////////////////////////
Route::get('/services', 'PagesController@services');

// Route for all the Resource Methods (index(), create(), store(), edit(), update(), show(), destroy())
Route::resource('posts', 'PostsController');   // Route::resource('row', 'controller');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




