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
    $user = new \App\User();
    $user->name = 'Luciano Gonzalez';
    $user->email = 'lucianothewriter@gmail.com';
    $user->password = bcrypt('Hondurasrocks1');
    $user->image = 'http://54.200.187.146/user_avatars/gonzalez.jpg';
    $user->type = 0;
    $user->status = 0;
    $user->created_at = \App\Models\DateTimeExtensions::getDate();
    $user->updated_at = \App\Models\DateTimeExtensions::getDate();
    $user->save();

    $user = new \App\User();
    $user->name = 'Harry Tipper';
    $user->email = 'h8darko@outlook.com';
    $user->password = bcrypt('clppng2014');
    $user->image = 'http://54.200.187.146/user_avatars/tipper.jpg';
    $user->type = 0;
    $user->status = 0;
    $user->created_at = \App\Models\DateTimeExtensions::getDate();
    $user->updated_at = \App\Models\DateTimeExtensions::getDate();
    $user->save();

    $user = new \App\User();
    $user->name = 'Ezra Zydan';
    $user->email = 'Zydanixra@gmail.com';
    $user->password = bcrypt('Nishinomiya6');
    $user->image = 'http://54.200.187.146/user_avatars/ezra.jpg';
    $user->type = 0;
    $user->status = 0;
    $user->created_at = \App\Models\DateTimeExtensions::getDate();
    $user->updated_at = \App\Models\DateTimeExtensions::getDate();
    $user->save();

    echo 'done';
});

Route::get('{slug}/{userId?}', 'PostController@getPost');