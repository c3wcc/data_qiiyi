<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class InfoController extends ApiController
{

    public function index()
    {

        $url = 'https://data.qiiyi.com/api/data/getname';
        $res = $this->httpRequest($url);

        $data = json_decode($res,true);

        $name = $data['data']['name'];
    
        return view('home.info.index', $data['data']);
    }


    public function add(Request $request){
        $firm_id = $request->firm_id;
        $mobile = $request->mobile;


        $url = "https://data.qiiyi.com/api/data/savemobile?id=".$firm_id."&mobile=".$mobile;
        $res = $this->httpRequest($url);
        

        return redirect("home/info");

    }

}
