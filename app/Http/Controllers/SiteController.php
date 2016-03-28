<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Request;

class SiteController extends Controller
{
    public function getHome() {
        $posts = Post::with('author')->with('category')->take(20)->get();
        return view('pages.page', compact($posts));
    }

    public function getLatestPosts() {
        if (\Request::ajax()) {
            $data = \Input::all();
            return view('partials.' . $data['action']);
        }
    }

    public function getCategoryPage($category) {
        $category = Category::where('name', $category)->first();
        if(!$category) {
            return view('404');
        }

        return view('pages.page')
            ->with('category_id', $category->id);
    }

    public function getSearch(Request $request) {
        $posts = Post::where('title', 'like', '%' . $request->input('s') . '%')->get();

        return view('pages.search-results')->with('posts', $posts);
    }
}
