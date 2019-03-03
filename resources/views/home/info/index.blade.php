<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>处理号码</title>
    <link rel="stylesheet" href="/css/weui.min.css"/>
</head>
<body>
    <div id="container" class="container"><div class="zh_CN"><div class="weui-msg">
    <!-- <div class="weui-msg__icon-area">
        <i class="weui-icon-success weui-icon_msg"></i>
    </div> -->
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title">{{$name}}</h2>
        <p class="weui-msg__desc">{{$firm_id}}</p>
    </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <a href="https://www.qichacha.com/search?key={{$name}}" target='_blank' class="weui-btn weui-btn_default">查看该公司号码</a>
        </p>
    </div>

    <form action="/home/info/add">
    <input type="hidden" name="firm_id" value="{{$firm_id}}"/>
    <div class="weui-cells__title">号码</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="mobile" placeholder="请输入该公司号码"/>
            </div>
        </div>
    </div>

    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <button type="submit" class="weui-btn weui-btn_primary">保存</button>
        </p>
    </div>

    </form>

</div></div></div>

</body></html>
