<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//发送短信
route::get('sendsmscode', 'Services\SmsSendController@send');

//统一用户ID，account用户体系
route::any('unique_id', 'Api\UserController@unique_id');

//home
route::any('home/info', 'Home\InfoController@index');
route::any('home/info/add', 'Home\InfoController@add');