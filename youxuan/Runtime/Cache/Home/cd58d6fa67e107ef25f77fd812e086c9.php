<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/xsyx.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/ware-detail.css" />
        <title>商品详情</title>
    </head>
    <body>
        <main id="app">
            <div class="header-container">
                <a class="left" onclick="javascript:history.back();">
                    <img src="/tp3/youxuan/Public/home/images/icon/left.png" />
                    <span>返回</span>
                </a>
                <div class="middle">商品详情</div>
                <a class="right"></a>
            </div>
            <div class="nav-container">
                <div class="nav" style="color: #e70012;">商品详情</div>
                <div class="nav">购买记录</div>
            </div>
           <div class="detail-container">
                <div class="cover">
                    <ul id="banner-ul">
                        <?php if(is_array($goodsinfo['thums'])): foreach($goodsinfo['thums'] as $key=>$v): ?><li><img src="<?php echo ($v); ?>" /></li>
                        <!--<li><img src="/tp3/youxuan/Public/home/images/other/goods_2.jpg" /></li>-->
                        <!--<li><img src="/tp3/youxuan/Public/home/images/other/ware_cover.jpg" /></li>--><?php endforeach; endif; ?>
                    </ul>
                    <div id="dot">
                        <ul>
                            <?php if(is_array($goodsinfo['thums'])): foreach($goodsinfo['thums'] as $key=>$v): ?><li></li><?php endforeach; endif; ?>
                        </ul>
                    </div>

                </div>
                <div class="cover-footer">
                    <div class="left"><span>￥</span><?php echo ($goodsinfo["gyhprice"]); ?>&nbsp;&nbsp;<s>￥<?php echo ($goodsinfo["gprice"]); ?></s></div>
                    <div class="right">
                        <p class="top">距离本商品结束还剩</p>
                        <p id="time" class="bottom"></p>
                    </div>
                </div>
                <div class="container-1">
                    <p class="top"><?php echo ($goodsinfo["gtitle"]); ?></p>
                    <div class="bottom">
                        <p><?php echo ($goodsinfo["gdes"]); ?></p>
                        <p>关注人数：<?php echo ($salenum); ?></p>
                    </div>
                </div>
                <div class="container-2">
                    <div class="left">
                        <p style="margin-bottom: 0.2rem;">预售时间：<?php echo ($shopinfo["dpretime"]); ?></p>
                        <p>提货时间：<?php echo ($shopinfo["dendtime"]); ?> 16:00</p>
                    </div>
                    <div class="right">
                        已售<span style="color: #e70012;"> <?php echo ($salenum); ?> </span>份
                    </div>
                </div>
                <div class="container-3">
                    <div class="container-title">数量：</div>
                    <div class="right">
                        <div class="minus">-</div>
                        <div class="count">1</div>
                        <div class="plus">+</div>
                    </div>
                </div>
                <div class="container-4">
                    <p class="container-title">商品详情</p>
                    <p class="content"><span>供应商：</span><?php echo ($goodsinfo["gboss"]); ?></p>
                    <p class="content"><span>品牌：</span><?php echo ((isset($goodsinfo["gpingpai"]) && ($goodsinfo["gpingpai"] !== ""))?($goodsinfo["gpingpai"]):"暂无"); ?></p>
                    <p class="content"><span>规格：</span>1份</p>
                    <p class="content"><span>产地：</span><?php echo ($goodsinfo["gaddress"]); ?></p>
                </div>
                <div class="container-5">
                    <p class="container-title">图文详情</p>
                    <div class="content"><?php echo ($goodsinfo["gcomment"]); ?></div>
                    <!--<img class="image" src="/tp3/youxuan/Public/home/images/other/ware_detail.jpg" />-->
                </div>
                <div class="container-6">
                    <img src="/tp3/youxuan/Public/home/images/other/ware_flow.jpg" />
                </div>
            </div>
             <div class="record-container hid">
                <div class="record-title">
                    目前共<span><?php echo ($usernum); ?>人</span>参与购买，商品共销售<span><?php echo ((isset($salenum) && ($salenum !== ""))?($salenum):0); ?>份</span>
                </div>
                 <?php if(is_array($selluserinfo)): foreach($selluserinfo as $key=>$v): ?><div class="record-item">
                    <!--这里的头像地址得去掉public-->
                    <div class="left"><img src="/tp3/youxuan/Public/<?php echo ($v["headerimg"]); ?>"></div>
                    <div class="right">
                        <p><?php echo ($v["nickname"]); ?></p>
                        <p><span><?php echo ($v["onum"]); ?></span>份</p>
                        <p><?php echo ($v["oaddtime"]); ?></p>
                    </div>
                </div><?php endforeach; endif; ?>

                <!--<div class="record-item">-->
                    <!--<div class="left"></div>-->
                    <!--<div class="right">-->
                        <!--<p>用户名称</p>-->
                        <!--<p><span>1</span>份</p>-->
                        <!--<p>2018-04-20</p>-->
                    <!--</div>-->
                <!--</div>-->
            </div>
            <div class="footer-container">
                <a class="icon" onclick="postcartdata();">
                    <img src="/tp3/youxuan/Public/home/images/icon/cart.png" />
                    <div class="badge hid">0</div>
                </a>
                <a class="btn-1" onclick="addcart('<?php echo ($goodsinfo["gid"]); ?>','<?php echo ($goodsinfo["gtopimg"]); ?>','<?php echo ($goodsinfo["gtitle"]); ?>','<?php echo ($goodsinfo["gdes"]); ?>','<?php echo ($goodsinfo["gyhprice"]); ?>','<?php echo ($v["gprice"]); ?>','<?php echo ($sid); ?>');">加入购物车</a>
                <a class="btn-2" onclick="topay('<?php echo ($goodsinfo["gid"]); ?>','<?php echo ($goodsinfo["gtopimg"]); ?>','<?php echo ($goodsinfo["gtitle"]); ?>','<?php echo ($goodsinfo["gdes"]); ?>','<?php echo ($goodsinfo["gyhprice"]); ?>','<?php echo ($v["gprice"]); ?>');">立即购买</a>
            </div>
        </main>
    </body>
    <script>
        var jsfori=0;
        var  jsforsid="<?php echo ($sid); ?>";
    </script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/xsyx.js"></script>
    <script>
        //倒计时
        var currentTime = Date.parse(new Date())/1000;//获取当前时间戳
        var endTime = Date.parse('<?php echo ($goodsinfo["gendtime"]); ?>')/1000;//结束时间戳
        var downTime = parseInt(endTime - currentTime);//要结束的时间减去当前时间得出的时间戳放在这
        console.log(downTime);
        function go(){
            downTimes=setInterval(function(){
                var h = 0;
                m = 0;
                s = 0;
                if(downTime > 0){
                    h = Math.floor(downTime / (60 * 60));
                    m = Math.floor(downTime / 60) - (h * 60);
                    s = Math.floor(downTime) - (h * 60 * 60) - (m * 60);
                    if (h <= 9){
                        h = '0' + h;
                    }
                    if (m <= 9){
                        m = '0' + m;
                    }
                    if (s <= 9){
                        s = '0' + s;
                    }
                }else{
                    h = 0;
                    m = 0;
                    s = 0;
                }
                $("#time").html(h + ' ： ' + m + ' ： ' + s);
                downTime--;
            },1000);
        }

        go();
    </script>
