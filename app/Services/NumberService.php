<?php

namespace App\Services;

use App\Models\AdminConfig;
use Carbon\Carbon;

class NumberService
{
    
    public static function get_number($name){
        
        return "<a href=https://www.qichacha.com/search?key=".$name." target='_blank'><div class='btn btn-sm btn-success'>获取号码</div></a>";
    }

}