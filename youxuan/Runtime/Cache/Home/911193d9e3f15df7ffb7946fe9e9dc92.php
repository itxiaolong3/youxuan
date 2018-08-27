<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/xsyx.css" />
        <title>登录账户</title>
    </head>
    <body>
        <div class="login-container">
            <img class="logo-t" src="/tp3/youxuan/Public/home/home_admin/images/other/logo_b.png">
            <form action="/tp3/youxuan/index.php/Loginadmin/index.html" method="POST" id="subform">
                <div class="input-container1">
                    <input type="text" placeholder="账户" name="phone" value="" required="required" id="phone">
                    <img src="/tp3/youxuan/Public/home/home_admin/images/icon/user.png">
                </div>
                <div class="input-container1">
                    <input type="password" placeholder="密码" name="password" value="" required="required" id="password">
                    <img src="/tp3/youxuan/Public/home/home_admin/images/icon/lock.png">
                </div>
                <!--<a class="btn-container2" onclick="postinfo()">提交</a>-->
                <button class="btn-container2" type="submit">提交</button>
            </form>
            <a class="forget" href="<?php echo U('Repass/index');?>">忘记密码？</a>
            <img class="logo-b fix-b" src="/tp3/youxuan/Public/home/home_admin/images/other/logo_s.png">
        </div>
    </body>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/xsyx.js"></script>
    <script>
        function postinfo() {
            getphone=$('#phone').val();
            getpassword=$('#password').val();
            $.post(
                "<?php echo U('Loginadmin/index');?>",
                {'phone':getphone,
                 'password':getpassword
                },function (data) {

                }
            )
        }
    </script>

</html>