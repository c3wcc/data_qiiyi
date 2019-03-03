<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

/*
|--------------------------------------------------------------------------
| 有新版本时启用
Route::namespace('v2')->group(function () {
Route::middleware('auth:api')->group(function () {

});
});
|--------------------------------------------------------------------------
 */

Route::namespace ('Api')->group(function () {

    Route::get('/index', 'IndexController@index');
    Route::get('/routinestyle', 'RoutineController@runtine_style'); //小程序颜色


    //通过code登录
    Route::get('/user/login_by_code', 'UserController@login_by_code');

    //测试
    Route::get('/test', 'TestController@index');

    // 需要用户登录后操作
    Route::middleware('auth:api')->group(function () {
        Route::post('/decrydata', 'UserController@decryData'); //加密信息解密
        Route::post('/updatephone','UserController@updatePhone');
        Route::get('/user/userinfo', 'UserController@userinfo'); //用户信息
    });

    //自动处理
    Route::any('/auto/add_list', 'AutoHandleController@add_list');

    //open
    Route::any('/data/add', 'OpenController@add');
    Route::any('/data/getname', 'OpenController@get_name');
    Route::any('/data/savemobile', 'OpenController@save_mobile');

});
