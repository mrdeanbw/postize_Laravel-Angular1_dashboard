<?php

Route::group(['middleware' => ['auth.basic']], function () {
    Route::get('dashboard', 'DashboardController@getDashboard');
    Route::get('dashboard/post/list', 'ManagePostController@getPostList');
    Route::post('dashboard/post/delete', 'ManagePostController@postDeletePost');
	Route::post('dashboard/post/uploadimage', 'ManagePostController@postUploadImage');
    Route::get('dashboard/post/{postId?}', 'ManagePostController@getAddEditPost');
    Route::post('dashboard/post/{postId?}', 'ManagePostController@postAddEditPost');
    Route::get('dashboard/user/list', 'ManageUserController@getUserList');
    Route::get('dashboard/user/{email?}', 'ManageUserController@getAddEditUser');
    Route::post('dashboard/user', 'ManageUserController@postSaveUser');
    Route::post('dashboard/user', 'ManageUserController@postSaveUser');
});

Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'SiteController@getHome');

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

Route::get('fsafsdfasdfasdfasdf', function() {
    /*$user = new \App\User();
    $user->name = 'Elliott';
    $user->email = 'Eliottfinch@gmail.com';
    $user->password = bcrypt('');
    $user->image = 'http://54.200.187.146/user_avatars/elliott.jpg';
    $user->type = 0;
    $user->status = 0;
    $user->created_at = \App\Models\DateTimeExtensions::getDate();
    $user->updated_at = \App\Models\DateTimeExtensions::getDate();
    $user->save();*/
});

Route::get('{slug}/{userId?}', 'PostController@getPost');