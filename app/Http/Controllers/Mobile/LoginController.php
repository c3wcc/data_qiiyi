<?php

namespace App\Http\Controllers\Mobile;

use App\Models\DataCompanyContact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;


class LoginController extends Controller
{


    /**
     * 登录页
     */
    public function index()
    {

        // Session::put('key3','value3');

        // $k = Session::get('key3');
        //  echo $k;
 
        //  dd($openid);
 
 
        


        $data = [];

        return view('mobile/login/index', $data);
    }

}
