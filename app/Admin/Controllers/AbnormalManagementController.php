<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\AbnormalAddress;
use App\Models\Seller;
use App\Models\School;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class AbnormalManagementController extends Controller
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
            ->header('经营异常列表')
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
        // $grid = new Grid(new AbnormalAddress);
       
        // $grid->name('异常公司名');
        // $grid->dtime('列入异常时间')->sortable();
        
        // $grid->disableCreateButton();
        // $grid->disableRowSelector();
        // $grid->disableActions();
        // $grid->disableFilter();
        // $grid->disableExport();

        // return $grid;
    }

}
