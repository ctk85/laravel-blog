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

Route::get('/auth/activationlinkform', 'Auth\RegisterController@showActivationLinkForm');
Route::post('/auth/sendactivationlink', 'Auth\RegisterController@sendActivationLink')->name('auth.sendactivationlink');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/article/{id}', 'HomeController@showArticle')->name('article');

Route::get('/blog', 'HomeController@index')->name('home');

Route::get('blog/{slug}', 'BlogController@getArticle')
	->name('blog.article')
	->where('slug', '[\w\d\-\_]+');

Route::get('/post-admin', 'PostController@indexAdmin')
	->middleware('admin')
	->name('post.index-admin');

Route::resource('post', 'PostController');
Route::resource('category', 'CategoryController');
Route::resource('tag', 'TagController');

Route::resource('profile', 'ProfileController');
Route::post('/profile/update_avatar/{id}', 'ProfileController@updateAvatar')->name('profile.update_avatar');

//Social Auth
Route::get('/auth/{provider}/redirect', 'SocialAuthController@redirect');
Route::get('/auth/{provider}/callback', 'SocialAuthController@callback');

//Activate Account
Route::get('/verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');