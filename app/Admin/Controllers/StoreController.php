<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\WaimaiStoreList;
use App\Models\Seller;
use App\Models\School;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class StoreController extends Controller
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
            ->header('订单列表')
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
        $grid = new Grid(new WaimaiStoreList);
       
        $grid->seller_id('店铺ID')->sortable();
        $grid->seller_name('店铺名称')->sortable();
        $grid->seller_id('所属店铺')->display(function($value){
            return Seller::get_seller_name($value);
        })->sortable();
       

        $grid->is_use('状态')->display(function($value){
            return $value ? '休息中' : '<span style="color: green;background: gold;padding: 1px 6px;font-weight: 600;">营业中</span>' ;
        })->sortable();
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->disableFilter();
        return $grid;
    }

}
