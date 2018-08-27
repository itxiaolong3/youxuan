<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/hyp.css" />
    <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/xsyx.css" />
    <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/order-detail.css" />
    <title>确认订单</title>
</head>
<body>
<div class="header-container">
    <a class="left" onclick="javascript:history.back();">
        <img src="/tp3/youxuan/Public/home/images/icon/left.png" />
        <span>返回</span>
    </a>
    <div class="middle">确认订单</div>
    <a class="right"></a>
</div>
<div class="detail-container">
    <div class="info-container">
        <div class="top">
            <span>收货人：</span>
            <input placeholder="联系人" value="<?php echo ($userinfo["nickname"]); ?>" name="nickname" id="username" />
            <input placeholder="手机号码" value="<?php echo ($userinfo["phone"]); ?>"  name="phone" id="userphone"/>
        </div>
        <div class="middle">
            提货地点：<?php echo ((isset($shopinfo["daddress"]) && ($shopinfo["daddress"] !== ""))?($shopinfo["daddress"]):"暂无地址"); ?>
        </div>
        <div class="bottom">
            自提点：<?php echo ($shopinfo["dname"]); ?> &nbsp;&nbsp;<?php echo ((isset($shopinfo["dphone"]) && ($shopinfo["dphone"] !== ""))?($shopinfo["dphone"]):"暂无"); ?>
        </div>
    </div>
    <div class="list-container">
        <?php if($onegoodsize == 1): ?><div class="item">
                <img class="image" src="/tp3/youxuan/Public/<?php echo ($onegood["imgurl"]); ?>" />
                <div class="info">
                    <div class="top">
                        <input type="hidden" value="<?php echo ($onegood["id"]); ?>"/>
                        <p class="name"><?php echo ($onegood["name"]); ?> </p>
                        <p class="describe"><?php echo ($onegood["gdes"]); ?>&nbsp;&nbsp;&nbsp;<span>x<?php echo ($onegood["num"]); ?></span></p>
                        <div class="comment" >
                            <input type="hidden"  value="<?php echo ($onegood["name"]); ?> x <?php echo ($onegood["num"]); ?>">
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="left"><span>￥</span><?php echo ($onegood["saleprice"]); ?>&nbsp;&nbsp;<s>￥<?php echo ($onegood["gprice"]); ?></s></div>
                        <div class="right"><?php echo ($shopinfo["dendtime"]); ?>&nbsp;&nbsp;16:00提货</div>
                    </div>
                </div>
            </div>

            <?php else: ?>
            <?php if(is_array($goods)): foreach($goods as $key=>$v): ?><div class="item">
                    <img class="image" src="/tp3/youxuan/Public/<?php echo ($v["imgurl"]); ?>" />
                    <div class="info">
                        <div class="top">
                            <input type="hidden" value="<?php echo ($v["id"]); ?>"/>
                            <p class="name"><?php echo ($v["name"]); ?> </p>
                            <p class="describe"><?php echo ($v["gdes"]); ?>&nbsp;&nbsp;&nbsp;<span>x<?php echo ($v["num"]); ?></span></p>
                            <div class="comment" >
                                <input type="hidden"  value="<?php echo ($v["name"]); ?> x <?php echo ($v["num"]); ?>">
                            </div>

                        </div>
                        <div class="bottom">
                            <div class="left"><span>￥</span><?php echo ($v["saleprice"]); ?>&nbsp;&nbsp;<s>￥<?php echo ($v["gprice"]); ?></s></div>
                            <div class="right"><?php echo ($shopinfo["dendtime"]); ?>&nbsp;&nbsp;16:00提货</div>
                        </div>
                    </div>
                </div><?php endforeach; endif; endif; ?>

        <!--<div class="item">-->
        <!--<img class="image" src="/tp3/youxuan/Public/home/images/other/ware_2.jpg" />-->
        <!--<div class="info">-->
        <!--<div class="top">-->
        <!--<p class="name">葡萄 2至3个/份 约2至2.5斤</p>-->
        <!--<p class="describe">2至3个&nbsp;&nbsp;<span>x1</span></p>-->
        <!--</div>-->
        <!--<div class="bottom">-->
        <!--<div class="left"><span>￥</span>29.9&nbsp;&nbsp;<s>￥38.8</s></div>-->
        <!--<div class="right">06月29号&nbsp;&nbsp;16:00提货</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
    </div>
    <div class="price-container">
        <?php if($onegoodsize == 1): ?><p class="top">共计1个商品&nbsp;&nbsp;合计：<span>￥<?php echo ($onegood["totalprice"]); ?></span></p>
            <p class="bottom">应付金额：<span>￥<?php echo ($onegood["totalprice"]); ?></span></p>
            <?php else: ?>
            <p class="top">共计<?php echo ($goodtypenums); ?>个商品&nbsp;&nbsp;合计：<span>￥<?php echo ($totalprice); ?></span></p>
            <p class="bottom">应付金额：<span>￥<?php echo ($totalprice); ?></span></p><?php endif; ?>
    </div>
