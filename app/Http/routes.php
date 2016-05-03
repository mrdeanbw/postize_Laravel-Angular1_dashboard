<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'DashboardController@getDashboard');
    Route::get('dashboard/post/list', 'ManagePostController@getPostList');
    Route::post('dashboard/post/delete', 'ManagePostController@postDeletePost');
    Route::post('dashboard/post/uploadimage', 'ManagePostController@postUploadImage');
    Route::get('dashboard/post/{postId?}', 'ManagePostController@getAddEditPost');
    Route::post('dashboard/post/{postId?}', 'ManagePostController@postAddEditPost');
    Route::get('dashboard/user/list', 'ManageUserController@getUserList');
    Route::get('dashboard/user/settings', 'UserController@getSettings');
    Route::post('dashboard/user/settings', 'UserController@postSettings');
    Route::post('dashboard/user/password', 'UserController@postUpdatePassword');
    Route::get('dashboard/user/{userId?}', 'ManageUserController@getAddEditUser');
    Route::post('dashboard/user/{userId?}', 'ManageUserController@postSaveUser');
});

Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'SiteController@getHome');

    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');

    Route::get('password-reset', 'Auth\PasswordController@getEmail');
    Route::post('password-reset', 'Auth\PasswordController@postEmail');

    Route::get('password-set', 'Auth\PasswordController@getReset');
    Route::post('password-set', 'Auth\PasswordController@postReset');

    Route::get('logout', 'Auth\AuthController@getLogout');

    Route::get('search', 'SiteController@getSearch');

    Route::get('terms', function () {
        return view('pages.terms');
    });
    Route::get('privacy', function () {
        return view('pages.privacy');
    });
    Route::get('copyright', function () {
        return view('pages.copyright');
    });
    Route::get('contact', function () {
        return view('pages.contact');
    });
    Route::get('/category/{category}', 'SiteController@getCategoryPage');
});
Route::get('{slug}/{userId?}', 'PostController@getPost');