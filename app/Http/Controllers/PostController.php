<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostStatus;
use App\Models\UrlHelpers;
use Agent;
use Auth;
use Illuminate\Http\Request;
use View;

class PostController extends Controller
{
    public function getPost(Request $request, $slug, $pageNumber = 1)
    {
        $preview = $request->get('__preview') == 1;
        $post = Post::where('slug', $slug)->with('category');

        if(!$preview || !Auth::check()) {
            $post->whereStatus(PostStatus::Enabled);
        }

        $post = $post->first();

        if (empty($post)) {
            \App::abort(404);
        }

        View::share('current_category', strtolower($post->category->name));

        $relatedPosts = Post::where('id', '!=', $post->id)->whereStatus(PostStatus::Enabled)->take(3)->get();
		$blockContent = unserialize(base64_decode($post->blockcontent));

        $numberOfPagesInArticle = 1;
        $pages = [];
        $currentPageContent = [];
        for($i = 0; $i < count($blockContent); $i++) {
            if ($blockContent[$i]->type == 'pagebreak') {
                $pages[] = $currentPageContent;
                $currentPageContent = [];
            } else {
                if ($blockContent[$i]->type == 'image') {
                    $blockContent[$i]->content = '';

                    if(!empty($blockContent[$i]->title))
                        $blockContent[$i]->content .= '<h2>' . $blockContent[$i]->title . '</h2>';

                    if(!empty($blockContent[$i]->description))
                        $blockContent[$i]->content .= '<p>' . $blockContent[$i]->description . '</p>';

                    $blockContent[$i]->content .= '<img src="' . $blockContent[$i]->url . '" />';

                    if(!empty($blockContent[$i]->source) && !empty($blockContent[$i]->sourceurl)) {
                        $blockContent[$i]->content .= '<span class="source"><span>via:</span><a href="' .
                        $blockContent[$i]->sourceurl . '" target="blank">' . $blockContent[$i]->source . '</a></span>';
                    }
                }

                $currentPageContent[] = $blockContent[$i];
            }

            if($i == count($blockContent) - 1) {
                $pages[] = $currentPageContent;
                $currentPageContent = [];
            }
        }

        if ($pageNumber == 0) $pageNumber = 1;
        if ($pageNumber > count($pages))
            return redirect()->to('/');

        $post->blocks = $pages[$pageNumber - 1];
        $post->is_last_page = count($pages) == $pageNumber;

        $nextPageUrl = url($slug) . '/' . ($pageNumber + 1);
        $urlParts = parse_url($request->fullUrl());
        if(!empty($urlParts['query'])) {
            $nextPageUrl .= '?' . $urlParts['query'];
        }

        return view('pages.post')
            ->with('post', $post)
            ->with('pageNumber', $pageNumber)
            ->with('nextPageUrl', $nextPageUrl)
            ->with('relatedPosts', $relatedPosts)
            ->with('preview', $preview)
            ->with('mobile', Agent::isMobile() || Agent::isTablet());
    }
}