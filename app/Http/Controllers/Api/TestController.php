<?php

namespace App\Http\Controllers\Api;

use App\Models\School;

class TestController extends ApiController
{

    public function index()
    {

        $school = new School();
        $test = $school->first();

        return $this->success($test);
    }

}
