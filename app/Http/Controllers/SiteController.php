<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use App\Models\Post;
use App\Models\PostStatus;
use App\Models\PostService;
use App\Models\AdProvider;
use App\Models\AdSets;

class SiteController extends Controller
{
    public function getHome() {
        $posts = Post::with('author')->take(20)->get();
        return view('pages.page', compact($posts));
    }

    public function getLatestPosts() {

    if(\Request::ajax()) {

        $data = \Input::all();

        return view('partials.' . $data['action']);
    }
    
        $posts = Post::where('status', PostStatus::Enabled)->take(config('custom.latest-posts-chunk-count'))->get();
        return view('recent-posts')->with('posts', $posts);
    }

    public function getCategoryVideos() {
        $posts = Post::where('status', PostStatus::Enabled)->take(config('custom.latest-posts-chunk-count'))->get();
        return view('category-videos')->with('posts', $posts);
    }

    public function getCategoryPage($category) {
        $ads = new AdProvider(AdSets::primary());

        return view('category')
            ->with('posts', PostService::get(null, 25))
            ->with('category', $category)
            ->with('ads', $ads);
    }

    public function getSearch(Request $request) {
        $posts = Post::where('title', 'like', '%'.$request->input('search').'%')->get();
        $ads = new AdProvider(AdSets::primary());

        return view('search-results')->with('posts', $posts)
            ->with('ads', $ads);
    }
}
