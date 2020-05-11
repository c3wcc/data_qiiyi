<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class UserController extends Controller
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
            ->header('用户列表')
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
        $grid = new Grid(new User);

        $grid->id('用户ID');
        $grid->nickname('昵称')->sortable();
        $grid->avatar('头像')->image(35, 35);
        $grid->phone('手机');
        $grid->school('学校');
        $grid->created_at('注册时间');
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->disableFilter();
        return $grid;
    }

}
