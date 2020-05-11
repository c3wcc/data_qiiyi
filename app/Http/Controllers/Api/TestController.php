<?php

namespace App\Http\Controllers\Api;

use App\Models\DataCompanyList;
use App\Models\School;

class TestController extends ApiController
{
    /*
      * 处理重复的
     */
    public function index()
    {

        $articles = \DB::select('SELECT `name` FROM `data_company_list` GROUP BY `name` HAVING count(`name`) > 1 limit 10');
        

        foreach($articles as $key => $val){
            dump($val);
            // $lin = DataCompanyList::where(['firm_id'=>$val->firm_id])->get();
            // dump($lin);
            dump($val->name);

        }

        // return $this->success($articles);
    }

}
