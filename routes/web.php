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

//testing routes
Route::get('/test', function (){
    return view('test');
});
Route::get('/test2', 'MainController@getRecentPosts');
Route::post('/test/{id}', 'MainController@getRecentPosts')->name('test');



//user routes
Route::get('/', 'PostController@getMainPage');


Auth::routes();

Route::post('/getTwoRandomPosts', 'PostController@getTwoRandomPosts');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', 'Auth\LoginController@logout', function () {
    return view('welcome');
});

Route::get('/postByHashtag/{id}', 'HashtagController@getAllHashtags')->name('postByHashtag');
Route::get('/post/{id}', 'HashtagController@getAllHashtags')->name('postView');


//main page
Route::post('/getMainBday', 'AdminController@getMainBday')->name('get-main-birthday'); //bday
Route::post('/getMainAdditionalSection', 'AdminController@getMainAdditionalSection')->name('get-main-additional-section'); //survey
Route::post('/getMainInsta', 'InstaController@show')->name('get-main-instagram'); //insta

Route::post('/getInfoOnPostForMain', 'MainController@getInfoOnPostForMain'); //1
Route::post('/getAllPosts', 'MainController@getAllPostsWithAllFilters'); //2
Route::post('/post/{id}', 'MainController@showSinglePost')->name('get-post-contents'); //3
Route::post('/getAllPostsByHashtag', 'MainController@getAllPostsByHashtag')->name('get-posts-by-hashtag');
Route::post('/getAllRelevantPosts', 'MainController@getAllRelevantPosts');
Route::post('/getSelectedPosts', 'MainController@getSelectedPosts');

Route::post('/getReaction', 'MainController@getEmojiReaction');
Route::post('/addReaction', 'MainController@addEmojiReaction');

Route::post('/addSurveyVote', 'MainController@addSurveyVote');
    //->middleware('auth'); // пример ауса


Route::post('/likeSinglePhoto',         'MainController@likeSinglePhoto');
Route::post('/dislikeSinglePhoto',      'MainController@dislikeSinglePhoto');
Route::post('/likeForSelectOne',        'MainController@likeForSelectOne');
Route::post('/getServiceForMainPage',   'MainController@getServiceForMainPage');

Route::post('/sendMail',   'MainController@sendMail');



//admin
Route::get('/admin', 'AdminController@showAdmin')->middleware('admin');

    //posts
    Route::post('/createPost', 'AdminController@createFullPost')->name('create-post');
    Route::post('/getAllPostsWithOffset', 'AdminController@getAllPosts')->name('get-all-posts');

    //services
    Route::post('/createHappyBirthday', 'AdminController@addHappyBirthday')->name('add-happy-birthday'); //true
    Route::post('/createNewComparison', 'AdminController@addNewComparison')->name('add-comparison');
    Route::post('/createSinglePhoto', 'AdminController@addSinglePhoto')->name('add-single-photo');
    Route::post('/addNewComparisonSecond', 'AdminController@addNewComparisonSecond');
    Route::post('/addSinglePhotoSecond', 'AdminController@addSinglePhotoSecond');
    Route::post('/createInsta', 'AdminController@createInsta')->name('add-insta');

    Route::post('/showSinglePhotoFromMain', 'AdminController@showSinglePhotoFromMain');
    Route::post('/showCompareFromMain', 'AdminController@showCompareFromMain');
    Route::post('/showSinglePhotoFromMainSecond', 'AdminController@showSinglePhotoFromMainSecond');
    Route::post('/showCompareFromMainSecond', 'AdminController@showCompareFromMainSecond');
    //hashtags
    Route::post('/getAllHashtags', 'AdminController@getAllHashtags')->name('get-all-hashtags');
    Route::post('/addHashtag', 'AdminController@addHashtag')->name('add-hashtag');
    Route::post('/updateHashtag', 'AdminController@updateHashtag')->name('update-hashtag');
    Route::post('/deleteHashtag', 'AdminController@deleteHashtag')->name('delete-hashtag');

    //surveys
    Route::post('/getAllSurveys', 'AdminController@getAllSurveys')->name('get-all-surveys');
    Route::post('/editSurvey', 'AdminController@editSurvey');
    Route::post('/editSurveyEditImage', 'AdminController@editSurveyEditImage');

    //all admins page
    Route::post('/showAllAdmins', 'AdminController@showAllAdmins')->name('show-all-admins');
    Route::post('/editAdmin', 'AdminController@editAdmin')->name('edit-admin');
    Route::post('/deleteAdmin', 'AdminController@deleteAdmin')->name('delete-admin');
    Route::post('/makeUserAdmin', 'AdminController@makeUserAdmin')->name('make-user-admin');

    Route::post('/getAllPostTitles', 'AdminController@getAllPostTitles');
    Route::post('/deletePost', 'AdminController@deletePost');

    Route::post('/getAllMails', 'AdminController@getAllMails');

    Route::post('/editMainPagePosts', 'AdminController@editMainPagePosts');


Route::post('/getRecentPosts', 'MainController@getRecentPosts')->name('get-recent-posts');
