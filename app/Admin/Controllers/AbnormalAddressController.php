<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\DataCompanyAbnormalAddress;
use App\Models\Seller;
use App\Models\School;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use App\Services\NumberService;

class AbnormalAddressController extends Controller
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
            ->header('地址异常列表')
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
        $grid = new Grid(new DataCompanyAbnormalAddress);
       
        $grid->model()->orderby('dtime','desc');

        $grid->name('异常公司名');

        $grid->column('号码')->display(function () {
            return NumberService::get_number($this->firm_id,$this->name);
        });
        
        $grid->dtime('列入异常时间')->sortable();
        
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->disableFilter();
        $grid->disableExport();

        return $grid;
    }

}
