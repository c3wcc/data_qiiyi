<?php

namespace App\Http\Controllers\Home;

use App\Models\DataCompanyContact;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class IndexController extends ApiController
{

    public function index()
    {

        $data['count'] = DataCompanyContact::count();
    
        return view('welcome', $data);
    }

}
