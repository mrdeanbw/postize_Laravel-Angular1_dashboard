<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\User;
use App\Models\UserType;
use DB;
use File;
use LaravelAnalytics;
use DateTime;
use Image;
use Log;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function getDashboard(Request $request) {
        $options = ['dimensions' => 'ga:pagePath', 'sort' => '-ga:pageviews', 'max-results' => '10000'];
        $analyticsData = LaravelAnalytics::performQuery(new DateTime('first day of this month'), new DateTime('tomorrow'),
            'ga:sessions,ga:pageviews,ga:pageviewsPerSession,ga:bounceRate,ga:avgSessionDuration', $options);

        $users = User::where('type', UserType::Normal)->get();
        $firstDayOfLastMonth = (new DateTime('first day of this month'))->format('Y-m-d');
        foreach($users as $user) {
            $posts = Post::where('user_id', $user->id)->where('created_at', '>=', $firstDayOfLastMonth)->get();

            foreach($posts as $post) {
                $hasAnalytics = false;
                foreach($analyticsData->rows as $row) {
                    if(substr($row[0], 1) == $post->slug) {
                        $post->analytics = $row;
                        $hasAnalytics = true;
                        break;
                    }
                }

                if(!$hasAnalytics) {
                    $post->analytics = [null, 0];
                }
            }

            $posts = $posts->filter(function() { return true; })->toArray();
            // sort descending by sessions
            usort($posts, function($a, $b) {
                if ($a['analytics'][1] == $b['analytics'][1]) {
                    return 0;
                }
                return ($a['analytics'][1] < $b['analytics'][1]) ? 1 : -1;
            });

            $user->posts = $posts;
        }

        return view('pages.admin.dashboard')
            ->with('users', $users);
    }
}
