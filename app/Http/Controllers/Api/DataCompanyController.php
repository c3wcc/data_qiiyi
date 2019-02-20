<?php

namespace App\Http\Controllers\Api;

use App\Models\DataCompany;
use Illuminate\Http\Request;

class DataCompanyController extends ApiController
{

    /**
     * 增加数据
     */
    public function add(Request $request)
    {
        $code = $request->code;
        $dtime = $request->dtime;
        $name = $request->name;

        if(!$code){
            return $this->failed('存储失败，code不能为空');
        }
        if(!$dtime){
            return $this->failed('存储失败，dtime不能为空');
        }
        if(!$name){
            return $this->failed('存储失败，name不能为空');
        }

        $DataCompany = new DataCompany();
        $DataCompany->code = $code;
        $DataCompany->dtime = $dtime;
        $DataCompany->name = $name;
        $DataCompany->save();
        
        $sum = $DataCompany::count();
       
        return $this->success('存储成功，共'.$sum.'条数据');
    }

}
