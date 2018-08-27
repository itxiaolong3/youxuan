<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/home_admin/css/xsyx.css" />
        <title>我的提成</title>
    </head>
    <body class="body-t">
        <div class="header-container">
            <a class="left" onclick="javascript:history.back();">
                <img src="/tp3/youxuan/Public/home/home_admin/images/icon/left.png" />
                <span>返回</span>
            </a>
            <div class="middle">我的提成</div>
            <a class="right" href=""></a>
        </div>
        <div class="bonus-header">
            <div class="bonus-nav">
                <div class="nav bonus-active">今日</div>
                <div class="nav">本周</div>
                <div class="nav">本月</div>
                <div class="nav">累计</div>
            </div>
            <div class="bonus-count">
                <div class="allprice">
                    <span class="sign">￥</span><span class="count"><?php echo ($totaltoday); ?></span>
                </div>
                <div class="allprice hid">
                    <span class="sign">￥</span><span class="count"><?php echo ($totalweek); ?></span>
                </div>
                <div class="allprice  hid">
                    <span class="sign">￥</span><span class="count"><?php echo ($totalmonth); ?></span>
                </div>
                <div class="allprice  hid">
                    <span class="sign">￥</span><span class="count"><?php echo ($totalall); ?></span>
                </div>

            </div>
        </div>
        <div class="nav-container" style="padding: 0 0.2667rem;">
            <div class="nav">产品名称</div>
            <div class="nav">提成单位</div>
            <div class="nav">数量</div>
            <div class="nav">提成</div>
            <div class="nav">时间</div>
        </div>
        <!--今日-->
        <div class="bonus-list">
            <?php if(is_array($todayticheng)): foreach($todayticheng as $key=>$v): ?><div class="item">
                    <div><?php echo ($v["gtitle"]); ?></div>
                    <div><?php echo ($v["gticheng"]); ?>元/份</div>
                    <div><?php echo ($v["buynum"]); ?></div>
                    <div><?php echo ($v['gticheng'] * $v['buynum']); ?></div>
                    <div><?php echo ($v["oaddtime"]); ?></div>
                </div><?php endforeach; endif; ?>

            <!--<div class="item">-->
                <!--<div>泰国兰纳足贴10片/包</div>-->
                <!--<div>2.3元/份</div>-->
                <!--<div>2</div>-->
                <!--<div>4.6</div>-->
                <!--<div>18-06-24</div>-->
            <!--</div>-->
        </div>
        <!--本周-->
        <div class="bonus-list hid">
            <?php if(is_array($weekticheng)): foreach($weekticheng as $key=>$v): ?><div class="item">
                    <div><?php echo ($v["gtitle"]); ?></div>
                    <div><?php echo ($v["gticheng"]); ?>元/份</div>
                    <div><?php echo ($v["buynum"]); ?></div>
                    <div><?php echo ($v['gticheng'] * $v['buynum']); ?></div>
                    <div><?php echo ($v["oaddtime"]); ?></div>
                </div><?php endforeach; endif; ?>
        </div>
        <!--本月-->
        <div class="bonus-list hid">
            <?php if(is_array($monthticheng)): foreach($monthticheng as $key=>$v): ?><div class="item">
                    <div><?php echo ($v["gtitle"]); ?></div>
                    <div><?php echo ($v["gticheng"]); ?>元/份</div>
                    <div><?php echo ($v["buynum"]); ?></div>
                    <div><?php echo ($v['gticheng'] * $v['buynum']); ?></div>
                    <div><?php echo ($v["oaddtime"]); ?></div>
                </div><?php endforeach; endif; ?>
        </div>
        <!--累计-->
        <div class="bonus-list hid">
            <?php if(is_array($allticheng)): foreach($allticheng as $key=>$v): ?><div class="item">
                    <div><?php echo ($v["gtitle"]); ?></div>
                    <div><?php echo ($v["gticheng"]); ?>元/份</div>
                    <div><?php echo ($v["buynum"]); ?></div>
                    <div><?php echo ($v['gticheng'] * $v['buynum']); ?></div>
                    <div><?php echo ($v["oaddtime"]); ?></div>
                </div><?php endforeach; endif; ?>
        </div>
    </body>

    <!--<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>-->
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/jquer3.1.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/home_admin/js/xsyx.js"></script>
    <script>
            $(".bonus-nav .nav").on("click",function(){
                var idx = $(this).index();
                console.log(idx);
                $(".bonus-count .allprice").eq(idx).removeClass('hid').siblings('.allprice').addClass('hid');
            });
    </script>

</html>