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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile', 'UserController@profile')->name('profile');
Route::get('settings', 'UserController@settings')->name('settings');
Route::get('notifications', 'UserController@notifications')->name('notifications');




//TODO: replace github with provider variable
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');






// Trying things
Route::view('adminlte', 'layouts.master');
Route::view('author', 'author.show');
Route::view('book', 'book.show');
Route::view('review', 'review.show')->name('review');
Route::view('feed', 'home2');
Route::view('search', 'user.search')->name('search');