</div>
<div class="footer-container">
    <div class="left">
        <span class="text-1">合计：</span>
        <span class="text-2">￥</span>
        <?php if($onegoodsize == 1): ?><span class="text-4"><?php echo ($onegood["totalprice"]); ?></span>
            <?php else: ?>
            <span class="text-4"><?php echo ($totalprice); ?></span><?php endif; ?>

    </div>
    <div class="right">立即支付</div>
</div>

<div id="mask" class="mask mask-out"></div>
<div class="flex hid">
    <div class="flex-head">此商品需要您到店自提，请仔细确认地址！</div>
    <div class="flex-foot">
        <p>提货地址：<span><?php echo ((isset($shopinfo["daddress"]) && ($shopinfo["daddress"] !== ""))?($shopinfo["daddress"]):"暂无地址"); ?></span></p>
        <p>（自提点：<?php echo ($shopinfo["dname"]); ?> <?php echo ((isset($shopinfo["dphone"]) && ($shopinfo["dphone"] !== ""))?($shopinfo["dphone"]):"暂无"); ?>）</p>
        <h4><?php echo ($shopinfo["dendtime"]); ?> 16:00提货</h4>
        <div class="flex-btn">
            <div class="flex-btns">取消付款</div>
            <div class="flex-btns"><a onclick="pay();">确认订单</a></div>
        </div>
    </div>
</div>
</body>
<script>
    var jsfori=0;
    var  jsforsid=0;
</script>
<script type="text/javascript" src="/tp3/youxuan/Public/home/js/hyp.js"></script>
<script type="text/javascript" src="/tp3/youxuan/Public/home/js/xsyx.js"></script>
<script>
    var getgoodid= [];
    var goodcomment= [];
    function pay() {
        for(var i = 0; i < $(".list-container .item").length; i++){
            var goodid = $(".item").eq(i).find(".info .top input").val();
            var comment = $(".item").eq(i).find(".info .top .comment input").val();
            getgoodid.push(goodid);
            goodcomment.push(comment);
        }
        if("<?php echo ($onegoodsize); ?>"==1){
            totalprice="<?php echo ($onegood["totalprice"]); ?>";
        }else{
            totalprice="<?php echo ($totalprice); ?>";
        }
        username=$("#username").val();
        userphone=$("#userphone").val();
        //提交数据到确认支付页面并保存订单
        var sid="<?php echo ($sid); ?>";
        var parames = new Array();
        parames.push({ name: "sid", value: sid});
        parames.push({ name: "username", value: username});
        parames.push({ name: "userphone", value: userphone});
        parames.push({ name: "totalprice", value: totalprice});
        parames.push({ name: "goodid", value: JSON.stringify(getgoodid)});
        parames.push({ name: "goodcomment", value: JSON.stringify(goodcomment)});
        //删除购物车的数据
        for(var i=0;i<getgoodid.length;i++){
            cart.deleteproduct(getgoodid[i],sid)
        }
        if (username==''||userphone==''){
            alert('手机或者收货人不可为空');
            return false;
        }else{
            Post("<?php echo U('Pay/index');?>",parames);
        }


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