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
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpFoundation\Request;
use Auth;

use Grids;
use Html;
use Illuminate\Support\Facades\Config;
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
use Illuminate\Database\Eloquent\Builder;


class ManagePostController extends Controller
{
    public function getAddEditPost($postId = null)
    {
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
	
	public function postUploadImage(Request $request)
    {
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
    public function postAddEditPost(Request $request, $postId = null)
    {
        \Auth::loginUsingId(1);
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
            if ($post->user_id != \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier()) {
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
		$post['content'] = base64_encode(serialize($request->input('blocks')));
		
        //$post['content'] = $request->input('encoded') == 'true' ? base64_decode($request->input('content')) : $request->input('content');
        //$post['content'] = $postTransformer->handleExtraneousData($post['content']);
        //$post['content'] = $postTransformer->handleContentImageData($post['content'], $post->id);
        //$post['content'] = $postTransformer->handleContentExternalUrls($post['content'], $post->id);
        //Log::info('Finished transforming content...');
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
                Image::make($request->input('image_url'))->save(public_path() . '/' . config('custom.thumbs-directory') . $filename);
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
        return view('pages.admin.add-edit-post')
            ->with('post', $post)
            ->with('categories', Category::get())
            ->with('message', $message);
    }

    public function postDeletePost(Request $request)
    {
        $response = "Success";
        try {
            $postId = $request->input('postId');
            Post::where('id', $postId)->delete();
            Log::info("ManagePostController::postDeletePost:" . $postId . ": Deleted by user:" . Auth::user()->email);
        } catch (Exception $ex) {
            Log::Error("ManagePostController::postDeletePost:" . $postId . ": Error in Deleting :" . $ex . "by user:" . Auth::user()->email);
            $response = $ex;
        }
        return $response;
    }

    public function getPostList()
    {

        $query = Post::join('user as u', 'u.id', '=', 'post.user_id')
            ->whereNull('post.deleted_at')
            ->orderBy('id', 'desc')
            ->select(['post.*', 'u.email']);

        $grid = $this->getGrid($query);
        return view('admin.post-list')
            ->with('grid', $grid);
    }

    public function postToPublishBuddy(Request $request, $post)
    {
        $data = [
            'urls' => url($post->slug),
            'category' => $post->category,
        ];

        try {
            // \Httpful\Request::post('http://publishers.yotoh.com/g03fm248-9f-c5m--tx-8-2mzr6qh4---248t3c8n5a2-v4-9-8-8-6-y-53c2t54r-4nakx3yz----3x59w--8')
            $result = \Httpful\Request::post('http://publishers.yotoh.com/g03fm248-9f-c5m--tx-8-2mzr6qh4---248t3c8n5a2-v4-9-8-8-6-y-53c2t54r-4nakx3yz----3x59w--8')
                ->sendsJson()
                ->body($data)
                ->send();

            return $result->body == "true";

        } catch (Exception $e) {
            Log::error($e);

            ob_end_flush();
            echo "Processed  " . $post->external_id . ' with error: ' . $e->getMessage() . "<br />";
            ob_start();
            return;
        }
    }

    private function getGrid($query)
    {
        $grid = new Grid(
            (new GridConfig)
                ->setDataProvider(
                    new EloquentDataProvider($query)
                )
                ->setName('post_list')
                ->setPageSize(50)
                ->setColumns([

                    (new FieldConfig)
                        ->setName('id')
                        ->setLabel('Id')
                        ->setSortable(true)
                        ->setSorting(Grid::SORT_DESC)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE))
                    ,
                    (new FieldConfig)
                        ->setName('image')
                        ->setLabel('Image')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE))
                        ->setCallback(function ($val) {
                            return '<div class ="div-image-container">  <img class = "img-post" src="' . $val . '"> </div>';
                        })

                    ,
                    (new FieldConfig)
                        ->setName('title')
                        ->setLabel('Title')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE))
                    ,

                    (new FieldConfig)
                        ->setName('description')
                        ->setLabel('Description')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE))
                    ,

                    (new FieldConfig)
                        ->setName('email')
                        ->setLabel('Created By')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE))
                    ,

                    (new FieldConfig)
                        ->setName('created_at')
                        ->setLabel('Created At')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE))
                    ,

                    (new FieldConfig)
                        ->setName('edit-post')
                        ->setLabel('Edit')
                        ->setCallback(function ($val, DataRow $row) {
                            $postId = $row->getCellValue("id");
                            return '<a href="' . $postId . '" target="_blank" class = "btn btn-primary">Edit<a/>';
                        })

                    ,
                    (new FieldConfig)
                        ->setName('delete-post')
                        ->setLabel('Delete')
                        ->setCallback(function ($val, DataRow $row) {
                            $postId = $row->getCellValue("id");
                            return '<button class="delete-post btn btn-danger" data-post-id="' . $postId . '">Delete</button>';

                        })

                ])
                ->setComponents([
                    (new THead)
                        ->setComponents([

                            (new OneCellRow)
                                ->setRenderSection(RenderableRegistry::SECTION_END)
                                ->setComponents([
                                    new RecordsPerPage,
                                    new ColumnsHider,
                                    (new CsvExport)
                                        ->setFileName('my_report' . date('Y-m-d'))
                                    ,
                                    new ExcelExport(),
                                    (new HtmlTag)
                                        ->setContent('<span class="glyphicon glyphicon-refresh"></span> Filter')
                                        ->setTagName('button')
                                        ->setRenderSection(RenderableRegistry::SECTION_END)
                                        ->setAttributes([
                                            'class' => 'btn btn-success btn-sm'
                                        ])
                                ]),
                            (new ColumnHeadersRow),
                            (new FiltersRow),

                        ])
                    ,
                    (new TFoot)
                        ->setComponents([

                            (new OneCellRow)
                                ->setComponents([
                                    new Pager,
                                    (new HtmlTag)
                                        ->setAttributes(['class' => 'pull-right'])
                                        ->addComponent(new ShowingRecords)
                                    ,
                                ])
                        ])
                    ,
                ])
        );
        $grid = $grid->render();
        return $grid;

    }

}
