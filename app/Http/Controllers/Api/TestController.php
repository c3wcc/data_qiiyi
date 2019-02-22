<?php

namespace App\Http\Controllers\Api;

use App\Models\School;

class TestController extends ApiController
{
    public function index()
    {

        $articles = \DB::select('SELECT `name` FROM `data_company_list` GROUP BY `name` HAVING count(`name`) > 1 ');
        

        return $this->success($articles);
    }

}
