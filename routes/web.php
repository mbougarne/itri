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

# Front routes
Route::group(['middleware' => ['guest']], function () {

    # Login Info
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@getLogin')->name('user.login');
        Route::post('/login', 'UserController@store')->name('user.login');
        # Profile
        Route::get('/{profile}', 'ProfileController@show')->name('profile');
    });

    # Posts
    Route::group(['prefix' => 'posts'], function() {
        Route::get('/{post:slug}', 'PostController@show')->name('post.show');
    });

    # Pages
    Route::get('/{page:slug}', 'PageController@show')->name('page.show');

    # Category
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/{category:slug}', 'CategoryController@show')->name('category.show');
    });

    # Tag
    Route::group(['prefix' => 'tags'], function() {
        Route::get('/{tag:slug}', 'TagController@show')->name('tag.show');
    });

    # Comment
    Route::post('/comments/create', 'CommentController@store')->name('comment.create');
});



