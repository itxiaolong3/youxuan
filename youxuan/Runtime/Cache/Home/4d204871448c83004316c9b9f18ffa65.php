<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/xsyx.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/aui-pull-refresh.css" />
        <title>管理首页</title>
    </head>
    <body>
    <section class="aui-refresh-content">
       <div class="user-container border-t-20 border-b-20">
            <label>
                <div class="left">
                    <form method="post" action="<?php echo U('Indexadmin/uploadimg');?>" id="postimg" enctype="multipart/form-data">
                    <input class="file" type="file"  id="file" name="file"  accept="image/*"/>
                    </form>
                    <img src="/tp3/youxuan/Public/<?php echo ($shopinfo['dheaderimg']); ?>" />
                    <p>修改头像</p>
                </div>
            </label>
            <div class="right">
                <p class="name"><?php echo ($shopinfo['dname']); ?></p>
                <div class="edit">
                    <form method="post" action="<?php echo U('Indexadmin/updatasign');?>" id="postsign">
                        <input type="text" value="<?php echo ((isset($shopinfo['dsign']) && ($shopinfo['dsign'] !== ""))?($shopinfo['dsign']):'暂无签名'); ?>" name="dsign" id="sign">
                    </form>
                    <img src="/tp3/youxuan/Public/home/home_admin/images/icon/edit.png">
                </div>
            </div>
        </div>
        <div class="data-container border-b-20">
            <div class="item">
                <p class="title">今日订单数：</p>
                <p class="content"><?php echo ($todaynum); ?>笔</p>
            </div>
            <div class="item">
                <p class="title">今日收益：</p>
                <p class="content"><?php echo ($todaymoney); ?>元</p>
            </div>
            <div class="item">
                <p class="title">累计收益：</p>
                <p class="content"><?php echo ($allnum); ?>元</p>
            </div>
        </div>
        <div class="grid-container">
            <a class="item" href="<?php echo U('Index/index',array('sid'=>$sid));?>">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/share.png">
                <p>商品分享</p>
            </a>
            <a class="item" href="<?php echo U('Index/index',array('sid'=>$sid,'ke'=>'yes'));?>">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/acting.png">
                <p>代客下单</p>
            </a>
            <a class="item" href="<?php echo U('Refund/index');?>">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/refund.png">
                <p>退货/售后</p>
            </a>
            <a class="item" href="<?php echo U('Bonus/index');?>">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/chart.png">
                <p>我的提成</p>
            </a>
            <a class="item" href="<?php echo U('cash/index');?>">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/cash.png">
                <p>提现/记录</p>
            </a>
            <a class="item" href="<?php echo U('Orderadmin/index');?>">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/order.png">
                <p>订单管理</p>
            </a>
            <a class="item" href="<?php echo U('Vip/index');?>">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/vip.png">
                <p>查看会员</p>
            </a>
            <a class="item" href="">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/scan.png">
                <p>扫一扫</p>
            </a>
            <a class="item" href="<?php echo U('Repass/index',array('x'=>1));?>">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/pass.png">
                <p>修改密码</p>
            </a>
        </div>
        <div class="code-container">
            <!--<img src="/tp3/youxuan/Public/home/home_admin/images/other/code.png">-->
            <img src="/tp3/youxuan/index.php/Home/My/getqrcorde?sid=<?php echo ($sid); ?>" />
            <p>门店分享码</p>
        </div>
        <div class="btn-container1">
            <a class="btn" href="<?php echo U('Indexadmin/outlogin');?>">退出</a>
        </div>
    </section>
    </body>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/xsyx.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/aui-pull-refresh.js"></script>
    <script>
        //修改头像
        $("#file").on("click",function(e){ //点击事件
            $(this).on("change",function(e){ //input值发生变化时触发事件
                $('#postimg').submit();
            });

        });
        //修改签名
        $("#sign").on("click",function(e){ //点击事件
            $(this).on("change",function(e){ //input值发生变化时触发事件
                $('#postsign').submit();
            });
        });
        //下拉刷新
        var pullRefresh = new auiPullToRefresh({
            container: document.querySelector('.aui-refresh-content'),
            triggerDistance: 500
        },function(ret){
            if(ret.status=="success"){
               // setTimeout(function(){
                    window.location.reload();
                   // pullRefresh.cancelLoading(); //刷新成功后调用此方法隐藏
                //},2000)

            }
        })
    </script>

</html>