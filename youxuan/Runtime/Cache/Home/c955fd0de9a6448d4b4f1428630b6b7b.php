<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/xsyx.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/login.css" />
        <title>登录账户</title>
    </head>
    <body>
        <div class="login-container">
            <img class="logo-t" src="/tp3/youxuan/Public/home/images/other/logo_b.png">
            <div class="input-container">
                <input id="tel" type="tel" maxlength="11" placeholder="请输入您的手机号">
                <img src="/tp3/youxuan/Public/home/images/icon/user.png">
            </div>
            <div class="input-container">
                <input type="text" maxlength="6" placeholder="请输入验证码">
                <div class="msg">获取验证码</div>
                <div class="msg2">还剩(60)秒</div>
            </div>
            <a class="btn-container" href="<?php echo U('Index/index');?>">提交</a>
            <img class="logo-b" src="/tp3/youxuan/Public/home/images/other/logo_s.png">
        </div>

        <div class="wrong">手机号码格式有误</div>
    </body>
    <script>
        var jsfori=0;
        var jsforsid=0;
    </script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/xsyx.js"></script>

</html>