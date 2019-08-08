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
Route::get('/test2', 'AdminController@addAllRandoms');
//Route::post('/test/{id}', 'MainController@getRecentPosts')->name('test');



//user routes
Route::get('/', function () {
  readfile('../resources/views/app.html');
});
Route::post('/getRecentPosts', 'MainController@getRecentPosts')->name('get-recent-posts');

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
Route::post('/share/{share_string}', 'MainController@getPostBlade');
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
Route::post('/getServiceForMainPageSecond',   'MainController@getServiceForMainPageSecond');

Route::post('/sendMail',   'MainController@sendMail');


//favourite

Route::post('/addPostToFavourite', 'MainController@addPostToFavourite');
Route::post('/deletePostFromFavourites', 'MainController@deletePostFromFavourites');
Route::post('/getAllFavourites', 'MainController@getAllFavourites');

//changePersonalInfo
Route::post('/getPersonalInfo', 'MainController@getPersonalInfo');
Route::post('/checkPassword', 'MainController@checkPassword');
Route::post('/changePassword', 'MainController@changePassword');
Route::post('/changePersonalInfo', 'MainController@changePersonalInfo');

Route::post('/getMainPageOptimized',   'MainController@getMainPageOptimized');

//admin
Route::get('/admin', 'AdminController@showAdmin')->middleware('admin');
Route::post('/getUserData', 'AdminController@getUserData');
    //posts
    Route::post('/createPost', 'AdminController@createFullPost')->name('create-post')->middleware('admin');
    Route::post('/getAllPostsWithOffset', 'AdminController@getAllPosts')->name('get-all-posts');

    Route::post('/showEditablePostContent', 'AdminController@showEditablePostContent');
    Route::post('/editPostCreateAllSections', 'AdminController@editPostCreateAllSections');
    //services
    Route::post('/createHappyBirthday', 'AdminController@addHappyBirthday')->name('add-happy-birthday')->middleware('admin'); //true
    Route::post('/createNewComparison', 'AdminController@addNewComparison')->name('add-comparison')->middleware('admin');
    Route::post('/createSinglePhoto', 'AdminController@addSinglePhoto')->name('add-single-photo')->middleware('admin');
    Route::post('/addNewSurveyToMain', 'AdminController@addNewSurveyToMain')->middleware('admin');
    Route::post('/addNewComparisonSecond', 'AdminController@addNewComparisonSecond')->middleware('admin');
    Route::post('/addSinglePhotoSecond', 'AdminController@addSinglePhotoSecond')->middleware('admin');
    Route::post('/addNewSurveyToMainSecond', 'AdminController@addNewSurveyToMainSecond')->middleware('admin');
    Route::post('/createInsta', 'AdminController@createInsta')->name('add-insta')->middleware('admin');

    Route::post('/showSinglePhotoFromMain', 'AdminController@showSinglePhotoFromMain');
    Route::post('/showCompareFromMain', 'AdminController@showCompareFromMain');
    Route::post('/showSurveyOnMain', 'AdminController@showSurveyOnMain');
    Route::post('/showSinglePhotoFromMainSecond', 'AdminController@showSinglePhotoFromMainSecond');
    Route::post('/showCompareFromMainSecond', 'AdminController@showCompareFromMainSecond');
    Route::post('/showSurveyOnMainSecond', 'AdminController@showSurveyOnMainSecond');


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
    Route::post('/deleteMail', 'AdminController@deleteMail');

    Route::post('/editMainPagePosts', 'AdminController@editMainPagePosts');

    Route::post('/postTitleSerach', 'AdminController@postTitleSerach');
    Route::post('/userSearch', 'AdminController@userSearch');
    Route::post('/tagNameSearch', 'AdminController@tagNameSearch');

    Route::post('/getAllPostsPaginated', 'AdminController@getAllPostsPaginated');
    Route::post('/toggleHappyBirthday', 'AdminController@toggleHappyBirthday');

// getAllHashtags, getRecentPosts, getAllPostsByHashtag, getSelectedPosts, createPost, editPostCreateAllSections