<script>
    function addcart(gid,gtopimg,gtitle,gdes,gyhprice,gprice,sid) {
        var getnum=$(".right .count").html();
        //保存的数据
        product={
            id:gid,
            name:gtitle,
            num:getnum,
            gdes:gdes,
            gprice:gprice,
            saleprice:gyhprice,
            imgurl:gtopimg,
            sid:sid
        };
        cart.addproduct(product);
        //console.log("详情页中得到的数目"+getnum);
    }
    //立即购买
    function topay(gid,gtopimg,gtitle,gdes,gyhprice,gprice) {
        var getnum=$(".right .count").html();
        goodsinfo={
            id:gid,
            name:gtitle,
            num:getnum,
            gdes:gdes,
            gprice:gprice,
            saleprice:gyhprice,
            imgurl:gtopimg,
            totalprice:parseInt(getnum)*parseFloat(gyhprice)
        };
        var sid="<?php echo ($sid); ?>";
        var parames = new Array();
        parames.push({ name: "sid", value: sid});
        parames.push({ name: "onegood", value: JSON.stringify(goodsinfo)});
        Post("<?php echo U('Orderdetail/index');?>",parames);
    }
    function postcartdata() {
        var getdata= cart.getproductlist("<?php echo ($sid); ?>");
        var sid="<?php echo ($sid); ?>";
        var parames = new Array();
        parames.push({ name: "sid", value: sid});
        parames.push({ name: "shoppingcart", value: JSON.stringify(getdata)});
        Post("<?php echo U('Cart/index');?>",parames);
        // console.log(getdata);
    }
    /*
    *功能： 模拟form表单的提交
    *参数： URL 跳转地址 PARAMTERS 参数
     */
    function Post(URL, PARAMTERS) {
        //创建form表单
        var temp_form = document.createElement("form");
        temp_form.action = URL;
        //如需打开新窗口，form的target属性要设置为'_blank'
        temp_form.target = "_self";
        temp_form.method = "post";
        temp_form.style.display = "none";
        //添加参数
        for (var item in PARAMTERS) {
            var opt = document.createElement("textarea");
            opt.name = PARAMTERS[item].name;
            opt.value = PARAMTERS[item].value;
            temp_form.appendChild(opt);
        }
        document.body.appendChild(temp_form);
        //提交数据
        temp_form.submit();
    }
</script>

</html>