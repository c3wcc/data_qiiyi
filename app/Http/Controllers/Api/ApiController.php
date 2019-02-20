<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    use ApiResponse;
    // 其他通用的Api帮助函数


    /**
     * 获取客户端ip地址
     * @return string ip地址
     */
    public function getClientIP(){
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else $ip = "Unknow";
        return $ip;
    }

    public function startwith($str,$pattern) {
        if(strpos($str,$pattern) === 0)
              return true;
        else
              return false;
    }

}
