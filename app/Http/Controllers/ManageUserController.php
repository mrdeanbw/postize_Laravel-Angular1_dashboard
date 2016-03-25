<?php

namespace App\Http\Controllers;

use App\User;
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


class ManageUserController extends Controller
{
    public function getAddEditUser($email = null)
    {
        $user = User::where('email', $email)->first();
        if ($user == null)
            $user = new User();
        return view('admin.add-edit-user', compact('user'));
    }


    public function postSaveUser(Request $request)
    {


        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->type = $request->input('type');
        $oldEmail = $request->input('oldEmail');
        User::updateOrCreate(['email' => $oldEmail], ['email' => $user->email, 'password' => $user->password, 'type' => $user->type]);
        return view('admin.add-edit-user', compact('user'))
            ->with('message', 'success|User updated successfully');
    }

    public function getUserList()
    {
        $grid = new Grid(
            (new GridConfig)
                ->setDataProvider(
                    new EloquentDataProvider(User::query())
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
                        ->setName('email')
                        ->setLabel('Email')
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE))
                    ,

                    (new FieldConfig)
                        ->setName('type')
                        ->setLabel('Type')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                            switch ($val) {
                                case 1:
                                    return "Admin";
                                case 2:
                                    return "Normal";
                                default:
                                    return "";
                            }

                        })
                        ->addFilter(

                            (new SelectFilterConfig)
                                ->setName('type')
                                ->setOptions([1 => 'Admin', 2 => 'Normal'])
                        )
                    ,

                    (new FieldConfig)
                        ->setName('edit-post')
                        ->setLabel('Edit')
                        ->setCallback(function ($val, DataRow $row) {
                            $email = $row->getCellValue("email");
                            return '<a href="' . $email . '" target="_blank" class = "btn btn-primary">Edit<a/>';
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

        return view('admin.user-list')
            ->with('grid', $grid);


    }
}


