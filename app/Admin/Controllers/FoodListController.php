<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\FoodList;
use App\Models\Seller;
use App\Models\School;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class FoodListController extends Controller
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
            ->header('菜品列表')
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
        $grid = new Grid(new FoodList);
       
        $grid->goods_id('商品ID')->sortable();
        $grid->goods_name('分类名称')->sortable();
        $grid->seller_id('所属店铺')->display(function($value){
            return Seller::get_seller_name($value);
        })->sortable();
        $grid->pic_url('照片')->image(50, 50);
      
        $grid->price('售价');
        $grid->packing_fee('包装费');
        $grid->sales('销量');
        $grid->stock('库存');

        $grid->is_on_sale('状态')->display(function($value){
            return $value ? '<span style="color: green;background: gold;padding: 1px 6px;font-weight: 600;">上架</span>' : '下架' ;
        })->sortable();
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->disableFilter();
        return $grid;
    }

}
