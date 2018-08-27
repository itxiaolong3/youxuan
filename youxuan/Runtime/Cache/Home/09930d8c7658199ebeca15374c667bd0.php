<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/xsyx.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/index.css" />
        <title>首页</title>
    </head>
    <body>
        <img class="banner" src="/tp3/youxuan/Public/home/images/other/banner.jpg" />
        <div class="index-container">
            <div class="header-container">
                <div class="search">
                    <img src="/tp3/youxuan/Public/home/images/icon/search.png" />
                    <input placeholder="输入手机号 / 订单号 / 提单号查询" />
                </div>
                <div class="info">
                    <img class="left" width="50" height="50" src="/tp3/youxuan/Public/<?php echo ($shopinfo["dheaderimg"]); ?>" />
                    <div class="middle">
                        <p><?php echo ($shopinfo["dphone"]); ?></p>
                        <p><?php echo ($shopinfo["dname"]); ?></p>
                        <p class="sign"><?php echo ($shopinfo["dsign"]); ?></p>
                    </div>
                    <div class="right">
                        <p class="title-1">粉丝数</p>
                        <p class="count"><?php echo ($usernum); ?></p>
                        <p class="title-2">购买指数</p>
                        <p class="count"><?php echo ($ordernum); ?></p>
                    </div>
                </div>
            </div>
            <?php if(is_array($goodsinfo)): foreach($goodsinfo as $key=>$v): ?><div class="goods-container">
                <div class="header">本商品由<?php echo ($v["gboss"]); ?>专供</div>
                <a href="<?php echo U('Waredetail/index');?>?sid=<?php echo ($sid); ?>&gid=<?php echo ($v["gid"]); ?>">
                    <img class="image" src="/tp3/youxuan/Public/<?php echo ($v["gtopimg"]); ?>" />
                </a>
                <div style="padding: 0 0.2667rem;">
                    <div class="container-1">
                        <a class="top" href="<?php echo U('Waredetail/index',array('sid'=>$sid,'gid'=>$v[gid]));?>">
                            <?php echo ($v["gtitle"]); ?>
                        </a>
                        <dix class="bottom">
                            <div class="left">
                                <span>￥</span><?php echo ($v["gyhprice"]); ?>&nbsp;&nbsp;<s>￥<?php echo ($v["gprice"]); ?></s>
                            </div>
                            <div class="right">
                                已售 <span><?php echo ((isset($v["salenum"]) && ($v["salenum"] !== ""))?($v["salenum"]):0); ?></span> 份/ 限量<?php echo ($v["gendnum"]); ?>份
                            </div>
                        </dix>
                    </div>
                    <div class="container-2">
                        <div class="left">
                            <p style="margin-bottom: 0.2rem;">预售时间：<span><?php echo ($shopinfo["dpretime"]); ?></span></p>
                            <p>提货时间：<span><?php echo ($shopinfo["dendtime"]); ?></span></p>
                        </div>
                        <div class="right" onclick="addcat('<?php echo ($v["gid"]); ?>','<?php echo ($v["gtopimg"]); ?>','<?php echo ($v["gtitle"]); ?>','<?php echo ($v["gdes"]); ?>','<?php echo ($v["gyhprice"]); ?>','<?php echo ($v["gprice"]); ?>','<?php echo ($sid); ?>')">加入购物车</div>
                    </div>
                    <div class="container-3">
                        <?php if(is_array($v["userinfo"])): foreach($v["userinfo"] as $key=>$vv): ?><!--头像到时需要去掉public-->
                            <img src="<?php echo ($vv["headerimg"]); ?>"/><?php echo ($vv["nickname"]); endforeach; endif; ?>

                            <span>&nbsp;等刚购买此商品</span>
                    </div>
                </div>
            </div><?php endforeach; endif; ?>
        </div>
        <div class="footer-container">
            <a class="cart" onclick="postcartdata();">
                <img src="/tp3/youxuan/Public/home/images/other/cart.png" />
                <p class="count hid">0</p>
            </a>
            <div class="tab">
                <img src="/tp3/youxuan/Public/home/images/icon/home.png" />
                <p style="color: #e70012;">首页</p>
            </div>
            <a class="tab" href="<?php echo U('My/index',array('sid'=>$sid));?>">
                <img src="/tp3/youxuan/Public/home/images/icon/my.png" />
                <p>我的</p>
            </a>
        </div>
    </body>
    <script>
        var jsfori=0;
        var jsforsid="<?php echo ($sid); ?>";
    </script>
    <script>

        function addcat(gid,gtopimg,gtitle,gdes,gyhprice,gprice,sid) {
            //保存的数据
            product={
                id:gid,
                name:gtitle,
                num:1,
                gdes:gdes,
                saleprice:gyhprice,
                gprice:gprice,
                imgurl:gtopimg,
                sid:sid
            };
            cart.addproduct(product);
           var getdata= cart.getproductlist("<?php echo ($sid); ?>");
           //console.log(JSON.stringify(getdata));
        }
        function postcartdata() {
            var sid="<?php echo ($sid); ?>";
            var getdata= cart.getproductlist(sid);
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
    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/hyp.js"></script>
    <script type="text/javascript" src="/tp3/youxuan/Public/home/js/xsyx.js"></script>


</html>