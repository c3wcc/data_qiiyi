<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends ApiController
{

    public function easyWechatGetSession($code)
    {
        $app = app('wechat.mini_program');
        return $app->auth->session($code);
    }

    /**
     * 通过code 登录
     */
    public function login_by_code(Request $request)
    {
        $wx_info = $this->easyWechatGetSession($request->code);
        if (isset($wx_info['errcode'])) {
            return $this->success($wx_info);
        }

        $session_key = $wx_info['session_key'];
        $openid = $wx_info['openid'];
        Cache::add($openid.'sessionkey',$session_key,60);
        $userInfo = User::where('openid', $openid)->first();
        //注册
        if (!$userInfo) {
            //注册
            $newUser = [
                'openid' => $openid, //openid
                'nickname' => '微信用户', // 昵称
                'avatar' => 'http://c3w.cc/public/noavatar.gif', //头像
                'password' => '',
            ];
            $userInfo = User::create($newUser);
        }
        $token = $userInfo->createToken($openid)->accessToken;
        $userInfo['token'] = $token;
        return $this->success($userInfo);
    }

    /**
     * 更新手机号
     */
    public function updatePhone(Request $request)
    {
        $sessioncode = cache($request->phone . 'smscode');
        if ($request->code != null && $sessioncode != $request->code) {
            return $this->failed('验证码错误或过期！');
        } else {
            $user = auth('api')->user();
            $user->phone = $request->phone;
            $user->save();
            return $this->success('保存成功');
        }
    }

    public function decryData(Request $request)
    {
        $sessionKey = Cache::get((auth('api')->user()->openid).'sessionkey');
        $app = app('wechat.mini_program');
        $res = $app->encryptor->decryptData($sessionKey, $request->iv, $request->encryptData);
        return $this->success($res);
    }
    /**
     * 修改 用户ID
     *
     * 统一用户ID
     * https://waimai.c3w.cc/unique_id?openid='.$openid.'&id='.$user_id.'&nickname='.$nickname.'&avatar='.$head_pic
     */
    public function unique_id(Request $request)
    {
        $openid = $request->openid;
        $id = $request->id;
        if (!$openid && !$id) {
            return $this->success('openid,id不存在');
        }
        $UserModel = new User();
        $user = $UserModel->where(['openid' => $openid])->first();
        if (!$user) {
            return $this->success('用户不存在');
        }
        $user2 = $UserModel->where(['id' => $id])->first();
        if ($user2) {
            return $this->success('用户已更新');
        }

        //更新资料
        $user->id = $id;
        $user->nickname = $request->nickname;
        $user->school = $request->school;
        $user->avatar = $request->avatar;
        $user->save();

        return $this->success('更新成功');
    }
}
