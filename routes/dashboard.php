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

# Dashboard home page and thanks page
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/credits', 'DashboardController@credits')->name('credits');

# Profile
Route::group(['prefix' => 'profile'], function () {
    Route::get('/create', 'ProfileController@show')->name('profile.create');
    Route::post('/create', 'ProfileController@store')->name('profile.create');
    Route::get('/update/{profile}', 'ProfileController@edit')->name('profile.update');
    Route::post('/update/{profile}', 'ProfileController@update')->name('profile.update');
    Route::get('/{profile}', 'ProfileController@show')->name('profile');
});

# Posts
Route::group(['prefix' => 'posts'], function() {
    Route::get('/', 'PostController@index')->name('posts');
    Route::get('/published', 'PostController@index')->name('posts.published');
    Route::get('/pending', 'PostController@index')->name('posts.pending');
    Route::get('/create', 'PostController@create')->name('posts.create');
    Route::post('/create', 'PostController@store')->name('posts.create');
    Route::get('/update/{post:slug}', 'PostController@edit')->name('posts.update');
    Route::post('/update/{post:slug}', 'PostController@update')->name('posts.update');
    Route::post('/delete/{post:slug}', 'PostController@destroy')->name('posts.delete');
    Route::post('/upload-image', 'PostController@upload')->name('upload.image');
});

# Page
Route::group(['prefix' => 'pages'], function() {
    Route::get('/', 'PageController@index')->name('pages');
    Route::get('/create', 'PageController@create')->name('pages.create');
    Route::post('/create', 'PageController@store')->name('pages.create');
    Route::get('/update/{page:slug}', 'PageController@edit')->name('pages.update');
    Route::post('/update/{page:slug}', 'PageController@update')->name('pages.update');
    Route::post('/delete/{page:slug}', 'PageController@destroy')->name('pages.delete');
});

# Category
Route::group(['prefix' => 'categories'], function() {
    Route::get('/', 'CategoryController@index')->name('categories');
    Route::get('/create', 'CategoryController@create')->name('categories.create');
    Route::post('/create', 'CategoryController@store')->name('categories.create');
    Route::get('/update/{category:slug}', 'CategoryController@edit')->name('categories.update');
    Route::post('/update/{category:slug}', 'CategoryController@update')->name('categories.update');
    Route::post('/delete/{category:slug}', 'CategoryController@destroy')->name('categories.delete');
});

# Tag
Route::group(['prefix' => 'tags'], function() {
    Route::get('/', 'TagController@index')->name('tags');
    Route::get('/create', 'TagController@create')->name('tags.create');
    Route::post('/create', 'TagController@store')->name('tags.create');
    Route::get('/update/{tag:slug}', 'TagController@edit')->name('tags.update');
    Route::post('/update/{tag:slug}', 'TagController@update')->name('tags.update');
    Route::post('/delete/{tag:slug}', 'TagController@destroy')->name('tags.delete');
});

# Comment
Route::group(['prefix' => 'comments'], function() {
    Route::get('/', 'CommentController@index')->name('comments');
    Route::post('/update/{comment}', 'CommentController@update')->name('comments.update');
    Route::post('/delete/{comment}', 'CommentController@destroy')->name('comments.delete');
});

# Contacts
Route::group(['prefix' => 'contacts'], function() {
    Route::get('/', 'ContactController@index')->name('contacts');
    Route::post('/create', 'ContactController@store')->name('contacts.create');
    Route::get('/update/{contact}', 'ContactController@edit')->name('contacts.update');
    Route::post('/update/{contact}', 'ContactController@update')->name('contacts.update');
    Route::post('/delete/{contact}', 'ContactController@destroy')->name('contacts.delete');
});

# Forms
Route::group(['prefix' => 'forms'], function() {
    Route::get('/', 'FormController@index')->name('forms');
    Route::get('/create', 'FormController@create')->name('forms.create');
    Route::post('/create', 'FormController@store')->name('forms.create');
    Route::get('/update/{form}', 'FormController@edit')->name('forms.update');
    Route::post('/update/{form}', 'FormController@update')->name('forms.update');
    Route::post('/delete/{form}', 'FormController@destroy')->name('forms.delete');
});

# Menus
Route::group(['prefix' => 'menus'], function() {
    Route::get('/', 'MenuController@index')->name('menus');
    Route::get('/create', 'MenuController@create')->name('menus.create');
    Route::post('/create', 'MenuController@store')->name('menus.create');
    Route::get('/update/{menu}', 'MenuController@edit')->name('menus.update');
    Route::post('/update/{menu}', 'MenuController@update')->name('menus.update');
    Route::post('/delete/{menu}', 'MenuController@destroy')->name('menus.delete');
    # Menu Items
    Route::group(['prefix' => 'items'], function() {
        Route::get('/', 'MenuItemController@index')->name('menus.items');
        Route::get('/create', 'MenuItemController@create')->name('menus.items.create');
        Route::post('/create', 'MenuItemController@store')->name('menus.items.create');
        Route::get('/update/{menuitem}', 'MenuItemController@edit')->name('menus.items.update');
        Route::post('/update/{menuitem}', 'MenuItemController@update')->name('menus.items.update');
        Route::post('/delete/{menuitem}', 'MenuItemController@destroy')->name('menus.items.delete');
    });
});

# Settings
Route::group(['prefix' => 'settings'], function() {
    Route::get('/update', 'SettingController@edit')->name('settings.update');
    Route::post('/update', 'SettingController@update')->name('settings.update');
    # Settings Scripts
    Route::group(['prefix' => 'scripts'], function() {
        Route::get('/update', 'SettingController@editScripts')->name('settings.scripts.update');
        Route::post('/update', 'SettingController@updateScripts')->name('settings.scripts.update');
    });
});
