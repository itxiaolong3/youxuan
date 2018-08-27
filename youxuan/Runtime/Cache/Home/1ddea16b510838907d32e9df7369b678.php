<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/xsyx.css" />
        <title><?php echo ($title); ?></title>
    </head>
    <body class="body-t">
        <div class="header-container">
            <a class="left" onclick="javascript:history.back();">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/left.png" />
                <span>返回</span>
            </a>
            <div class="middle"><?php echo ($title); ?></div>
            <a class="right" href=""></a>
        </div>
        <form action="" method="post">
            <div class="input-container2">
                <div class="left">手机号：</div>
                <input placeholder="请输入手机号" name="phone" value="<?php echo ($phone); ?>" id="getphone">
            </div>
            <div class="input-container2">
                <div class="left">验证码：</div>
                <input type="number" placeholder="请输入验证码" name="verify" value="" maxlength="6" id="inputcode" >
                <div class="right">获取验证码</div>
                <div class="right2">还剩(60)秒</div>
            </div>
            <input type="hidden" value="" id="backcode">
            <div class="input-container2">
                <div class="left">设置密码：</div>
                <input type="password" placeholder="请输入新的密码" name="pass" value="" id="inputpsw">
            </div>
            <div class="input-container2">
                <div class="left">确认密码：</div>
                <input type="password" placeholder="请再次输入密码" name="cpass" value="" id="surepsw">
            </div>
            <a class="btn-container3" href="" onclick="dochangpassword();return false;">提交</a>
        </form>
        <img class="logo-b fix-b" src="/tp3/youxuan/Public/home/home_admin/images/other/logo_s.png">
    </body>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/jquer3.1.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/xsyx.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/md5.js"></script>

<script>
    //验证码倒计时
    var time = 60;
    var times;
    function zou(){
        times=setInterval(function(){
            if(time == 0){
                time = 60;
                $(".input-container2 .right").show();
                $(".input-container2 .right2").hide();
                clearInterval(times);
            }else{
                time--;
                //console.log(time)
                if(time < 10){
                    $(".input-container2 .right2").text('还剩(0'+time+')秒');
                }else{
                    $(".input-container2 .right2").text('还剩('+time+')秒');
                }
            }
        },1000);
    }
    $(".input-container2 .right2").hide();
    $(".input-container2 .right").on("click",function(){

        getphone=$('#getphone').val();
        var re=/^[1][3,4,5,7,8][0-9]{9}$/;
        if (re.test(getphone)){
            $(".input-container2 .right2").show();
            $(".input-container2 .right").hide();
            zou();
            $.post(
                "<?php echo U('Repass/sendcode');?>",
                {'getphone':getphone},function (e) {
                    console.log(e);
                    e=JSON.parse(e);
                    if(e.status==1){
                        $('#backcode').attr('value',e.code);
                    }else if(e.status==-1){
                        alert('该手机号不是商户，请联系管理员');
                        time = 60;
                        $(".input-container2 .right").show();
                        $(".input-container2 .right2").hide();
                        clearInterval(times);
                        return false;
                    }else{
                        alert('获取验证码失败');
                        time = 60;
                        $(".input-container2 .right").show();
                        $(".input-container2 .right2").hide();
                        clearInterval(times);
                    }

                }
            );
        }else{
           alert('手机格式有误');
        }


    });
    function dochangpassword() {
        md5code=$('#backcode').val();
        inputcode=$('#inputcode').val();
        mymd5code=hex_md5('xiaolong'+inputcode);
        if (mymd5code==md5code){
            getpsw=$('#inputpsw').val();
            surpsw=$('#surepsw').val();
            getphone=$('#getphone').val();
            if (getpsw==surpsw){
                if(window.confirm('修改后需重新登录，是否继续？')) {
                    //提交修改
                    $.post(
                        "<?php echo U('Repass/updatainfo');?>",
                        {
                            'phone':getphone,
                            'psw':getpsw
                        },function (e) {
                            e=JSON.parse(e);
                            if(e.status==1){
                                //修改成功
                                window.location.href="<?php echo U('Loginadmin/index');?>";
                            }else{
                                alert('修改失败');
                                return false;
                            }
                        });
                }else{
                    return false
                }

            }
            else{
                alert('前后密码不一致');
            }
            console.log('验证码拼配成功')
        }else{
            alert('输入验证码不正确');
            console.log('验证码不一致');
        }

    }
//testcod=hex_md5('xiaolong123456');
//console.log(testcod);
</script>

</html>