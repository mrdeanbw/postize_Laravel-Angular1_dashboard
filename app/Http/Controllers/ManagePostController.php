<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Extensions;
use App\Models\Post;
use App\Models\PostStatus;
use App\Models\PostTransformer;
use App\Models\UrlHelpers;
use Auth;
use DB;
use File;
use Grids;
use Html;
use Image;
use Log;
use Mockery\CountValidator\Exception;
use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\Filters\DateRangePicker;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\RenderFunc;
use Nayjest\Grids\Components\ShowingRecords;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\TotalsRow;
use Nayjest\Grids\DataRow;
use Nayjest\Grids\DbalDataProvider;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\SelectFilterConfig;
use Symfony\Component\HttpFoundation\Request;


class ManagePostController extends Controller
{
    public function getAddEditPost($postId = null) {
        $post = [];
        if (!empty($postId)) {
            $post = Post::where('id', $postId)
                ->orderBy('id', 'desc')
                ->first();

            if (empty($post)) return redirect()->to('dashboard/post')->with('message', 'danger|The requested post does not exist.');
            $post->blocks = unserialize(base64_decode($post->content));
        }

        return view('pages.admin.add-edit-post')
            ->with('post', $post)
            ->with('categories', Category::get());
    }

    public function postUploadImage(Request $request) {
        if ($request->hasFile('imagecontent') && $request->file('imagecontent')->isValid()) {
            Log::info('Payload included "image" parameter, and the image is valid');
            $filename = Extensions::getChars(32) . '.' . $request->file('imagecontent')->getClientOriginalExtension();
            $request->file('imagecontent')->move(
                public_path() . '/assets/front/img/', $filename
            );
        }
        return response()->json(['success' => 'true', 'url' => url('assets/front/img/' . $filename)]);
    }

    /**
     * @param Request $request
     * @param null $postId
     * @return mixed
     */
    public function postAddEditPost(Request $request, $postId = null) {
        if ($postId == null) {
            if (Post::where('slug', str_slug($request->input('title')))->exists()) {
                \Log::info('Slug existed:' . $request->input('title'));

                return redirect()->back()->withInput()->with('message', 'danger|This post has already been created, as it has the same URL as another post.');
            }

            Log::info('Creating new post...');
            $post = new Post();
            $post['status'] = PostStatus::Pending;
            $post['user_id'] = Auth::user()->getAuthIdentifier();
        } else {
            $post = Post::find($postId);
            if ($post->user_id != \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier() && Auth::user()->type == 0) {
                return redirect()->to('dashboard/post/list');
            }
            Log::info('Updating Post ID ' . $post->id . ' - current values are ' . Extensions::varDumpToString($post));

            if ($request->input('status') == PostStatus::Deleted && $post['status'] != PostStatus::Deleted) {
                $post['deleted_at'] = Extensions::getDate();
                Log::info('Deleted Post ID ' . $post->id);
            } else if ($request->input('status') != PostStatus::Deleted && $post['status'] == PostStatus::Deleted) {
                $post['deleted_at'] = null;
                Log::info('Undeleted ' . $post->id);
            }

            $post['status'] = $request->input('status');
        }

        if ($request->ajax() && $request->input('status') == PostStatus::Deleted) {
            $post['status'] = $request->input('status');
            $post['deleted_at'] = Extensions::getDate();
            $post->save();
            return response()->json(['success' => 'true']);
        }


        $post['title'] = $request->input('title');
        $post['slug'] = !empty($post['slug']) ? $post['slug'] : str_slug($post['title']);

        $post['description'] = $request->input('description');
        $post['category_id'] = $request->input('category_id', 1);
        $post->save();

        Log::info('Transforming content...');
        $postTransformer = new PostTransformer();
        $blocks = $request->input('blocks');

        for($i = 0; $i < count($blocks); $i++) {
            // The below method extracts all image URLs from the content that are not on our domain
            // So that we can download them to our own server rather than hotlinking
            $blocks[$i] = $postTransformer->handleContentExternalUrls($blocks[$i], $post->id);
        }

        $post['content'] = base64_encode(serialize($blocks));
        $post->save(); // Saving now to get an ID for naming the images

        $thumbsPath = public_path() . '/' . config('custom.thumbs-directory');
        $folderDates = UrlHelpers::getCurrentFolderDates();
        if (!File::exists($thumbsPath . $folderDates)) {
            File::makeDirectory($thumbsPath . $folderDates, 0755, true);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            Log::info('Payload included "image" parameter, and the image is valid');
            $filename = Extensions::getChars(6) . '_' . $post->id . '.' . $request->file('image')->getClientOriginalExtension();

            $imageData = Image::make($request->file('image'));
            $imageData->resize(758, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imageData->crop(758, 484);
            $imageData->save(public_path() . '/thumbs/' . $filename);

            $post['image'] = UrlHelpers::getThumbnailLink($filename);
            Log::info('Saved the image as ' . $post['image']);
        } else if ($request->has('image_url')) { // && strpos($request->input('image_url'), 'postize.com') === false) {
            Log::info('Payload included "image" parameter, and the image is from an external domain. It needs to be fetched.');
            $post['image'] = $request->input('image_url');

            // TODO: Create original_image_url field and check it, so that we don't have to scrape if its the same
            $filename = UrlHelpers::getCurrentFolderDates() . Extensions::getChars(6) . '_' . $post->id . '.jpg';
            try {
                $imageData = Image::make($request->input('image_url'));
                $imageData->resize(758, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imageData->crop(758, 484);
                $imageData->save(public_path() . '/thumbs/' . $filename);
                $post['image'] = UrlHelpers::getThumbnailLink($filename);
                Log::info('Saved the image as ' . $post['image']);

            } catch (\Exception $e) {
                \Log::info("ManagePostController::postAddEditPost: Unable to scrape image_url: " . $request->input('image_url') .
                    ' , Exception: ' . $e->getMessage());
            }
        }
        $post->save();
        $message = 'success|Post saved successfully.';
        $post->blocks = unserialize(base64_decode($post->content));
        return redirect()->to('dashboard/post/' . $post->id)
            ->with('post', $post)
            ->with('categories', Category::get())
            ->with('message', $message);
    }

    public function getPostList() {
        $posts = Post::join('user as u', 'u.id', '=', 'post.user_id')
            ->join('category as c', 'c.id', '=', 'post.category_id')
            ->orderBy('id', 'desc')
            ->get(['post.*', 'u.name as author_name', 'u.email', 'c.name as category_name']);

        return view('pages.admin.post-list')
            ->with('posts', $posts);
    }
}
