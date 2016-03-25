<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Extensions;
use App\Models\Post;
use App\Models\PostStatus;
use App\Models\PostTransformer;
use App\Models\UrlHelpers;
use DB;
use File;
use Image;
use Log;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function getDashboard() {
        return view('admin.dashboard');
    }
}
