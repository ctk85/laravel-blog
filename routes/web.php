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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/article/{id}', 'HomeController@showArticle')->name('article');

Route::get('/post-admin', 'PostController@indexAdmin')
	->middleware('admin')
	->name('post.index-admin');

Route::resource('post', 'PostController');

Route::resource('profile', 'ProfileController');
Route::post('/profile/update_avatar/{id}', 'ProfileController@updateAvatar')->name('profile.update_avatar');