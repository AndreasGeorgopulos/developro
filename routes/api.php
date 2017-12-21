<?php

// User actions
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

// Blog posts and comments
Route::get('blog/posts', 'Api\Blog\PostController@index');
Route::get('blog/posts/{post}', 'Api\Blog\PostController@show');
Route::get('blog/posts/{post}/comments', 'Api\Blog\CommentController@index');

Route::group(['middleware' => 'auth:api'], function () {
    // Blog posts and comments
    Route::post('blog/posts', 'Api\Blog\PostController@create');
    Route::put('blog/posts/{post}', 'Api\Blog\PostController@update');
    Route::delete('blog/posts/{post}', 'Api\Blog\PostController@delete');
    Route::post('blog/posts/{post}/comments', 'Api\Blog\CommentController@create');
    Route::delete('blog/posts/{post}/comments/{comment}', 'Api\Blog\CommentController@delete');
    
    // Logout
    Route::get('logout', 'Auth\LoginController@logout');
});
