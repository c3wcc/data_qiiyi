<?php

namespace App\Http\Controllers\Api;

use App\Models\DataCompany;
use App\Models\DataCompanyList;
use Illuminate\Http\Request;

/**
 * 自动处理
 */
class AutoHandleController extends ApiController
{

    /**
     * 增加数据
     */
    public function add_list(Request $request)
    {
        $data = DataCompany::limit(10)->get();

        $id = $this->create_code();

        $exit = DataCompany::where(['id'=>$id])->first();

        if($exit){
            $id = $this->create_code();
            $exit = DataCompany::where(['id'=>$id])->first();
            if($exit){
                $id = $this->create_code();
                $exit = DataCompany::where(['id'=>$id])->first();
                if($exit){
                    $id = $this->create_code();
                }
            }
        }
        //保证不重复
        $id = 'firm_'.$id;

        $DataCompanyList = new DataCompanyList();

        $DataCompanyList->id = $id;

        

        return $this->success($id);
    }

}
