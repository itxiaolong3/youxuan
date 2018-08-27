<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/xsyx.css" />
        <title>售后申请</title>
    </head>
    <body class="bg body-t">
        <div class="header-container">
            <a class="left" onclick="javascript:history.back();">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/left.png" />
                <span>返回</span>
            </a>
            <div class="middle">售后申请</div>
            <a class="right" href=""></a>
        </div>
        <div class="search" style="display: none;">
            <img src="/tp3/youxuan/Public/home/home_admin/images/icon/search.png" />
            <input placeholder="搜索" disabled />
        </div>
        <div class="nav-container" style="margin-bottom: 0.2667rem;">
            <div class="nav active">售后申请</div>
            <div class="nav">申请记录</div>
        </div>
        <div class="list-container1">
            <?php if(is_array($orderinfo)): foreach($orderinfo as $key=>$v): ?><div class="item">
                    <div class="title">
                        <p>订单编号：<?php echo ($v["onumber"]); ?></p>
                        <p style="color: #e70012;">已提货</p>
                    </div>
                    <a class="info-1">
                        <div class="left"><img src="/tp3/youxuan/Public/<?php echo ($v["gtopimg"]); ?>" width="183" height="182" /></div>
                        <div class="right">
                            <div class="name"><?php echo ($v["gtitle"]); ?>&nbsp;<?php echo ($v["gdes"]); ?></div>
                            <div class="bottom">
                                <p style="color: #e70012;">￥<?php echo ($v["gyhprice"]); ?></p>
                                <p><?php echo ($v["onum"]); ?></p>
                            </div>
                        </div>
                    </a>
                    <div class="info-2">
                        <div class="left">
                            <p><?php echo ($v["nickname"]); ?></p>
                            <p style="margin-top: 0.2667rem;">提单号：<span style="color: #e70012;"><?php echo ($v["oid"]); ?></span></p>
                        </div>
                        <div class="middle">
                            <p><?php echo ($v["ouserphone"]); ?></p>
                            <p style="margin-top: 0.2667rem;"><?php echo ($v["ordertime"]); ?></p>
                        </div>
                        <div class="right" onclick="torefund('<?php echo ($v["oid"]); ?>','<?php echo ($v["osid"]); ?>','<?php echo ($v["ouid"]); ?>','<?php echo ($v["ogid"]); ?>','<?php echo ($v["ouserphone"]); ?>','<?php echo ($v["onumber"]); ?>');">申请售后</div>
                    </div>
                </div><?php endforeach; endif; ?>
        </div>
        <div class="list-container1 hid">
            <?php if(is_array($houinfo)): foreach($houinfo as $key=>$v): ?><div class="item">
                    <div class="title">
                        <p>订单编号：<?php echo ($v["hordernum"]); ?></p>
                        <p style="color: #e70012;"><?php echo ($v['htype']==1 ? '已退款':'等待审核'); ?></p>
                    </div>
                    <a class="info-1">
                        <div class="left"><img src="/tp3/youxuan/Public/<?php echo ($v["gtopimg"]); ?>" width="183" height="182" /></div>
                        <div class="right">
                            <div class="name"><?php echo ($v["gtitle"]); ?>&nbsp;<?php echo ($v["gdes"]); ?></div>
                            <div class="bottom">
                                <p style="color: #e70012;">￥<?php echo ($v["gyhprice"]); ?></p>
                                <p><?php echo ($v["onum"]); ?></p>
                            </div>
                        </div>
                    </a>
                    <div class="info-2">
                        <div class="left">
                            <p><?php echo ($v["nickname"]); ?></p>
                            <p style="margin-top: 0.2667rem;">下单时间：</p>
                        </div>
                        <div class="middle">
                            <p><?php echo ($v["phone"]); ?></p>
                            <p style="margin-top: 0.2667rem;"><?php echo ($v["haddtime"]); ?></p>
                        </div>
                        <div class="right disable"><?php echo ($v['htype']==1?'已完成':'申请中'); ?></div>
                    </div>
                </div><?php endforeach; endif; ?>

        </div>
        <div id="mask" class="mask mask-out"></div>
        <div class="search-container hid">
            <div class="header">搜索</div>
            <div class="content">
                <div class="title">按联系方式查询：</div>
                <input placeholder="选填">
                <div class="title">按订单编号查询：</div>
                <input placeholder="选填">
                <div class="title">按时间区域查询：</div>
                <div class="time">
                    <div class="select">
                        <input type="text" id="date2" data-options="{'type':'YYYY-MM-DD','beginYear':2010,'endYear':2088}" placeholder="开始时间">
                    </div>
                    <div class="text">至</div>
                    <div class="select">
                        <input type="text" id="date3" data-options="{'type':'YYYY-MM-DD','beginYear':2010,'endYear':2088}" placeholder="结束时间">
                    </div>
                </div>
                <div class="btn">搜索</div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/hyp.js"></script>
    <script src="/tp3/youxuan/Public/home/home_admin/js/jquery.date.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/xsyx.js"></script>
    <script>
        $.date('#date2');
        $.date('#date3');
    </script>
<script>
    //提交申请售后
    function torefund(oid,hsid,huid,hgid,hphone,hordernum) {
        if(window.confirm('是否已收到用户商品？')){
            $.post(
                "<?php echo U('Refund/dorefund');?>",
                {
                    'oid':oid,
                    'hsid':hsid,
                    'huid':huid,
                    'hgid':hgid,
                    'hphone':hphone,
                    'hordernum':hordernum,
                },function (e) {
                    e=JSON.parse(e);
                    if(e.code==0){
                        window.location.reload();
                    }else{
                        alert('申请失败！');
                    }
                }
            );
            return true;
        }else{
            return false;
        }
    }
</script>
</html>