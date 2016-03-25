<?php

//Route::group(['middleware' => ['auth.basic']], function () {
    Route::get('dashboard', 'DashboardController@getDashboard');
    Route::get('dashboard/post/list', 'ManagePostController@getPostList');
    Route::post('dashboard/post/delete', 'ManagePostController@postDeletePost');
    Route::get('dashboard/post/{postId?}', 'ManagePostController@getAddEditPost');
    Route::post('dashboard/post/{postId?}', 'ManagePostController@postAddEditPost');
    Route::get('dashboard/user/list', 'ManageUserController@getUserList');
    Route::get('dashboard/user/{email?}', 'ManageUserController@getAddEditUser');
    Route::post('dashboard/user', 'ManageUserController@postSaveUser');
    Route::post('dashboard/user', 'ManageUserController@postSaveUser');
//});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'SiteController@getHome');

    Route::post('search', 'SiteController@postSearch');

    Route::get('terms', function () {
        return view('terms');
    });
    Route::get('privacy', function () {
        return view('privacy');
    });
    Route::get('copyright', function () {
        return view('copyright');
    });
    Route::get('contact-us', function () {
        return view('contact');
    });
    Route::get('/category/{category}', 'SiteController@getCategoryPage');

    Route::get('setup', 'SetupController@runSetup');
    Route::get('work', 'PostController@getWork');

    // TESTING
    Route::get('b42348nc89n25534-64b5-n856b-6vc-5x34z-32/{search?}', function ($search = null) {
        $posts = DB::table('post')
            ->where('status', \App\Models\PostStatus::Enabled);

        if (!empty($search)) {
            $posts->where('title', 'like', '%' . $search . '%');
        }

        $posts = $posts->get();
        foreach ($posts as $post) {
            echo url($post->slug) . "<br />";
        }
    });
});

Route::get('dashboard/trending-videos', 'AdminTrendingVideosController@getTrendingVideos');
Route::post('dashboard/trending-videos', 'AdminTrendingVideosController@postTrendingVideos');

// This route is for the category videos in the rigth sidebar AJAX call
Route::post('/category-videos', 'SiteController@getCategoryVideos');

// This route is for load more posts AJAX call
Route::post('/more-posts', 'SiteController@getLatestPosts');

// This route is for load more recent posts in homepage AJAX call
Route::post('/recent-posts', 'SiteController@getLatestPosts');

Route::get('{slug}/{userId?}', 'PostController@getPost');

/*Route::get('/', function () {
	\View::share('page', 'page');
    return view('pages.page');
});

Route::get('/post', function () {
	\View::share('page', 'post');
    return view('pages.post');
});

Route::get('/landing', function () {
	\View::share('page', 'landing');
    return view('pages.landing');
});

Route::post('/more-posts', function () {

	if(\Request::ajax()) {

		$data = \Input::all();

		return view('partials.' . $data['action']);
	}
});
*/