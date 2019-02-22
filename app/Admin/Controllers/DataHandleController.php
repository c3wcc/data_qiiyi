<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ExcelExpoter;
use App\Http\Controllers\Controller;
use App\Models\DataCompanyList;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class DataHandleController extends Controller
{


    
    public function add_contact()
    {
        $name = 'gongsi';

        return Admin::content(function (Content $content) use ($name) {


            $book = DataCompanyList::where(['name'=>$name])->first();

            $articleView = view('admin.data.add_contact',compact('book'))
                ->render();

            $content->row($articleView);

        });


    }

    
}
