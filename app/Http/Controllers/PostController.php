<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostStatus;
use Agent;

class PostController extends Controller
{
    public function getPost($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', PostStatus::Enabled)
            ->first();

        if (empty($post)) {
            return view('errors.404');
        }
		
        $relatedPosts = Post::take(10)->get();
		$post->blocks = unserialize(base64_decode($post->content));
        return view('pages.post')
            ->with('post', $post)
            ->with('relatedPosts', $relatedPosts)
            ->with('mobile', Agent::isMobile() || Agent::isTablet());
    }
}