<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostStatus;
use Agent;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPost($slug, Request $request)
    {
        $preview = $request->get('__preview') == 1;
        $post = Post::where('slug', $slug);

        if(!$preview || !Auth::check()) {
            $post->whereStatus(PostStatus::Enabled);
        }

        $post = $post->first();

        if (empty($post)) {
            return view('errors.404');
        }

        $relatedPosts = Post::where('id', '!=', $post->id)->whereStatus(PostStatus::Enabled)->take(10)->get();
		$post->blocks = unserialize(base64_decode($post->content));

        return view('pages.post')
            ->with('post', $post)
            ->with('relatedPosts', $relatedPosts)
            ->with('preview', $preview)
            ->with('mobile', Agent::isMobile() || Agent::isTablet());
    }
}