<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use App\Models\Seller;
use App\Models\School;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class FoodCategoryController extends Controller
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
            ->header('商品分类列表')
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
        $grid = new Grid(new FoodCategory);
       
        $grid->menu_id('分类ID')->sortable();
        $grid->menu_name('分类名称')->sortable();
        $grid->seller_id('所属店铺')->display(function($value){
            return Seller::get_seller_name($value);
        })->sortable();
      
        $grid->sort('排序');

        $grid->is_use('状态')->display(function($value){
            return $value ? '<span style="color: green;background: gold;padding: 1px 6px;font-weight: 600;">启用中</span>' : '不启用' ;
        })->sortable();
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->disableFilter();
        return $grid;
    }

}
