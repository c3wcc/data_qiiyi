<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Seller;
use App\Models\School;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class OrderController extends Controller
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
        $grid = new Grid(new Order);

        $grid->model()->orderBy('order_id','desc');
        $grid->seller_id('所属店铺')->display(function($value){
            // return Seller::get_seller_name($value);
        })->sortable();
        $grid->order_id('订单ID');
        $grid->order_sn('订单编号')->sortable();
        $grid->pay_price('支付余额');
        // $grid->school('学校')->display(function($value){
        //     return School::get_school_name($value);
        // })->sortable();
        $grid->user_id('用户ID');
        $grid->pay_status('支付状态')->display(function($value){
            return $value ? '<span style="color: green;background: gold;padding: 1px 6px;font-weight: 600;">已支付</span>' : '未支付';
        })->sortable();
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->disableFilter();
        return $grid;
    }

}
