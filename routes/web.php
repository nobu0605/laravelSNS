<?php

use App\Http\Middleware\ProfileMiddleware;

Route::get('/tweet','SNSController@index');
Route::get('/like','SNSController@like');
Route::post('/tweet','SNSController@create')->name('tweet');
Route::post('/comment', 'CommentController@postComment');

Route::get('/edit','SNSController@edit');
Route::post('/edit','SNSController@update');

Route::get('/delete','SNSController@remove');

Auth::routes();	

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('/user_logout','SNSController@user_logout');

Route::get('/post','PostController@index');
Route::post('/like','PostController@postLikePost')->name('like');
Route::get('/mypage','MypageController@index');