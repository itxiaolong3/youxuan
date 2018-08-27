<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/xsyx.css" />
        <title>忘记密码</title>
    </head>
    <body class="body-t">
        <div class="header-container">
            <a class="left" onclick="javascript:history.back();">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/left.png" />
                <span>返回</span>
            </a>
            <div class="middle">忘记密码</div>
            <a class="right" href=""></a>
        </div>
        <form action="" method="post">
            <div class="input-container2">
                <div class="left">手机号：</div>
                <input placeholder="请输入手机号" name="phone" value="159****2345" disabled>
            </div>
            <div class="input-container2">
                <div class="left">验证码：</div>
                <input placeholder="请输入验证码" name="verify" value="" maxlength="6">
                <div class="right">获取验证码</div>
            </div>
            <div class="input-container2">
                <div class="left">设置密码：</div>
                <input type="password" placeholder="请输入新的密码" name="pass" value="">
            </div>
            <div class="input-container2">
                <div class="left">确认密码：</div>
                <input type="password" placeholder="请再次输入密码" name="cpass" value="">
            </div>
            <a class="btn-container3" href="">提交</a>
        </form>
        <img class="logo-b fix-b" src="/tp3/youxuan/Public/home/home_admin/images/other/logo_s.png">
    </body>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/xsyx.js"></script>

</html>