<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/hyp.css" />
    <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/xsyx.css" />
    <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/pay.css" />
    <title>在线支付</title>
    <script type="text/javascript">
        //调用微信JS api 支付
        function callpay()
        { //alert("<?php echo U('Pay/postpay');?>");
         
            $.post("<?php echo U('Pay/postpay');?>",
                {
                    'shop_name':"<?php echo ($shop_name); ?>",
                    'total_fee':"<?php echo ($total_fee); ?>",
                    'out_trade_no':"<?php echo ($out_trade_no); ?>",
                    'sid':"<?php echo ($sid); ?>"

                },function(e){
               console.log(e)
                    e = JSON.parse(e)
      			
                   if(e.code == 0){
                       // window.history.pushState({},0,'http://'+window.location.host);
                        function onBridgeReady(){
                            WeixinJSBridge.invoke(
                                'getBrandWCPayRequest', e,
                                function(res){
                                    if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                                        //   //支付成功，延迟3秒跳转到订单详情页面
                                        window.location.href="<?php echo ($success_url); ?>";
                                    }else{
                                        alert('支付失败');
                                        history.go(-2);
                                    }
                                }
                            );
                        }
                        if (typeof WeixinJSBridge == "undefined"){
                            if( document.addEventListener ){
                                document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
                            }else if (document.attachEvent){
                                document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                                document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
                            }
                        }else{
                            onBridgeReady();
                        }


                    }
                });
        }

    </script>
</head>
<body>
<div class="header-container">
    <a class="left" onclick="javascript:history.back();">
        <img src="/tp3/youxuan/Public/home/images/icon/left.png" />
        <span>返回</span>
    </a>
    <div class="middle">在线支付</div>
    <a class="right"></a>
</div>
<div class="top-container">
    <p class="text-1">订单金额：<span class="sign">￥</span><span class="price"><?php echo ($total_fee/100); ?></span></p>
    <p class="text-2">订单提交成功，请在<span style="color: #f00;">30</span>分钟内完成支付。</p>
</div>
<img class="wxpay" src="/tp3/youxuan/Public/home/images/other/pay_2.jpg" />
<a class="btn-container"  onclick="callpay();">去付款</a>
<script>
    var jsfori=0;
    var  jsforsid=0;
</script>
<script type="text/javascript" src="/tp3/youxuan/Public/home/js/hyp.js"></script>
<script type="text/javascript" src="/tp3/youxuan/Public/home/js/xsyx.js"></script>
</body>
</html>