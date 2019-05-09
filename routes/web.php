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

Route::get('users/{user}/follow', 'UserController@follow')->name('user.follow');



Route::get('reviews/{slug}', 'ReviewController@show')->name('review');
Route::get('reviews/{slug}/like', 'ReviewController@like')->name('review.like');
Route::get('reviews/{slug}/dislike', 'ReviewController@dislike')->name('review.dislike');
Route::post('reviews/{slug}/comment', 'ReviewController@comment')->name('review.comment');
Route::post('reviews/{review}/report', 'ReviewController@report')->name('review.report');
Route::get('reviews/{review}/comments', 'CommentController@comments')->name('comments');

Route::get('comments/{comment}/replies', 'CommentController@replies')->name('replies');
Route::get('comments/{comment}/like', 'CommentController@like')->name('comment.like');
Route::get('comments/{comment}/dislike', 'CommentController@dislike')->name('comment.dislike');
Route::post('comments/{comment}/report', 'CommentController@report')->name('comment.report');


Route::get('books/{slug}', 'BookController@show')->name('book');

//Route::resource('/reviews','ReviewController');



//TODO: replace github with provider variable
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');






// Trying things out
Route::view('adminlte', 'layouts.master');
Route::view('author', 'author.show');
//Route::view('book', 'book.show');
//Route::view('review', 'review.show')->name('review');
Route::view('feed', 'home2');
Route::view('search', 'user.search')->name('search');
Route::get('like', 'ReviewController@like')->name('review.like');
