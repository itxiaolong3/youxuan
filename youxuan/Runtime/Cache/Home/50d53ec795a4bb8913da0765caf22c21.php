<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/xsyx.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/my.css" />
        <title>个人中心</title>
    </head>
    <body>
       <div class="header-container">
            <a class="left" onclick="javascript:history.back();">
                <img src="/tp3/youxuan/Public/home/images/icon/left.png" />
                <span>返回</span>
            </a>
            <div class="middle">个人中心</div>
           <a class="right" href="<?php echo U('Index/index',array('sid'=>$sid));?>">首页</a>
        </div>
        <div class="user-container">
          <div class="left">
                <img src="<?php echo ($userinfo["headerimg"]); ?>" />
                <div class="info">
                    <p style="margin-bottom: 0.2rem;"><?php echo ($userinfo["nickname"]); ?></p>
                    <p><?php echo ((isset($userinfo["phone"]) && ($userinfo["phone"] !== ""))?($userinfo["phone"]):"未填手机号"); ?></p>
                </div>
            </div>
            <div id="ewm">
              <img class="right" src="/tp3/youxuan/Public/home/images/other/code.png" />
            </div>
        </div>
        <div class="list-container">
            <a class="item" href="<?php echo U('Order/index',array('sid'=>$sid));?>">
                <div class="left">
                    <img src="/tp3/youxuan/Public/home/images/icon/order.png" />
                    <span>全部订单</span>
                </div>
                <img class="right" src="/tp3/youxuan/Public/home/images/icon/right.png" />
            </a>
            <a class="item" href="<?php echo U('Order/index',array('i'=>1,'sid'=>$sid));?>">
                <div class="left">
                    <img src="/tp3/youxuan/Public/home/images/icon/order_1.png" />
                    <span>未付款</span>
                </div>
                <img class="right" src="/tp3/youxuan/Public/home/images/icon/right.png" />
            </a>
            <a class="item" href="<?php echo U('Order/index',array('i'=>2,'sid'=>$sid));?>">
                <div class="left">
                    <img src="/tp3/youxuan/Public/home/images/icon/order_2.png" />
                    <span>待提货</span>
                </div>
                <img class="right" src="/tp3/youxuan/Public/home/images/icon/right.png" />
            </a>
            <a class="item" href="<?php echo U('Order/index',array('i'=>3,'sid'=>$sid));?>">
                <div class="left">
                    <img src="/tp3/youxuan/Public/home/images/icon/order_3.png" />
                    <span>已提货</span>
                </div>
                <img class="right" src="/tp3/youxuan/Public/home/images/icon/right.png" />
            </a>
        </div>
        <a class="btn-1" href="<?php echo U('Index/index',array('sid'=>$sid));?>">去购物</a>
        <!--<a class="btn-2" href="<?php echo U('Login/index');?>">退出</a>-->
        <div id="dialog-container" class="dialog-container hid"><img src="/tp3/youxuan/index.php/Home/My/getqrcorde?sid=<?php echo ($sid); ?>" /></div>
        <div id="mask" class="mask mask-out"></div>
    </body>
    <script>
        var jsfori=0;
        var jsforsid=0;
    </script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/xsyx.js"></script>
</html>