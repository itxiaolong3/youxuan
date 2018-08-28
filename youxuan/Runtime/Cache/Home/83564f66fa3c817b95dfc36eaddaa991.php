<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/youxuan/youxuan/Public/home/css/hyp.css" />
    <link rel="stylesheet" type="text/css" href="/youxuan/youxuan/Public/home/css/xsyx.css" />
    <link rel="stylesheet" type="text/css" href="/youxuan/youxuan/Public/home/css/order-detail.css" />
    <title>订单详细</title>
</head>
<body>
<div class="header-container">
    <a class="left" onclick="javascript:history.back();">
        <img src="/youxuan/youxuan/Public/home/images/icon/left.png" />
        <span>返回</span>
    </a>
    <div class="middle">订单详细</div>
    <a class="right"></a>
</div>
<div class="detail-container">
    <div class="status" style="background:#FFFDF1;height: 80px;text-align:center;display: flex;padding: 20px 20px 0 20px;justify-content: space-between;">
        <div style="display: flex;">
            <img src="/youxuan/youxuan/Public/home/images/icon/daish.png" width="40" height="40" /><span style="margin-left:5px;size: 25px;color: red;font-weight: bold;">待提货</span>
        </div>
        <span style="color: black;size: 20px;text-align: right;font-weight: bold;">提货单号:<span style="color: red;margin-right: 20px;font-weight: bold;">&nbsp;<?php echo ($goodid); ?></span></span>
    </div>
    <div class="info-container">
        <div class="top">
            <span>收货人：</span>
            <div style="font-weight: bold;"><?php echo ($userinfo["nickname"]); ?>&nbsp;<?php echo ($userinfo["phone"]); ?></div>
        </div>
        <div class="middle">
            提货地点：<?php echo ((isset($shopinfo["daddress"]) && ($shopinfo["daddress"] !== ""))?($shopinfo["daddress"]):"暂无地址"); ?>
        </div>
        <div class="bottom">
            自提点：<?php echo ($shopinfo["dname"]); ?> &nbsp;&nbsp;<?php echo ((isset($shopinfo["dphone"]) && ($shopinfo["dphone"] !== ""))?($shopinfo["dphone"]):"暂无"); ?>
        </div>
    </div>
    <div style="background:#fff;height: 80px;text-align:center;display: flex;padding: 20px 20px 0 20px;justify-content: space-between;">
        <span style="color: black;size: 20px;text-align: right;font-weight: bold;">商品信息:</span>

        <span style="position: relative;top: -0.2rem;"><img src="/youxuan/youxuan/Public/home/images/icon/gotopay.png" width="200px" height="80px;"/></span>


    </div>
    <div class="list-container">
        <?php if(is_array($goods)): foreach($goods as $key=>$v): ?><div class="item" >
                <img class="image" src="/youxuan/youxuan/Public/<?php echo ($v['gooddetail']['gtopimg']); ?>" />
                <div class="info">
                    <div class="top">
                        <input type="hidden" value="<?php echo ($v["id"]); ?>"/>
                        <p class="name"><?php echo ($v['gooddetail']['gtitle']); ?> </p>
                        <p class="describe"><?php echo ($v['gooddetail']['gdes']); ?>&nbsp;&nbsp;&nbsp;<span>x<?php echo ($v["buynum"]); ?></span></p>


                    </div>
                    <div class="bottom">
                        <div class="left"><span>￥</span><?php echo ($v['gooddetail']['gyhprice']); ?>&nbsp;&nbsp;<s>￥<?php echo ($v['gooddetail']['gprice']); ?></s></div>
                        <div class="right"><?php echo ($shopinfo["dendtime"]); ?>&nbsp;&nbsp;16:00提货</div>
                    </div>
                </div>
            </div><?php endforeach; endif; ?>
    </div>
    <div class="price-container" style="margin-bottom: 25px;">
        <p class="top">共计<?php echo ($goodnum); ?>个商品&nbsp;&nbsp;合计：<span>￥<?php echo ($totalprice); ?></span></p>
        <p class="bottom">实付金额：<span>￥<?php echo ($totalprice); ?></span></p>
    </div>
    <div class="orderandtime" style="background-color: #fff;margin-top: 5px;padding-right: 5px;">
        <div class="middle" style="display: block;padding: 8px 0 8px 15px;">
            订单编号：<?php echo ($goods[0]['onumber']); ?>
        </div>
        <div class="middle" style="padding-right:18px;">
            下单时间：<?php echo ($goods[0]['ordertime']); ?>
        </div>
    </div>

</div>


</body>
<script>
    var jsfori=0;
    var  jsforsid=0;
</script>
<script type="text/javascript" src="/youxuan/youxuan/Public/home/js/hyp.js"></script>
<script type="text/javascript" src="/youxuan/youxuan/Public/home/js/xsyx.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
    var getgoodid= [];
    var goodcomment= [];

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
<!--微信分享-->
<script>
    wx.config({
        debug: false, // 开启调试模式
        appId: '<?php echo ($jssdkArr["appId"]); ?>', // 必填，公众号的唯一标识
        timestamp: <?php echo ($jssdkArr['timestamp']); ?>, // 必填，生成签名的时间戳
        nonceStr: '<?php echo ($jssdkArr["nonceStr"]); ?>', // 必填，生成签名的随机串
        signature: '<?php echo ($jssdkArr["signature"]); ?>',// 必填，签名
        jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone'] // 必填，需要使用的JS接口列表
    });

    wx.ready(function(){
        var title = '<?php echo ($fxArr["title"]); ?>'
            ,link = '<?php echo ($fxArr["link"]); ?>'
            ,imgUrl = '<?php echo ($fxArr["imgUrl"]); ?>'
            ,desc = '<?php echo ($fxArr["desc"]); ?>'
            ,type = '<?php echo ($fxArr["type"]); ?>'
            ,dataUrl = '';

        //分享到朋友圈
        wx.onMenuShareTimeline({
            title: title, // 分享标题
            link: link,
            imgUrl: imgUrl, // 分享图标
            success: function () {

            }
        });

        //分享给朋友
        wx.onMenuShareAppMessage({
            title: title, // 分享标题
            desc: desc, // 分享描述
            link: link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: imgUrl, // 分享图标
            type: type, // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {

            }
        });

        //分享到QQ
        wx.onMenuShareQQ({
            title: title, // 分享标题
            desc: desc, // 分享描述
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            success: function () {

            },
            cancel: function () {

            }
        });

        //分享到腾讯微博
        wx.onMenuShareWeibo({
            title: title, // 分享标题
            desc: desc, // 分享描述
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            success: function () {

            },
            cancel: function () {

            }
        });

        //分享到QQ空间
        wx.onMenuShareQZone({
            title: title, // 分享标题
            desc: desc, // 分享描述
            link: link, // 分享链接
            imgUrl: imgUrl, // 分享图标
            success: function () {

            },
            cancel: function () {

            }
        });
    });

    wx.error(function(res){
        alert(JSON.parse(res))
    });

</script>

</html>