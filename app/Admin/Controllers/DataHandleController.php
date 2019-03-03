<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataCompanyList;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;


class DataHandleController extends Controller
{

    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('手动补全联系方式')
            ->description('列表')
            ->body($this->grid());
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DataCompanyList);
       
        $grid->model()->take(5);

        $grid->name('公司名');
        
        
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->disableFilter();
        $grid->disableExport();

        return $grid;
    }




    public function add_contact()
    {
        $name = 'gongsi';

        return Admin::content(function (Content $content) use ($name) {

            $book = DataCompanyList::where(['name' => $name])->first();

            $articleView = view('admin.data.add_contact', compact('book'))
                ->render();

            $content->row($articleView);

        });

    }

}
