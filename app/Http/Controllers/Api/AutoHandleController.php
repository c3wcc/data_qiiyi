<?php

namespace App\Http\Controllers\Api;

use App\Models\DataCompany;
use App\Models\DataCompanyList;
use App\Models\DataCompanyAbnormalAddress;
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
        $company = DataCompany::first();

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
        $DataCompanyList->name = $company->name;
        $res = $DataCompanyList->save();
        if($res == true){
            //成功
            //增加异常表
            $DataCompanyAbnormalAddress = new DataCompanyAbnormalAddress();
            $DataCompanyAbnormalAddress->code = $company->code;
            $DataCompanyAbnormalAddress->name = $company->name;
            $DataCompanyAbnormalAddress->id = $id;
            $DataCompanyAbnormalAddress->dtime = $this->deal_time($company->dtime);
            $r = $DataCompanyAbnormalAddress->save();

            if($r == true){
                DataCompany::where(['id'=>$company->id])->delete();
            }
        }

        return $this->success($company->id);
    }


    /**
     * 处理时间
     */
    private function deal_time($time){
        return str_replace("T"," ",$time);
    }
}
