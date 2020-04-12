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

Route::group(['prefix' => 'dashboard'], function () {

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
        Route::get('/create', 'PostController@create')->name('post.create');
        Route::post('/create', 'PostController@store')->name('post.create');
        Route::get('/update/{post:slug}', 'PostController@edit')->name('post.update');
        Route::post('/update/{post:slug}', 'PostController@update')->name('post.update');
        Route::post('/delete/{post:slug}', 'PostController@destroy')->name('post.delete');
        Route::post('/upload-image', 'PostController@upload')->name('upload.image');
    });

    # Page
    Route::group(['prefix' => 'pages'], function() {
        Route::get('/', 'PageController@index')->name('pages');
        Route::get('/create', 'PageController@create')->name('page.create');
        Route::post('/create', 'PageController@store')->name('page.create');
        Route::get('/update/{page:slug}', 'PageController@edit')->name('page.update');
        Route::post('/update/{page:slug}', 'PageController@update')->name('page.update');
        Route::post('/delete/{page:slug}', 'PageController@destroy')->name('page.delete');
    });

    # Category
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'CategoryController@index')->name('categories');
        Route::get('/create', 'CategoryController@create')->name('category.create');
        Route::post('/create', 'CategoryController@store')->name('category.create');
        Route::get('/update/{category:slug}', 'CategoryController@edit')->name('category.update');
        Route::post('/update/{category:slug}', 'CategoryController@update')->name('category.update');
        Route::post('/delete/{category:slug}', 'CategoryController@destroy')->name('category.delete');
    });

    # Tag
    Route::group(['prefix' => 'tags'], function() {
        Route::get('/', 'TagController@index')->name('tags');
        Route::get('/create', 'TagController@create')->name('tag.create');
        Route::post('/create', 'TagController@store')->name('tag.create');
        Route::get('/update/{tag:slug}', 'TagController@edit')->name('tag.update');
        Route::post('/update/{tag:slug}', 'TagController@update')->name('tag.update');
        Route::post('/delete/{tag:slug}', 'TagController@destroy')->name('tag.delete');
    });

    # Comment
    Route::group(['prefix' => 'comments'], function() {
        Route::get('/', 'CommentController@index')->name('comments');
        Route::post('/update/{comment}', 'CommentController@update')->name('comment.update');
        Route::post('/delete/{comment}', 'CommentController@destroy')->name('comment.delete');
    });

    # Contacts
    Route::group(['prefix' => 'contacts'], function() {
        Route::get('/', 'ContactController@index')->name('contacts');
        Route::post('/create', 'ContactController@store')->name('contact.create');
        Route::get('/update/{contact}', 'ContactController@edit')->name('contact.update');
        Route::post('/update/{contact}', 'ContactController@update')->name('contact.update');
        Route::post('/delete/{contact}', 'ContactController@destroy')->name('contact.delete');
    });

    # Forms
    Route::group(['prefix' => 'forms'], function() {
        Route::get('/', 'FormController@index')->name('forms');
        Route::get('/create', 'FormController@create')->name('form.create');
        Route::post('/create', 'FormController@store')->name('form.create');
        Route::get('/update/{form}', 'FormController@edit')->name('form.update');
        Route::post('/update/{form}', 'FormController@update')->name('form.update');
        Route::post('/delete/{form}', 'FormController@destroy')->name('form.delete');
    });

    # Menus
    Route::group(['prefix' => 'menus'], function() {
        Route::get('/', 'MenuController@index')->name('menus');
        Route::get('/create', 'MenuController@create')->name('menu.create');
        Route::post('/create', 'MenuController@store')->name('menu.create');
        Route::get('/update/{menu}', 'MenuController@edit')->name('menu.update');
        Route::post('/update/{menu}', 'MenuController@update')->name('menu.update');
        Route::post('/delete/{menu}', 'MenuController@destroy')->name('menu.delete');
        # Menu Items
        Route::group(['prefix' => 'items'], function() {
            Route::get('/', 'MenuItemController@index')->name('menu.items');
            Route::get('/create', 'MenuItemController@create')->name('menu.items.create');
            Route::post('/create', 'MenuItemController@store')->name('menu.items.create');
            Route::get('/update/{menuitem}', 'MenuItemController@edit')->name('menu.items.update');
            Route::post('/update/{menuitem}', 'MenuItemController@update')->name('menu.items.update');
            Route::post('/delete/{menuitem}', 'MenuItemController@destroy')->name('menu.items.delete');
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
});

