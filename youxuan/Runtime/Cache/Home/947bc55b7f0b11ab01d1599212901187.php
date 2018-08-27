<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/xsyx.css" />
        <title>结算中心</title>
    </head>
    <body class="body-t bg">
        <div class="header-container">
            <a class="left" onclick="javascript:history.back();">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/left.png" />
                <span>返回</span>
            </a>
            <div class="middle">结算中心</div>
            <a class="right" href="<?php echo U('Cashrecord/index');?>">明细</a>
        </div>
        <div class="cash-header">
            <img src="/tp3/youxuan/Public/home/home_admin/images/other/cash.png" />
            <div class="cash-count">
                <span class="sign">￥</span><span class="count"><?php echo ($enablemoney); ?></span>
            </div>
        </div>
        <div class="cash-footer">
            <div class="top">可提现金额=总金额-审核中的金额</div>
            <div class="bottom">
                <div>
                    <p>总金额（元）</p>
                    <p><?php echo ($allmoney); ?></p>
                </div>
                <div>
                    <p>审核中的金额（元）</p>
                    <p><?php echo ((isset($txzhong) && ($txzhong !== ""))?($txzhong):'0.00'); ?></p>
                </div>
            </div>
        </div>
        <a class="btn-container4" href="<?php echo U('Cashapply/index');?>">申请提现</a>
    </body>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/xsyx.js"></script>

</html>