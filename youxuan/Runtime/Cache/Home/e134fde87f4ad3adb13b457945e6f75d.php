<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/xsyx.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/order.css" />
        <title>查看订单</title>
    </head>
    <body>
        <div class="header-container">
            <a class="left" onclick="javascript:history.back();">
                <img src="/tp3/youxuan/Public/home/images/icon/left.png" />
                <span>返回</span>
            </a>
            <div class="middle">查看订单</div>
            <a class="right" href="<?php echo U('Index/index');?>">首页</a>
        </div>
        <div class="nav-container">
            <div class="nav" style="color: #e70012;">全部</div>
            <div class="nav">未付款</div>
            <div class="nav">待提货</div>
            <div class="nav">已提货</div>
        </div>
        <!--全部订单-->
        <div class="list-container2">
            <?php if($allinfosize == 0): ?><div style="height: 100%;background-color: #fff;">
                    <img style="position: absolute;top: 0;right: 0;left: 0;bottom: 0;margin: auto;width: 6.0rem;height: 6.0rem;" class="no-order" src="/tp3/youxuan/Public/home/images/other/no_order.png" />
                </div>
                <?php else: ?>
                <?php if(is_array($allorderinfo)): foreach($allorderinfo as $key=>$v): ?><div class="item">
                        <div class="title">
                            <p>订单编号：<?php echo ($v["onumber"]); ?></p>
                            <?php if($v["ostatus"] == 0): ?><p style="color: #e70012;">待付款</p>
                                <?php elseif($v["ostatus"] == 1): ?>
                                <p style="color: #e70012;">待提货</p>
                                <?php else: ?>
                                <p style="color: #e70012;">已提货</p><?php endif; ?>
                        </div>
                        <div class="info-1">
                            <div class="left"><img src="/tp3/youxuan/Public/<?php echo ($v["gtopimg"]); ?>" width="183" height="182" /></div>
                            <div class="right">
                                <div class="name"><?php echo ($v["gtitle"]); ?> <?php echo ($v["gdes"]); ?></div>
                                <div class="bottom">
                                    <p style="color: #e70012;">￥<?php echo ($v["gyhprice"]); ?></p>
                                    <p><?php echo ($v["onum"]); ?>个</p>
                                </div>
                            </div>
                        </div>
                        <div class="info-2">
                            <div class="left">
                                <p>提单号：<span style="color: #e70012;"><?php echo ($v["oid"]); ?></span></p>
                                <p style="margin-top: 0.2667rem;"><?php echo ($v["oaddtime"]); ?></p>
                            </div>
                            <?php if($v["ostatus"] == 0): ?><div class="right" onclick="gotopay('<?php echo ($v["oid"]); ?>','<?php echo ($v["ogid"]); ?>','<?php echo ($v["gyhprice"]); ?>','<?php echo ($v["onumber"]); ?>','<?php echo ($v["onum"]); ?>');">去付款</div>
                                <?php elseif($v["ostatus"] == 1): ?>
                                <div class="right" onclick="comfin('<?php echo ($v["oid"]); ?>',2,'<?php echo ($v["onum"]); ?>')">确认提货</div>
                                <?php else: ?>
                                <div class="right disable">已完成</div><?php endif; ?>

                        </div>
                    </div><?php endforeach; endif; endif; ?>
        </div>
        <!--待付款-->
        <div class="list-container2">
            <?php if($nopaysize == 0): ?><div style="height: 100%;background-color: #fff;">
                    <img style="position: absolute;top: 0;right: 0;left: 0;bottom: 0;margin: auto;width: 6.0rem;height: 6.0rem;" class="no-order" src="/tp3/youxuan/Public/home/images/other/no_order.png" />
                </div>
                <?php else: ?>
                <?php if(is_array($nopayinfo)): foreach($nopayinfo as $key=>$v): ?><div class="item">
                        <div class="title">
                            <p>订单编号：<?php echo ($v["onumber"]); ?></p>
                                <p style="color: #e70012;">待付款</p>
                        </div>
                        <div class="info-1">
                            <div class="left"><img src="/tp3/youxuan/Public/<?php echo ($v["gtopimg"]); ?>" width="183" height="182" /></div>
                            <div class="right">
                                <div class="name"><?php echo ($v["gtitle"]); ?> <?php echo ($v["gdes"]); ?></div>
                                <div class="bottom">
                                    <p style="color: #e70012;">￥<?php echo ($v["gyhprice"]); ?></p>
                                    <p><?php echo ($v["onum"]); ?>个</p>
                                </div>
                            </div>
                        </div>
                        <div class="info-2">
                            <div class="left">
                                <p>提单号：<span style="color: #e70012;"><?php echo ($v["oid"]); ?></span></p>
                                <p style="margin-top: 0.2667rem;"><?php echo ($v["oaddtime"]); ?></p>
                            </div>
                            <div class="right" onclick="gotopay('<?php echo ($v["oid"]); ?>','<?php echo ($v["ogid"]); ?>','<?php echo ($v["gyhprice"]); ?>','<?php echo ($v["onumber"]); ?>','<?php echo ($v["onum"]); ?>');">去付款</div>
                        </div>
                    </div><?php endforeach; endif; endif; ?>
        </div>
        <!--待提货-->
        <div class="list-container2">
            <?php if($paysize == 0): ?><div style="height: 100%;background-color: #fff;">
                    <img style="position: absolute;top: 0;right: 0;left: 0;bottom: 0;margin: auto;width: 6.0rem;height: 6.0rem;" class="no-order" src="/tp3/youxuan/Public/home/images/other/no_order.png" />
                </div>
                <?php else: ?>
                <?php if(is_array($payinfo)): foreach($payinfo as $key=>$v): ?><div class="item">
                        <div class="title">
                            <p>订单编号：<?php echo ($v["onumber"]); ?></p>
                            <p style="color: #e70012;">待提货</p>
                        </div>
                        <div class="info-1">
                            <div class="left"><img src="/tp3/youxuan/Public/<?php echo ($v["gtopimg"]); ?>" width="183" height="182" /></div>
                            <div class="right">
                                <div class="name"><?php echo ($v["gtitle"]); ?> <?php echo ($v["gdes"]); ?></div>
                                <div class="bottom">
                                    <p style="color: #e70012;">￥<?php echo ($v["gyhprice"]); ?></p>
                                    <p><?php echo ($v["onum"]); ?>个</p>
                                </div>
                            </div>
                        </div>
                        <div class="info-2">
                            <div class="left">
                                <p>提单号：<span style="color: #e70012;"><?php echo ($v["oid"]); ?></span></p>
                                <p style="margin-top: 0.2667rem;"><?php echo ($v["oaddtime"]); ?></p>
                            </div>
                            <div class="right" onclick="comfin('<?php echo ($v["oid"]); ?>',2,'<?php echo ($v["onum"]); ?>')">确认提货</div>
                        </div>
                    </div><?php endforeach; endif; endif; ?>
        </div>
        <!--已提货-->
        <div class="list-container2">
            <?php if($finishesize == 0): ?><div style="height: 100%;background-color: #fff;">
                    <img style="position: absolute;top: 0;right: 0;left: 0;bottom: 0;margin: auto;width: 6.0rem;height: 6.0rem;" class="no-order" src="/tp3/youxuan/Public/home/images/other/no_order.png" />
                </div>
                <?php else: ?>
                <?php if(is_array($finisheorderinfo)): foreach($finisheorderinfo as $key=>$v): ?><div class="item">
                        <div class="title">
                            <p>订单编号：<?php echo ($v["onumber"]); ?></p>
                            <p style="color: #e70012;">已提货</p>
                        </div>
                        <div class="info-1">
                            <div class="left"><img src="/tp3/youxuan/Public/<?php echo ($v["gtopimg"]); ?>" width="183" height="182" /></div>
                            <div class="right">
                                <div class="name"><?php echo ($v["gtitle"]); ?> <?php echo ($v["gdes"]); ?></div>
                                <div class="bottom">
                                    <p style="color: #e70012;">￥<?php echo ($v["gyhprice"]); ?></p>
                                    <p><?php echo ($v["onum"]); ?>个</p>
                                </div>
                            </div>
                        </div>
                        <div class="info-2">
                            <div class="left">
                                <p>提单号：<span style="color: #e70012;"><?php echo ($v["oid"]); ?></span></p>
                                <p style="margin-top: 0.2667rem;"><?php echo ($v["oaddtime"]); ?></p>
                            </div>
                            <div class="right" style="background-color: #dadada;color: white;border: none;">完成订单</div>
                        </div>
                    </div><?php endforeach; endif; endif; ?>
        </div>
    </body>
    <script>
        jsfori="<?php echo ($i); ?>";
        var  jsforsid=0;
    </script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/hyp.js"></script>

    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/xsyx.js"></script>
    <script>
        var geti="<?php echo ($i); ?>";
        console.log(geti);
        //个人中心的我的订单切换
        var orderi = geti;
        $(".nav").eq(orderi).css('color', '#e70012').siblings().css('color', '#666');
        if(orderi == 0){
            $(".list-container2").removeClass('hid');
            $(".no-container1").addClass('hid');
            $(".no-container2").addClass('hid');
            $(".no-container3").addClass('hid');
        }else if(orderi==1){
            $(".no-container1").removeClass('hid');
            $(".list-container2").addClass('hid');
            $(".no-container2").addClass('hid');
            $(".no-container3").addClass('hid');
        }else if(orderi==2){
            $(".no-container2").removeClass('hid');
            $(".list-container2").addClass('hid');
            $(".no-container1").addClass('hid');
            $(".no-container3").addClass('hid');
        }else if(orderi==3){
            $(".no-container3").removeClass('hid');
            $(".list-container2").addClass('hid');
            $(".no-container1").addClass('hid');
            $(".no-container2").addClass('hid');
        }
        //'<?php echo ($v["oid"]); ?>','<?php echo ($v["gtopimg"]); ?>','<?php echo ($v["gtitle"]); ?>','<?php echo ($v["gyhprice"]); ?>','<?php echo ($v["onum"]); ?>'
        function gotopay(oid,ogid,gyhprice,onumber,numinfo) {
            //alert(gyhprice);
            //alert(oid);
            var sid="<?php echo ($sid); ?>";
            var parames = new Array();
            parames.push({ name: "sid", value: sid});
            parames.push({ name: "oid", value: oid});
            parames.push({ name: "onumber", value: onumber});
            parames.push({ name: "totalprice", value: gyhprice});
            parames.push({ name: "numinfo", value: numinfo});
            //删除购物车的数据
            //cart.deleteproduct(ogid,sid);
            Post("<?php echo U('Pay/index');?>",parames);
        }
        function comfin(oid,status,onum) {
            if(window.confirm('是否确认收货？')){
                $.post(
                    "<?php echo U('Order/updatastatus');?>",
                    {'oid':oid,
                      'status':status,
                        'onum':onum
                    },function (e) {
                        e=JSON.parse(e);
                        if(e.code==0){
                            window.location.reload();
                        }else{
                            alert('确认失败！');
                        }
                    }
                );
                return true;
            }else{
                return false;
            }

        }
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