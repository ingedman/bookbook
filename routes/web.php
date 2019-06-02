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



Auth::routes();

// reviews routes
Route::get('/', 'ReviewController@index');
Route::get('/home', 'ReviewController@index')->name('home');
Route::get('reviews/create', 'ReviewController@create')->name('review.create');
Route::post('reviews/create', 'ReviewController@store')->name('review.store');
Route::get('reviews/{slug}', 'ReviewController@show')->name('review');
Route::get('reviews/{review}/comments', 'CommentController@comments')->name('comments');
Route::get('reviews/{slug}/edit', 'ReviewController@edit')->name('review.edit');
Route::post('reviews/{slug}/edit', 'ReviewController@update')->name('review.update');



// authors routes
Route::get('authors/{author}/', 'AuthorController@show')->name('author');


// users routes
Route::get('users/{user}', 'UserController@profile')->name('user.profile');
Route::get('profile', 'UserController@ownProfile')->name('own-profile');
Route::get('followers', 'UserController@followers')->name('followers');
Route::get('following', 'UserController@following')->name('following');
Route::get('users/{user}/follow', 'UserController@follow')->name('user.follow');
Route::post('delete/user', 'UserController@destroy')->name('user.delete');

// settings routes
Route::get('settings', 'SettingsController@settings')->name('settings');
Route::post('settings', 'SettingsController@updateSettings')->name('settings.update');
Route::post('settings/image', 'SettingsController@uploadImage')->name('settings.image');


// books routes
Route::get('books/{slug}', 'BookController@show')->name('book');


// search routes
Route::get('search/all/', 'SearchController@all')->name('search.all');
Route::get('search/books/', 'SearchController@books')->name('book.search');

// bookmarks routes
Route::get('bookmarks/review/{review}', 'BookmarkController@bookmarkReview')->name('review.bookmark');
Route::get('bookmarks', 'BookmarkController@index')->name('bookmarks');

// comments routes
Route::post('reviews/{slug}/comment', 'CommentController@addComment')->name('review.comment');
Route::get('comments/{comment}/replies', 'CommentController@replies')->name('replies');



// notifications routes

Route::get('notifications', 'NotificationController@index')->name('notifications');
Route::get('notifications/all', 'NotificationController@getAll')->name('notifications.all');
Route::get('notifications/unread', 'NotificationController@getUnread')->name('notifications.unread');
Route::get('notifications/read-all}', 'NotificationController@readAll')->name('notifications.read_all');
Route::get('notifications/read/{id}', 'NotificationController@read')->name('notifications.read');
Route::get('notifications/delete/{id}', 'NotificationController@delete')->name('notifications.delete');





// Reactions routes

Route::get('reviews/{review}/like', 'ReactionController@likeReview')->name('review.like');
Route::get('reviews/{review}/dislike', 'ReactionController@dislikeReview')->name('review.dislike');

Route::get('books/{book}/like', 'ReactionController@likeBook')->name('book.like');
Route::get('books/{book}/dislike', 'ReactionController@dislikeBook')->name('book.dislike');

Route::get('comments/{comment}/like', 'ReactionController@likeComment')->name('comment.like');
Route::get('comments/{comment}/dislike', 'ReactionController@dislikeComment')->name('comment.dislike');

// Reports routes

Route::post('reports/review/{review}', 'ReportController@reportReview')->name('review.report');
Route::post('reports/user/{user}', 'ReportController@reportUser')->name('user.report');
Route::post('reports/comment/{comment}', 'ReportController@reportComment')->name('comment.report');
Route::post('reports/book/{book}', 'ReportController@reportBook')->name('book.report');
Route::post('reports/author/{author}', 'ReportController@reportAuthor')->name('author.report');


// socialite routes

Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback')
    ->name('login.callback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


// trying things out

Route::get('testing',function(){

    $variable =\App\Review::where('id',1)->first()->controlsJson;
    return view('test',compact('variable'));
});