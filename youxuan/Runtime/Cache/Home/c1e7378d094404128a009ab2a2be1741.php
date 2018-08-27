<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/hyp.css"/>
    <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/xsyx.css"/>
    <title>交易记录</title>
</head>
<body class="body-t">
<div class="header-container">
    <a class="left" onclick="javascript:history.back();">
        <img src="/tp3/youxuan/Public/home/home_admin/images/icon/left.png"/>
        <span>返回</span>
    </a>
    <div class="middle">交易记录</div>
    <a class="right" href=""></a>
</div>
<div class="nav-container top">
    <div class="nav active">全部</div>
    <div class="nav">收益</div>
    <div class="nav">支出</div>
</div>
<!--全部-->
<div class="cash-list">
    <?php if(is_array($allinfo)): foreach($allinfo as $key=>$v): ?><div class="item">
            <div class="left">
                <?php if($v["rtype"] == 0): ?><p>提成</p>
                    <?php elseif($v["rtype"] == 1): ?>
                    <p>退款</p>
                    <?php else: ?>
                    <p>提现</p><?php endif; ?>
                <p><?php echo ($v["raddtime"]); ?></p>
            </div>
            <div class="right">
                <?php if(($v["rtype"] == 1) OR ($v["rtype"] == 2) ): ?><p class="down">-<?php echo ($v["rmoney"]); ?></p>
                    <?php else: ?>
                    <p class="up">+<?php echo ($v["rmoney"]); ?></p><?php endif; ?>
                <p class="count">余额：<span><?php echo ($v["ryue"]); ?></span></p>
            </div>
        </div><?php endforeach; endif; ?>
    <!--<div class="item">-->
    <!--<div class="left">-->
    <!--<p>提成</p>-->
    <!--<p>2018-04-23</p>-->
    <!--</div>-->
    <!--<div class="right">-->
    <!--<p class="up">+2.1</p>-->
    <!--<p class="count">余额：<span>507.51</span></p>-->
    <!--</div>-->
    <!--</div>-->
</div>
<!--收益-->
<div class="cash-list hid">
    <?php if(is_array($getinfo)): foreach($getinfo as $key=>$v): ?><div class="item">
            <div class="left">
                <p>提成</p>
                <p><?php echo ($v["raddtime"]); ?></p>
            </div>
            <div class="right">
                <p class="up">+<?php echo ($v["rmoney"]); ?></p>
                <p class="count">余额：<span><?php echo ($v["ryue"]); ?></span></p>
            </div>
        </div><?php endforeach; endif; ?>
</div>
<div class="cash-list hid">
    <?php if(is_array($outinfo)): foreach($outinfo as $key=>$v): ?><div class="item">
            <div class="left">
                <?php if($v["rtype"] == 0): ?><p>提成</p>
                    <?php elseif($v["rtype"] == 1): ?>
                    <p>退款</p>
                    <?php else: ?>
                    <p>提现</p><?php endif; ?>
                <p><?php echo ($v["raddtime"]); ?></p>
            </div>
            <div class="right">
                <p class="down">-<?php echo ($v["rmoney"]); ?></p>
                <p class="count">余额：<span><?php echo ($v["ryue"]); ?></span></p>
            </div>
        </div><?php endforeach; endif; ?>
</div>
</body>
<script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/hyp.js"></script>
<script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/xsyx.js"></script>

</html>