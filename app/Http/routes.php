<?php
use Input;
use Request;
use View;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	View::share('page', 'page');
    return view('pages.page');
});

Route::get('/post', function () {
	View::share('page', 'post');
    return view('pages.post');
});

Route::get('/landing', function () {
	View::share('page', 'landing');
    return view('pages.landing');
});

Route::post('/more-posts', function () {

	if(Request::ajax()) {

		$data = Input::all();

		return view('partials.' . $data['action']);
	}
});
