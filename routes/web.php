<?php


Route::get('/', 'AuthController@index');
Route::get('login', 'AuthController@index');
Route::post('post-login', 'AuthController@postLogin');
Route::get('registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration');
Route::get('dashboard', 'AuthController@blog');
Route::get('blog', 'AuthController@blog');
Route::get('logout', 'AuthController@logout');
Route::get('get_blogs', 'AuthController@get_blogs');
Route::get('create_blog', 'AuthController@create_blog');
Route::post('save_blogs', 'AuthController@save_blogs');
