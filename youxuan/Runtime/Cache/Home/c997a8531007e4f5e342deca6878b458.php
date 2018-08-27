<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/hyp.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/xsyx.css" />
        <link rel="stylesheet" type="text/css" href="/tp3/youxuan/Public/home/css/cart.css" />
        <title>购物车</title>
    </head>
    <body>
         <div class="header-container">
            <a class="left" href="<?php echo U('Index/index',array('sid'=>$sid));?>">
                <img src="/tp3/youxuan/Public/home/images/icon/left.png" />
                <span>首页</span>
            </a>
            <div class="middle">购物车</div>
            <div class="right">编辑</div>
        </div>
        <div class="list-container">
                <?php if(is_array($goods)): foreach($goods as $key=>$v): ?><div class="item">
                    <div class="checkbox uncheckbox"></div>
                    <img class="image" src="/tp3/youxuan/Public/<?php echo ($v["imgurl"]); ?>" />
                    <div class="info">
                        <div class="top">
                            <input type="hidden" value="<?php echo ($v["id"]); ?>"/>
                            <p class="name"><?php echo ($v["name"]); ?> </p>
                            <p class="describe"><?php echo ($v["gdes"]); ?></p>
                        </div>
                        <div class="bottom">
                            <div class="left"><span>￥</span><?php echo ($v["saleprice"]); ?></div>
                            <div class="right">
                                <a class="minus" onclick="updatenumjian('<?php echo ($v["id"]); ?>','<?php echo ($v["num"]); ?>')">-</a>
                                <div class="count"><?php echo ($v["num"]); ?></div>
                                <a class="plus" onclick="updatanumadd('<?php echo ($v["id"]); ?>','<?php echo ($v["num"]); ?>')">+</a>
                            </div>
                        </div>
                    </div>
                    </div><?php endforeach; endif; ?>
            <div class="no-container hid">
                <img class="no-order" src="/tp3/youxuan/Public/home/images/other/no_ware.png">
            </div>
        </div>
        <div class="footer-container">
            <div id="check" class="left">
                <div class="checkbox uncheckbox"></div>
                <span>全选</span>
            </div>
            <div class="right">
                <div class="price">
                    <span class="text-1">合计：</span>
                    <span class="text-2">￥</span>
                    <span class="text-3">29.9</span>
                </div>
                <a class="btn" onclick="gopay();">立即购买(1)</a>
                <div class="btns hid" onclick="delcat();">删除</div>
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
    var paygoods= [];
    function gopay() {
        if(chooseshop.num==0){
            alert('请选择购买商品');
            return false;
        }else{
            for(var i = 0; i < $(".list-container .item").length; i++){
                if($(".item").eq(i).find('.checkbox').is('.uncheckbox')){
                    var goodid = $(".item").eq(i).find(".info .top input").val();
                    getgoodid.push(goodid);
                    paygoods.push(cart.getoneproduct(goodid,"<?php echo ($sid); ?>"))

                }
            }
            var totalprice=$(".text-3").html();
            console.log(paygoods);
            console.log(getgoodid)
            //开始提交到支付详情界面
            var sid="<?php echo ($sid); ?>";
            var parames = new Array();
            parames.push({ name: "sid", value: sid});
            parames.push({ name: "totalprice", value: totalprice});
            parames.push({ name: "goodtypenums", value: chooseshop.num});
            parames.push({ name: "goods", value: JSON.stringify(paygoods)});
            Post("<?php echo U('Orderdetail/index');?>",parames);
           //window.location.href="<?php echo U('Orderdetail/index',array('sid'=>$sid));?>";
        }
    }
    //删除商品
    var deleid= [];
    function delcat() {
        for(var i = 0; i < $(".list-container .item").length; i++){
            if($(".item").eq(i).find('.checkbox').is('.uncheckbox')){
                var delgid = $(".item").eq(i).find(".info .top input").val();
                console.log(delgid);
                deleid.push(delgid);
                //开始删除商品
                cart.deleteproduct(delgid,"<?php echo ($sid); ?>");
            }
        }
        if(deleid.length==0){
            alert('请选择删除的商品');
            return false;
        }
        console.log(deleid);

    }
    //减
    function updatenumjian(id,num) {
        //alert("id="+id+"num="+num)
        var newnum=Number(num)-Number(1);
        console.log("当前数目"+newnum);
        if(newnum==0){
            if(window.confirm('是否删除该商品？')){
                cart.deleteproduct(id,"<?php echo ($sid); ?>");
                updatadata();
                 return true;
            }else{
                 return false;
            }
            return false;
        }else{
            cart.updateproductnum(id,newnum,"<?php echo ($sid); ?>");
            updatadata();
        }

    }
    //加
    function updatanumadd(id,num) {
        var newnum=Number(num)+Number(1);
        console.log("当前数目"+newnum);
        cart.updateproductnum(id,newnum,"<?php echo ($sid); ?>");
        updatadata();
        return true;
    }
    function updatadata() {
        var getdata= cart.getproductlist("<?php echo ($sid); ?>");
        var sid="<?php echo ($sid); ?>";
        var parames = new Array();
        parames.push({ name: "sid", value: sid});
        parames.push({ name: "shoppingcart", value: JSON.stringify(getdata)});
        Post("",parames);
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