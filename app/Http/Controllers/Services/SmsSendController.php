<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require_once app_path('Libs/sms/SmsSend.php');

class SmsSendController extends Controller
{
    
    public function send(Request $request){
        $sms = new \SmsSend(
            config('sms.accessKeyId'),
            config('sms.accessKeySecret')
        );

        //生成6位字符
        $randStr = str_shuffle('123456789012345678901234567890');
        $code = substr($randStr,0,4);
        //调用发送验证码
        $response = $sms->sendSms(
            config('sms.signname'), // 短信签名
            config('sms.templateCode'), // 短信模板编号
            $request->phone, // 短信接收者
            Array(  // 短信模板中字段的值
                "code"=>$code
            )
        );
        //存到cache
        \cache([$request->phone.'smscode'=>$code],10);
        return $response->Message;
    }
}
