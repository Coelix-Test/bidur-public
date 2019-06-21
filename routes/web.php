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

Route::get('/', 'PostController@getMainPage');

Route::get('/admin', function () {
    return view('admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'PostController@getAllPostsWithAllFilters')->name('test');
Route::get('logout', 'Auth\LoginController@logout', function () {
    return view('welcome');
});

Route::get('/postByHashtag/{id}', 'HashtagController@getAllHashtags')->name('postByHashtag');
Route::get('/post/{id}', 'HashtagController@getAllHashtags')->name('postView');

//admin
Route::post('/getRecentPostsWithOffset', 'AdminController@getRecentPosts')->name('get-recent-posts');
Route::post('/getAllHashtags', 'AdminController@getAllHashtags')->name('get-all-hashtags');
