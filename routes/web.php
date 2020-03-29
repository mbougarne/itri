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

Route::group(['prefix' => 'users'], function () {
    Route::get('/register', 'UserController@create')->name('user.signup');
    Route::post('/register', 'UserController@store')->name('user.signup');
    Route::get('/login', 'UserController@getLogin')->name('user.login');
    Route::post('/login', 'UserController@store')->name('user.login');
});

Route::group(['prefix' => 'posts'], function() {
    Route::post('/create', 'PostController@store')->name('post.create');
});
