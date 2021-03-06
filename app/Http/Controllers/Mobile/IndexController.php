<?php

namespace App\Http\Controllers\Mobile;

use App\Models\DataCompanyContact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;


class IndexController extends Controller
{

    public function index()
    {

        //获取session里的数据
        $openid = Session::get('openid');
        if(!$openid){
            return redirect("mobile/login");
        }

      
        $data = [];

        return view('mobile/index/index', $data);
    }

}
