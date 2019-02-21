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
    public function getClientIP()
    {
        if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR")) {
            $ip = getenv("REMOTE_ADDR");
        } else {
            $ip = "Unknow";
        }

        return $ip;
    }

    public function startwith($str, $pattern)
    {
        if (strpos($str, $pattern) === 0) {
            return true;
        } else {
            return false;
        }

    }

    public function create_code($namespace = '')
    {
        static $guid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];

        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtolower(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash, 0, 8) . substr($hash, 8, 4) . substr($hash, 12, 4) . substr($hash, 16, 4) . substr($hash, 20, 12);
        return $guid;
    }

}
