<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/article/{post}/comments', 'CommentController@index')->name('index');
Route::get('/article/{post}/getlikes', 'LikePostController@getLikes');

Route::middleware('auth:api')->group(function () {
    Route::post('/article/{post}/comment', 'CommentController@store');
    Route::post('/article/{post}/comment/{id}/update', 'CommentController@update');
    Route::post('/article/{post}/comment/{id}/delete', 'CommentController@destroy');
    Route::post('/article/{post}/like', 'LikePostController@likePost');
    Route::post('/article/{post}/unLike', 'LikePostController@unLikePost');
});