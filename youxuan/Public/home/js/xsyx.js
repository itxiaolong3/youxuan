//自动消失顶部提示
function show_tip(text) {
    $('<div>').appendTo('body').addClass('tip').html(text).show().delay(1500).fadeOut();
}

$(function(){
    //返回顶部
    $(window).scroll(function(event) {
        if($(document).scrollTop() <= 100){
            $('.totop').hide(100);
        }
        if($(document).scrollTop() > 100){
            $('.totop').show(100);
        }
    });
    $('.totop').on('click',function(){
        $('html,body').stop(true).animate({scrollTop:0}, 500);
    })
    //保存购物车记录的js
    //这里的方法基本都加了一个sid 这个是店铺id ，区分不同店铺的数据，别的项目估计用不到，请灵活使用
    utils = {
        setParam : function (name,value,sid){
            //var uid = gid;
            // name = name + '_' + uid;
            name = name+sid;
            //console.log("set_" + name);
            value= value.replace(/\s+/g,"");
            localStorage.setItem(name,value);
        },
        getParam : function(name,sid){
            //var uid = gid;
            //name = name + '_' + uid;
            name = name+sid ;
            //console.log("get_" + name);
            return localStorage.getItem(name);
        }
    };
    orderdetail={
        username:"",
        phone:"",
        address:"",
        zipcode:"",
        totalNumber:0,
        totalAmount:0.00
    };
    cart = {
        //向购物车中添加商品
        addproduct: function (product) {
            var ShoppingCart = utils.getParam("ShoppingCart",product.sid);
            if (ShoppingCart == null || ShoppingCart == "") {
                //第一次加入商品
                var jsonstr = { "productlist": [{ "id": product.id, "name": product.name, "imgurl":product.imgurl, "gprice":product.gprice, "num": product.num, "gdes": product.gdes, "saleprice": product.saleprice}], "totalNumber": product.num, "totalAmount": (product.saleprice * product.num) };
                utils.setParam("ShoppingCart", "'" + JSON.stringify(jsonstr),product.sid);
            } else {
                var jsonstr = JSON.parse(ShoppingCart.substr(1, ShoppingCart.length));
                var productlist = jsonstr.productlist;
                var result = false;
                //查找购物车中是否有该商品
                for (var i in productlist) {
                    if (productlist[i] != null){
                        if (productlist[i].id == product.id) {
                            productlist[i].num = parseInt(productlist[i].num) + parseInt(product.num);
                            result = true;
                        }
                    }
                }
                //没有该商品就直接加进去
                if (!result) {
                    productlist.push({ "id": product.id, "name": product.name,"imgurl": product.imgurl,"gprice":product.gprice, "num": product.num, "gdes": product.gdes, "saleprice": product.saleprice });
                }
                //重新计算总价
                jsonstr.totalNumber = parseInt(jsonstr.totalNumber) + parseInt(product.num);
                jsonstr.totalAmount = parseFloat(jsonstr.totalAmount) + (parseInt(product.num) * parseFloat(product.saleprice));
                orderdetail.totalNumber = jsonstr.totalNumber;
                orderdetail.totalAmount = jsonstr.totalAmount;
                //保存购物车
                utils.setParam("ShoppingCart", "'" + JSON.stringify(jsonstr),product.sid);
            }
        },
        //修改购买商品数量
        updateproductnum: function (id, num,sid) {
            var ShoppingCart = utils.getParam("ShoppingCart",sid);
            var jsonstr = JSON.parse(ShoppingCart.substr(1, ShoppingCart.length));
            var productlist = jsonstr.productlist;

            for (var i in productlist) {
                if (productlist[i].id == id) {
                    jsonstr.totalNumber = parseInt(jsonstr.totalNumber) + (parseInt(num) - parseInt(productlist[i].num));
                    jsonstr.totalAmount = parseFloat(jsonstr.totalAmount) + ((parseInt(num) * parseFloat(productlist[i].saleprice)) - parseInt(productlist[i].num) * parseFloat(productlist[i].saleprice));
                    productlist[i].num = parseInt(num);
                    orderdetail.totalNumber = jsonstr.totalNumber;
                    orderdetail.totalAmount = jsonstr.totalAmount;
                    utils.setParam("ShoppingCart", "'" + JSON.stringify(jsonstr),sid);
                    return;
                }
            }
        },
        //获取购物车中的所有商品
        getproductlist: function (sid) {
            var ShoppingCart = utils.getParam("ShoppingCart",sid);
            if(ShoppingCart==null||ShoppingCart==''){
                console.log('购物车的数据为'+ShoppingCart);
            }else{
                if(ShoppingCart){
                    var jsonstr = JSON.parse(ShoppingCart.substr(1, ShoppingCart.length));//如果购物车没有商品会报错;??????但照样可以用;
                    var productlist = jsonstr.productlist;
                    orderdetail.totalNumber = jsonstr.totalNumber;
                    orderdetail.totalAmount = jsonstr.totalAmount;
                    return productlist;
                }else{
                    return;
                }
            }
            //console.log(ShoppingCart);

        },
        //获取某商品
        getoneproduct: function (id,sid) {
            var result = false;
            var ShoppingCart = utils.getParam("ShoppingCart",sid);
            if (ShoppingCart != null) {
                var jsonstr = JSON.parse(ShoppingCart.substr(1, ShoppingCart.length));
                var productlist = jsonstr.productlist;
                for (var i in productlist) {
                    if (productlist[i].id == id) {
                        result = productlist[i];
                    }
                }
            }
            return result;
        },
        //获取某商品数量
        getoneproductnum: function (id,sid) {
            var result = false;
            var ShoppingCart = utils.getParam("ShoppingCart",sid);
            if (ShoppingCart != null) {
                var jsonstr = JSON.parse(ShoppingCart.substr(1, ShoppingCart.length));
                var productlist = jsonstr.productlist;
                for (var i in productlist) {
                    if (productlist[i].id == id) {
                        result = productlist[i]['num'];
                    }
                }
            }
            return result;
        },
        //判断购物车中是否存在商品
        existproduct: function (id,sid) {
            var result = false;
            var ShoppingCart = utils.getParam("ShoppingCart",sid);
            if (ShoppingCart != null) {
                var jsonstr = JSON.parse(ShoppingCart.substr(1, ShoppingCart.length));
                var productlist = jsonstr.productlist;
                for (var i in productlist) {
                    if (productlist[i].id == id) {
                        result = true;
                    }
                }
            }
            return result;
        },

        //删除购物车中商品
        deleteproduct: function (id,sid) {
            var ShoppingCart = utils.getParam("ShoppingCart",sid);
           if(ShoppingCart==null||ShoppingCart==''){
               console.log('删除购物车的'+ShoppingCart);
           }else{
               console.log('删除购物车中的数量不为空');
               var jsonstr = JSON.parse(ShoppingCart.substr(1, ShoppingCart.length));
               var productlist = jsonstr.productlist;
               var list = [];
               for (var i in productlist) {
                   if (productlist[i]){
                       if (productlist[i].id == id) {
                           jsonstr.totalNumber = parseInt(jsonstr.totalNumber) - parseInt(productlist[i].num);
                           jsonstr.totalAmount = parseFloat(jsonstr.totalAmount) - parseInt(productlist[i].num) * parseFloat(productlist[i].saleprice);
                       } else {
                           if(productlist[i].id){
                               list.push(productlist[i]);
                           }
                       }
                   }
               }
               jsonstr.productlist = list;
               orderdetail.totalNumber = jsonstr.totalNumber;
               orderdetail.totalAmount = jsonstr.totalAmount;
               utils.setParam("ShoppingCart", "'" + JSON.stringify(jsonstr),sid);
           }

        },
        //获取购物车中商品数量
        getproducttotalnum: function (sid) {
            var ShoppingCart = utils.getParam("ShoppingCart",sid);
            if(ShoppingCart==null||ShoppingCart==''){
                console.log('购物车的数据为'+ShoppingCart);
            }else{
                if (ShoppingCart){
                    var jsonstr = JSON.parse(ShoppingCart.substr(1, ShoppingCart.length));
                    var productlist = jsonstr.productlist;
                    return jsonstr.totalNumber;
                }else{
                    return 0;
                }
            }
        },
        //获取购物车中商品总价
        getproducttotalAmount: function (sid) {
            var ShoppingCart = utils.getParam("ShoppingCart",sid);
            if(ShoppingCart==null||ShoppingCart==''){
                console.log('购物车的数据为'+ShoppingCart);
            }else{
                if (ShoppingCart){
                    var jsonstr = JSON.parse(ShoppingCart.substr(1, ShoppingCart.length));
                    // var productlist = jsonstr.productlist;
                    return jsonstr.totalAmount;
                }else{
                    return 0;
                }
            }

        },

        //清除购物车某商品
        clearshoppingcar: function (){
            localStorage.clear();
        }

    };
    ///保存购物车记录的js结束
    getnum=cart.getproducttotalnum(jsforsid);
    chooseshop={
        num:0
    }
    $(".footer-container .count").html(getnum);
    if($(".footer-container .count").html() == 0){
        $(".footer-container .count").addClass('hid');
    }else{
        $(".footer-container .count").removeClass('hid');
    }
    // 二维码点击显示隐藏
    $("#ewm,.footer-container .right").on("click",function(){
        $("#mask").addClass('mask-in').removeClass('mask-out');
        $("#dialog-container").removeClass('hid');
        $(".flex").removeClass('hid');
    });
    $("#mask,.flex-btns").on("click",function(){
        $("#mask").addClass('mask-out').removeClass('mask-in');
        $("#dialog-container").addClass('hid');
        $(".flex").addClass('hid');
    });

    // order控制选项卡
    // var i = "{$i}";
    // console.log(geti+'--');

    // var i = get_param('i');
/*
    //商品详情轮播图
    var ul = $("#banner-ul");
    var li = $("#banner-ul li");
    var div = $(".detail-container .cover").width();//屏宽
    li.width(div);//li和屏幕等宽
    ul.width(div*(ul.find(li).size()));//自动计算ul宽度
    //左右滑动翻页
    ul.on('touchstart', function (e) {
        //touchstart事件
        // var $tb = $(this);
        var startX = e.originalEvent.touches[0].clientX,//手指触碰屏幕的x坐标
            pullDeltaX = 0;
        li.on('touchmove', function (e) {
            //touchmove事件
            var x = e.originalEvent.touches[0].clientX;//手指移动后所在的坐标
            pullDeltaX = x - startX;//移动后的位移
            if (!pullDeltaX){
                return;
            }
            // ul.css('left', -div * $(this).index() + pullDeltaX + 'px');
            e.preventDefault();//阻止手机浏览器默认事件
        });
        li.on('touchend', function (e) {
            //touchend事件
            li.off('touchmove touchend');//解除touchmove和touchend事件
            //所要执行的代码
            e.stopPropagation();

            //判断移动距离是否大于30像素
            if (pullDeltaX > 30 && $(this).index()+1 > 1){
                console.log($(this).index())

                //右滑，往前翻所执行的代码
                ul.animate({'left': -div * ($(this).index() -1) + 'px'}, 500)
                $("#dot li").eq($(this).index()-1).addClass('current').siblings().removeClass('current');
            }
            //判断当前页面是否为最后一页
            else if (pullDeltaX < -30 && $(this).index() +1 < ul.find(li).size()){

                //左滑，往后翻所执行的代码
                ul.animate({'left': -div * ($(this).index() + 1) + 'px'}, 500)
                $("#dot li").eq($(this).index()+1).addClass('current').siblings().removeClass('current');
            }
        });
    });

    $("#dot li").eq(0).addClass('current');
    if($("#dot li").length <= 1){
        $("#dot").hide();
    }
*/
    //验证码倒计时
    var time = 60;
    var times;
    function zou(){
        times=setInterval(function(){
            if(time == 0){
                time = 60;
                $(".msg").show();
                $(".msg2").hide();
                clearInterval(times);
            }else{
                time--;
                console.log(time)
                if(time < 10){
                    $(".msg2").text('还剩(0'+time+')秒');
                }else{
                    $(".msg2").text('还剩('+time+')秒');
                }
            }
        },1000);
    }

    //点击验证码按钮
    $(".msg2").hide();
    $(".wrong").hide();
    $(".msg").on("click",function(e){
        var val = $("#tel").val();
        var re=/^[1][3,4,5,7,8][0-9]{9}$/;
        if(re.test(val)){
            $(".msg").hide();
            $(".msg2").show();
            zou();
            $(".msg2").text('还剩(60)秒');
        }else{
            $(".wrong").fadeIn('500', function() {
                setTimeout(function(){$(".wrong").fadeOut(1000)},2000);
            });
        }
    });

    // 购物车
    var b ;//合计
    var c = [];//各商品总价
    var ccc = [];//选中的商品总价
    var arr = [];//商品总数
    var add = 0;//选中的商品数
    if($(".list-container").find('div').is('.item')){//是否有商品
        $(".no-container").addClass('hid');
    }else{
        $(".no-container").removeClass('hid');
    }
    for (var z = 0; z < $(".item").length; z++) {
        var num = $(".item").eq(z).find('.count').html();//获取数量
        var money = $(".item").eq(z).find('.left').html();//获取价格
        num = parseInt(num);//转换数字
        money = money.substring(14);//截取字符串
        money = parseFloat(money);//转换数字
        var d = num*money;
        c[z] = d;
        ccc[z] = d;
        b = eval(ccc.join('+'));
        $(".text-3").html(b.toFixed(2));
        arr[z] = 1;
    };
    for (var z = 0; z < arr.length; z++){
        if(arr[z] == 1){
            add++;
        }
    };
    chooseshop.num=add;
    $('.btn').html('立即购买('+add+')');
    $(".item .checkbox").on("click",function(){//单选
        var idx = $(this).parents('.item').index();
        if($(this).is('.uncheckbox')){
            $(this).removeClass('uncheckbox');
            arr[idx] = 0;
        }
        else{
            arr[idx] = 1;
            $(this).addClass('uncheckbox');
        }
        var a;
        for (var j = 0; j < $(".item").length; j++) {//判断是否全选
            if($(".item").eq(j).children('.checkbox').is('.uncheckbox')){

            }
            else{
                a = 0;
            }
        }
        if(a != 0){//全选改变全选框
            $("#check").children('.checkbox').addClass('uncheckbox');
            for (var z = 0; z < arr.length; z++){
                arr[z] = 1;
            };
        }else if(a == 0){
            $("#check").children('.checkbox').removeClass('uncheckbox');
        }
        add = 0;
        var bbb = 0;
        for (var z = 0; z < arr.length; z++){
            ccc[z] = c[z]*arr[z];
            bbb = c[z]*arr[z]+bbb;
            if(arr[z] == 1){
                add++;
            }
            b = bbb;
        };
        $(".text-3").html(b.toFixed(2));
        chooseshop.num=add;
        $('.btn').html('立即购买('+add+')');
    });
    $("#check").on("click",function(){//全选
        var bbb = 0;
        if($(this).children('.checkbox').is('.uncheckbox')){
            $(".checkbox").removeClass('uncheckbox');
            for (var z = 0; z < arr.length; z++){
                arr[z] = 0;
            };
        }else{
            $(".checkbox").addClass('uncheckbox');
            for (var z = 0; z < arr.length; z++){
                arr[z] = 1;
            };
        }
        add = 0;
        for (var z = 0; z < arr.length; z++){
            ccc[z] = c[z]*arr[z];
            bbb = c[z]*arr[z]+bbb;
            if(arr[z] == 1){
                add++;
            }
            b = bbb;
        };
        $(".text-3").html(b.toFixed(2));
        chooseshop.num=add;
        $('.btn').html('立即购买('+add+')');
    });
    var edittt = true;
    $(".minus").on("click",function(){//加减数量
        console.log(edittt)
        if(edittt){
            var num = $(this).siblings('.count').html();//获取数量
            var money = $(this).parent().siblings('.left').html();//获取价格
            if(money !=null && money !=undefined){
                money = money.substring(14);//截取字符串
                money = parseFloat(money);//转换数字
            }
            num = parseInt(num);//转换数字
            var idx = $(this).parents('.item').index();//各商品种类数量-1
            if(num >1 && num <=99){
                num--;
                $(this).siblings('.count').html(num);
                //更新数量

                var d = num*money;
                c[idx] = d;
                for(var i = 0; i<arr.length; i++){
                    ccc[i] = c[i]*arr[i];
                }
                b = eval(ccc.join('+'));
                $(".text-3").html(b.toFixed(2));
            }
            if(num <= 1){
                num = 1;
                $(this).siblings('.count').html(num);
                var d = num*money;
                c[idx] = d;
                for(var i = 0; i<arr.length; i++){
                    ccc[i] = c[i]*arr[i];
                }
                b = eval(ccc.join('+'));
                $(".text-3").html(b.toFixed(2));
            }
        }
    });
    $(".plus").on("click",function(){//加减数量
        console.log(edittt)
        if(edittt){
            var num = $(this).siblings('.count').html();//获取数量
            var money = $(this).parent().siblings('.left').html();//获取价格
            num = parseInt(num);//转换数字
            var bbb = 0;
            if(money !=null && money !=undefined){
                money = money.substring(14);//截取字符串
                money = parseFloat(money);//转换数字
            }
            var idx = $(this).parents('.item').index();//各商品种类数量-1
            if(num >=1 && num <99){
                num++;
                $(this).siblings('.count').text(num);
                var d = num*money;
                c[idx] = d;
                for(var i = 0; i<arr.length; i++){
                    ccc[i] = c[i]*arr[i];
                }
                b = eval(ccc.join('+'));
                $(".text-3").html(b.toFixed(2));
            }
            else if(num = 100){
                num = 99;
                alert('最多选择99个！');
                var d = num*money;
                c[idx] = d;
                for(var i = 0; i<arr.length; i++){
                    ccc[i] = c[i]*arr[i];
                }
                b = eval(ccc.join('+'));
                $(".text-3").html(b.toFixed(2));
            }
        }
    });

    //编辑删除
    var shopid = 0;
    var shopnum = 0;
    $(".header-container>.right").on("click",function(){//点击编辑
        var edit = $(this).html();
        var bbb = 0;
        if(edit == '编辑'){
            $(".list-container .item .info .bottom .right .minus,.list-container .item .info .bottom .right .plus").removeAttr("onclick");
            // $(".list-container .item .info .bottom .right .minus").addClass("edit").removeClass("minus");
            $(".list-container .item .info .bottom .right .plus").addClass("edit");
            edittt = false;
            $(this).html('完成');
            $('.btn').addClass('hid').siblings('.btns').removeClass('hid');
            $('.checkbox').removeClass('uncheckbox');//取消全选
            for(var i = 0; i<arr.length; i++){
                arr[i] = 0;
                ccc[i] = c[i]*arr[i];
                bbb = c[i]*arr[i]+bbb;
            }
            b = bbb;
            $(".text-3").html(b);
        }else{
            edittt = true;
            $(this).html('编辑');
            $('.btn').removeClass('hid').siblings('.btns').addClass('hid');
            $('.checkbox').addClass('uncheckbox');//全选
            var bbb = 0;
            for(var i = 0; i<arr.length; i++){
                arr[i] = 1;
                ccc[i] = c[i]*arr[i];
                bbb = c[i]*arr[i]+bbb;
                shopnum = $(".list-container .item").eq(i).find(".info .bottom .right .count").html();
                shopid = $(".list-container .item").eq(i).find(".info .top input").val();
                $(".list-container .item").eq(i).find(".info .bottom .right .plus").eq(0).removeClass("edit");
                $(".list-container .item").eq(i).find(".info .bottom .right .minus").attr("onclick","updatenumjian("+shopid+","+shopnum+")");
                $(".list-container .item").eq(i).find(".info .bottom .right .plus").attr("onclick","updatanumadd("+shopid+","+shopnum+")");
            }
            b = bbb;
            add = arr.length;
            $(".text-3").html(b.toFixed(2));
            chooseshop.num=add;
            $('.btn').html('立即购买('+add+')');
        }
    });

    $(".btns").on("click",function(){//点击删除
        for(var i = 0 ; i < arr.length ; i++){
            if($(".item").eq(i).find('.checkbox').is('.uncheckbox')){
                arr[i] = 1;
            }else{
                arr[i] = 0;
            }
        }
        var j = arr.length-1;
        for(var i = arr.length-1 ; i >= 0 ; i--){
            j--;
            if(arr[i] == 1){
                $(".item").eq(i).remove();
                arr.splice(i,1);
                c.splice(i,1);
                ccc.splice(i,1);
                j--;
                console.log(arr);
                console.log(c);
                console.log(ccc);
                console.log(i);
            }
            ccc[j] = c[j]*arr[j];
            console.log(ccc+'a');
        }
        b = 0;
        $(".text-3").html('0.00');

        if($(".list-container").find('div').is('.item')){
            $(".no-container").addClass('hid');
            $(".footer-container").removeClass('hid');
        }else{
            $(".no-container").removeClass('hid');
            $(".footer-container").addClass('hid');
            $(".list-container").css('padding-bottom', 0+'px');
        }
    });

    //点击加入购物车
    if($(".footer-container .count").html() == 0){
        $(this).addClass('hid');
    }else{
        $(this).removeClass('hid');
    }
    console.log("数量为"+getnum)
    //在商品详情页中初始化购物车值
    $(".badge").html(getnum);
    if($(".badge").html() == 0){
        $(".badge").addClass('hid');
    }else{
        $(".badge").removeClass('hid');
    }
    $(".btn-1").on("click",function(){//商品详情页
        var number = $(".badge").html();
        var count = $(".right .count").html();
        number = parseInt(number);
        count = parseInt(count);
        $(".badge").html(number+count);
        if($(".badge").html() == 0){
            $(".badge").addClass('hid');
        }else{
            $(".badge").removeClass('hid');
        }
    });
    $(".container-2 .right").on("click",function(){//首页
        var number = $(".footer-container .count").html();
        number = parseInt(number);
        number++;

        $(".footer-container .count").html(number);
        if($(".footer-container .count").html() == 0){
            $(".footer-container .count").addClass('hid');
        }else{
            $(".footer-container .count").removeClass('hid');
        }
    });

    var i = jsfori;
    console.log(i)
    $(".list-container2").eq(i).show().siblings(".list-container2,.no-container2").hide();
    if($(".list-container2").eq(i).find(".item").size() > 0){
        $(".list-container2,.no-container2").eq(i).addClass("list-container2").removeClass("no-container2");
        $(".list-container2,.no-container2").eq(i).show().siblings(".list-container2,.no-container2").hide();
    }else{
        $(".list-container2,.no-container2").eq(i).addClass("no-container2").removeClass("list-container2");
        $(".list-container2,.no-container2").eq(i).show().siblings(".list-container2,.no-container2").hide();
    }
    $(".nav").on("click",function(){//点击选项卡
        var i = $(this).index();
        $(this).css('color', '#e70012').siblings().css('color', '#666');
        console.log(i)
        if($(".list-container2,.no-container2").eq(i).find(".item").size() > 0){
            $(".list-container2,.no-container2").eq(i).addClass("list-container2").removeClass("no-container2");
            $(".list-container2,.no-container2").eq(i).show().siblings(".list-container2,.no-container2").hide();
        }else{
            $(".list-container2,.no-container2").eq(i).addClass("no-container2").removeClass("list-container2");
            $(".list-container2,.no-container2").eq(i).show().siblings(".list-container2,.no-container2").hide();
        }
        if(i == 0){
            //控制商品详情选项卡切换
            $(".detail-container").removeClass('hid');
            $(".record-container").addClass('hid')
        }
        else if(i >0 && i <4 ){
            //控制商品详情选项卡切换
            $(".record-container").removeClass('hid');
            $(".detail-container").addClass('hid')
        }
    });


    //确认订单
    // var total = 0;
    // var totals = [];
    // for( var i = 0 ; i < $(".item").length ; i++){
    // 	var moneys = $(".item").eq(i).find('.bottom .left').text();//获取价格
    // 	var numbers = $(".item").eq(i).find('.describe span').text();//获取数量
    // 		numbers = numbers.substring(1);//截取字符串
    // 		numbers = parseInt(numbers);//转换数字
    // 		moneys = moneys.substring(1);//截取字符串
    // 		moneys = parseFloat(moneys);//转换数字
    // 		totals[i] = moneys*numbers;
    // 		total =  moneys*numbers+total;
    // 		console.log(moneys)
    // 		console.log(numbers)
    // 	console.log(total)
    // }
    // $(".text-3").html(total.toFixed(2));
    // $(".price-container span").html('￥'+total.toFixed(2));
})