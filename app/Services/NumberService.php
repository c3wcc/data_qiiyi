<?php

namespace App\Services;

use App\Models\DataCompanyList;
use App\Models\DataCompanyContact;
use App\Models\AdminConfig;
use Carbon\Carbon;

class NumberService
{
    
    public static function get_number($id,$name){
       
        $mobile = DataCompanyContact::where(['firm_id'=>$id])->value('mobile');
        if($mobile){
            return $mobile;
        }else{
            return "<a href=https://www.qichacha.com/search?key=".$name." target='_blank'><div class='btn btn-sm btn-success'>获取号码</div></a>";
        }
    }

}