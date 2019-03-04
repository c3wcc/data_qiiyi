<?php

namespace App\Http\Controllers\Api;

use App\Models\DataCompany;
use App\Models\DataCompanyList;
use App\Models\DataCompanyContact;
use App\Models\DataCompanyAbnormalAddress;
use Illuminate\Http\Request;

class OpenController extends ApiController
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

        $cunzai1 = DataCompanyAbnormalAddress::where(['code'=>$code])->first();
        if($cunzai1){
            return $this->failed('已经存在');
        }

        $cunzai = DataCompany::where(['code'=>$code])->first();
        if($cunzai){
            return $this->failed('已经存在');
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


    /**
     * 获取公司名
     */
    public function get_name(){
        $cunzai = DataCompanyAbnormalAddress::inRandomOrder()->where(['has_mobile'=>0])->orderby('dtime','desc')->select('firm_id','name')->first();
        return $this->success($cunzai);
    }

    /**
     * 保存号码
     */
    public function save_mobile(Request $request){
        $mobile = $request->mobile;
        if(!$mobile){
            return $this->failed('mobile不能为空');
        }

        $id = $request->id;
        if(!$id){
            return $this->failed('id不能为空');
        }

        $list = DataCompanyList::where(['firm_id'=>$id])->first();
        if(!$list){
            return $this->failed('公司不存在');
        }

        $model = new DataCompanyContact();

        $yiyang = $model->where(['firm_id'=>$id,'mobile'=>$mobile])->first();
        if($yiyang){
            return $this->success($yiyang->name.'保存成功,已存在');
        }

        $model->firm_id = $id;
        $model->name = $list->name;
        $model->mobile = $mobile;

        $model->save();

        DataCompanyAbnormalAddress::where(['firm_id'=>$id])->update(['has_mobile'=>1]);

        return $this->success($list->name.'保存成功');
    }
}
