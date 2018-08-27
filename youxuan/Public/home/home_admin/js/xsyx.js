//自动消失顶部提示
function show_tip(text) {
    $('<div>').appendTo('body').addClass('tip').html(text).show().delay(1500).fadeOut();
}
//固定底部
fixed_bottom('fix-b');
if($(".list-container1").eq(0).find("div").is(".item")){
    $(".bg").css('background-color','#f7f7f7');
}
else{
    $(".bg").css('background-color','#fff');
}
$(function(){
	//选项卡
	$(".nav-container .nav").on("click",function(){
		var idx = $(this).index();
      if($(".list-container1").eq(idx).find("div").is(".item")){
            $(".bg").css('background-color','#f7f7f7');
		}
		else{
			$(".bg").css('background-color','#fff');
		}
		$(this).addClass('active').siblings().removeClass('active');
		$(".list-container1").eq(idx).removeClass('hid').siblings('.list-container1').addClass('hid');
		$(".cash-list").eq(idx).removeClass('hid').siblings('.cash-list').addClass('hid');
		$(".no-container").addClass('hid');
		// if(idx == 3){
		// 	$(".list-container1").addClass('hid');
		// 	$(".no-container").removeClass('hid');
		// }
	});
	$(".bonus-nav .nav").on("click",function(){
		var idx = $(this).index();
		$(this).addClass('bonus-active').siblings().removeClass('bonus-active');
		$(".bonus-list").eq(idx).removeClass('hid').siblings('.bonus-list').addClass('hid');
	});

	//搜索
	$(".search").on("click",function(){
		$(".search-container").removeClass('hid');
		$("#mask").addClass('mask-in').removeClass('mask-out');
	});

	//蒙版
	$("#mask").on("click",function(){
		$(this).addClass('mask-out').removeClass('mask-in');
		$(".search-container").addClass('hid');
	});

	//验证码倒计时
	// var time = 60;
	// var times;
	// function zou(){
	// 	times=setInterval(function(){
	// 		if(time == 0){
	// 			time = 60;
	// 			$(".input-container2 .right").show();
	// 			$(".input-container2 .right2").hide();
	// 			clearInterval(times);
	// 		}else{
	// 			time--;
	// 			console.log(time)
	// 			if(time < 10){
	// 				$(".input-container2 .right2").text('还剩(0'+time+')秒');
	// 			}else{
	// 				$(".input-container2 .right2").text('还剩('+time+')秒');
	// 			}
	// 		}
	// 	},1000);
	// }
	// $(".input-container2 .right2").hide();
	// $(".input-container2 .right").on("click",function(){
	// 	$(".input-container2 .right2").show();
	// 	$(".input-container2 .right").hide();
	// 	zou();
	// });

	//订单详情
	var totals = [];//各个商品的总价
	var total = 0;//合计
	var arr = 0;//商品总数
	for(var i = 0 ;i < $(".list-container1 .item").length ; i++){
		var money = $(".list-container1 .item").eq(i).find('.bottom p').eq(0).text();
		var num = $(".list-container1 .item").eq(i).find('.bottom p').eq(1).text();
			money = money.substring(1);
			money = parseFloat(money);
			num = parseInt(num);
			totals[i] = num*money;
			total = num*money+total;
			arr = num+arr;
	}
	$(".price-container1 .top").find('span').eq(0).html(arr);
	$(".price-container1 .top").find('span').eq(1).html('￥'+total.toFixed(2));
	$(".price-container1 .bottom").find('span').html('￥'+total.toFixed(2));

	//查询
	var phones = [];//手机号
	var order = [];//订单号
	var bl = [];//提单号
	for(var i = 0 ; i < $(".item").length ; i++){
		phones[i] = $(".item").eq(i).find('.phone').text();
		order[i] = $(".item").eq(i).find('.title p').eq(0).text().substring(5);
		bl[i] = $(".item").eq(i).find('.left span').text();
	}
	$(".btn").on("click",function(){
		var phone = $(".search input").val();
		$(".item").css('display', 'none');
		for(var i = 0 ; i < $(".item").length ; i++){
			if(phones[i].indexOf(phone,0) >= 0 || order[i].indexOf(phone,0) >= 0 || bl[i].indexOf(phone,0) >= 0){
				$(".item").eq(i).css('display', 'flex');
			}
		}
	});
	//售后申请界面 搜索

	//修改头像
// $(".file").on("click",function(file){ //点击事件
	// 	$(this).on("change",function(e){ //input值发生变化时触发事件
	// 		var objUrl = getObjurl(this.files[0]);
	// 		if(objUrl){
	// 			$(this).siblings('img').attr('src', objUrl); //替换头像
	// 		}
	// 	});
    //
	// 	function getObjurl(file){ //获取图片
	// 		var url = null;
	// 		if(window.createObjectURL != undefined){
	// 			url = window.createObjectURL(file)
	// 		} else if (window.URL != undefined) {
     //            url = window.URL.createObjectURL(file)
     //        } else if (window.webkitURL != undefined) {
     //            url = window.webkitURL.createObjectURL(file)
     //        }
     //        return url ;
	// 	}
	// });

	//密码
	$(".btn-container3").on("click",function(){
		var one = $(".input-container2").eq(2).find('input').val();
		var two = $(".input-container2").eq(3).find('input').val();
		if(one === two){

		}else{
			//alert("两次密码不一致！");
		}
	});
})