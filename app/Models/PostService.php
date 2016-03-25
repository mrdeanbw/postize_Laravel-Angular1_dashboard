<?php

namespace App\Models;

use DB;

class PostService
{
    public static function get($category = null, $numberOfPosts = 10) {
        $posts = Post::where('status', PostStatus::Enabled);
        if ($category != null) {
            $posts->where('category', $category);
        }

        return $posts->take($numberOfPosts)
            ->orderBy('id')->get();
    }

    public static function getRandomUrl() {
        $post = head(DB::select(DB::raw('SELECT r1.slug
                                         FROM post AS r1
                                            JOIN (SELECT (RAND() * (SELECT MAX(id)
                                                  FROM post where status = ' . PostStatus::Enabled . ')) as id)
                                            AS r2
                                         WHERE r1.id >= r2.id
                                         AND r1.status = ' . PostStatus::Enabled . '
                                          ORDER BY r1.id ASC LIMIT 1')));

        return url($post->slug);
    }
}