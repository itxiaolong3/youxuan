<?php if (!defined('THINK_PATH')) exit();?><!--引入头部文件，如css-->
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo ($title); ?></title>
    <link href="/youxuan/youxuan/Public/admin/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/youxuan/youxuan/Public/admin/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="/youxuan/youxuan/Public/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/youxuan/youxuan/Public/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/youxuan/youxuan/Public/admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/youxuan/youxuan/Public/admin/css/animate.css" rel="stylesheet">
    <link href="/youxuan/youxuan/Public/admin/css/style.css" rel="stylesheet">
    <!-- Ladda style -->
    <link href="/youxuan/youxuan/Public/admin/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="/youxuan/youxuan/Public/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/youxuan/youxuan/Public/admin/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!--多图上传的css-->
    <link href="/youxuan/youxuan/Public/css/default.css" rel="stylesheet" type="text/css" />
    <link href="/youxuan/youxuan/Public/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <!--layer-->
    <link href="/youxuan/youxuan/Public/admin/js/layer/css/layui.css" rel="stylesheet">
    <script src="/youxuan/youxuan/Public/admin/js/layer/layui.js" charset="utf-8"></script>


</head>
<style type="text/css">
	*{
		margin: 0px;
		padding: 0px;
		border: none;
		box-sizing: border-box;
		outline: none;
	}
	.box{
		width: 100%;
	}
	.box input{
		display: none;
	}
	.box label{
		width: 100px;
		height: 50px;
		float: left;
	}
	input{
		display: none;
	}
	.box label{
		width: 120px;
		height: 50px;
		line-height: 50px;
		position: relative;
		text-align: center;
		margin-right: -35px
	}
	.box label:active{
		background: #EEEEEE;
	}
	.box label:after{
		content: "";
		width: 20px;
		height: 20px;
		border: 1px solid green;
		border-radius: 20px;
		display: inline-block;
		position: absolute;
		top: 15px;
		left: 15px;
	}
	input:checked+label:after{
		background-color: green;
	}


</style>
	<body style="background: none;">
	<div class="table-responsive">
		<div id="tab-2" class="tab-pane">
			<div class="panel-body ibox-content">
				<form method="post" class="form-horizontal"  enctype="multipart/form-data">
					<fieldset class="form-horizontal">
						<div class="form-group"><label class="col-sm-2 control-label">商品名称:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="gtitle" required="required" placeholder="商品名称"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">颜色:</label>
							<div class="col-sm-10">
								<?php if(is_array($colors)): foreach($colors as $k=>$v): ?><div class="box">
										<input type="checkbox" name="color[]"  id="checkbox<?php echo ($k); ?>" value="<?php echo ($v["cname"]); ?>"/><label for="checkbox<?php echo ($k); ?>"><?php echo ($v["cname"]); ?></label>
									</div><?php endforeach; endif; ?>
							</div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">规格:</label>
							<div class="col-sm-10">
								<?php if(is_array($formats)): foreach($formats as $k=>$v): ?><div class="box">
										<input type="checkbox" name="format[]"  id="ggcheckbox2<?php echo ($k); ?>" value="<?php echo ($v["ggname"]); ?>"/><label for="ggcheckbox2<?php echo ($k); ?>"><?php echo ($v["ggname"]); ?></label>
									</div><?php endforeach; endif; ?>
							</div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">商品简介:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="gdes" required="required" placeholder="商品简介，广告语"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">原价/元:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="gprice" required="required" placeholder="不参加优惠的价格"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">优惠价格/元:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="gyhprice" required="required" placeholder="实际买卖价格"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">限量数:</label>
							<div class="col-sm-10"><input type="text" required="required" name="gendnum" class="form-control" placeholder="限量用户购买数"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">提成:</label>
							<div class="col-sm-10"><input type="text" required="required" name="gticheng" class="form-control" placeholder="提成"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">排序:</label>
							<div class="col-sm-10"><input type="number" required="required" name="gorder" class="form-control" placeholder="默认为0"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">供应商:</label>
							<div class="col-sm-10"><input type="text" required="required" name="gboss" class="form-control" placeholder="商品供应商"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">品牌:</label>
							<div class="col-sm-10"><input type="text" required="required" name="gpingpai" class="form-control" placeholder="品牌"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">产地:</label>
							<div class="col-sm-10"><input type="text" required="required" name="gaddress" class="form-control" placeholder="产地"></div>
						</div>
						<div class="form-group">
							<div class="layui-upload">
								<label class="col-sm-2 control-label">商品结束时间：</label>
								<div class="layui-inline col-sm-10" >
									<div class="layui-input-inline">
										<input type="text" class="layui-input" name="gendtime" id="test5" placeholder="选填">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="layui-upload">
								<label class="col-sm-2 control-label">预售时间：</label>
								<div class="layui-inline col-sm-10" >
									<div class="layui-input-inline">
										<input type="text" class="layui-input" name="gbuypretime" id="test11" placeholder="MM月dd日">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="layui-upload ">
								<label class="col-sm-2 control-label">提货时间：</label>
								<div class="layui-inline col-sm-10">
									<div class="layui-input-inline">
										<input type="text" class="layui-input" name="gbuyendtime" id="test12" placeholder="MM月dd日">
									</div>
								</div>
							</div>
						</div>
                      <div class="form-group">
							<div class="layui-upload ">
								<label class="col-sm-2 control-label">预设上架时间：</label>
								<div class="layui-inline col-sm-10">
									<div class="layui-input-inline">
										<input type="text" class="layui-input" name="guptime" id="test13" placeholder="年-月-日 时:分:秒">&nbsp;(不选则立即上架)
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">封面图片：</label>
							<div class="layui-upload col-sm-10">
								<button type="button" class="layui-btn" id="test1">封面图片</button>
								<div class="layui-upload-list">
									<input type="hidden" id="file_upload_image" required="required" name="gtopimg" multiple="true" value=""/>
									<!--<a href="javascript:deletefimg();" title="点击删除"><img style="display: none;margin-left: 120px;" id="deletef" src="/youxuan/youxuan/Public/admin/js/img/uploadify-cancel.png">-->
									<!--</a>-->
									<!--<img class="layui-upload-img"  id="demo1" style="display: none;margin-left: -140px;" width="100" height="100">-->
									<div id="showimg">

									</div>
									<p id="demoText"></p>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">商品图片集</label>
							<div class="layui-upload col-sm-10">
								<div class="layui-upload">
									<button type="button" class="layui-btn" id="test3">多图片上传</button>
									<blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
										预览图：
										<div class="layui-upload-list" id="demo3"></div>
									</blockquote>
									<input type="hidden" name="gimgs" id="manyimg" value=""/>
								</div>
							</div>
						</div>

						<div class="form-group" style="clear: both"><label class="col-sm-2 control-label">产品图文描述</label>
							<input value="" type="hidden" name="gcomment" id="editnotice">
							<div class="col-sm-10">
								<div class="summernote">

								</div>
							</div>
						</div>
					</fieldset>
					<div class="col-sm-10" style="width: 100%;text-align: center;">
						<button class ="ladda-button ladda-button-demo btn btn-primary"data-style ="zoom-in" id="postdata">保存并提交</button>
					</div>
					<div style="margin-top: 70px;"></div>
				</form>

			</div>
		</div>
	</div>
	<!--引入外部js文件-->
	<!--这里写引入的js文件-->
<!-- Mainly scripts -->
<script src="/youxuan/youxuan/Public/admin/js/jquery-3.1.1.min.js"></script>
<script src="/youxuan/youxuan/Public/admin/js/bootstrap.min.js"></script>
<script src="/youxuan/youxuan/Public/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/youxuan/youxuan/Public/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="/youxuan/youxuan/Public/admin/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/youxuan/youxuan/Public/admin/js/inspinia.js"></script>
<script src="/youxuan/youxuan/Public/admin/js/plugins/pace/pace.min.js"></script>
<!-- Sweet alert -->
<script src="/youxuan/youxuan/Public/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
<!-- Page-Level Scripts -->
<!-- Toastr script -->
<script src="/youxuan/youxuan/Public/admin/js/plugins/toastr/toastr.min.js"></script>
<!-- SUMMERNOTE -->
<script src="/youxuan/youxuan/Public/admin/js/plugins/summernote/summernote.min.js"></script>
<!-- Data picker -->
<script src="/youxuan/youxuan/Public/admin/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="https://cdn.bootcss.com/summernote/0.8.10/lang/summernote-zh-CN.js"></script>
<!-- Select2 -->
<script src="/youxuan/youxuan/Public/admin/js/plugins/select2/select2.full.min.js"></script>
<!-- Ladda -->
<script src="/youxuan/youxuan/Public/admin/js/plugins/ladda/spin.min.js"></script>
<script src="/youxuan/youxuan/Public/admin/js/plugins/ladda/ladda.min.js"></script>
<script src="/youxuan/youxuan/Public/admin/js/plugins/ladda/ladda.jquery.min.js"></script>
<!-- iCheck -->
<script src="/youxuan/youxuan/Public/admin/js/plugins/iCheck/icheck.min.js"></script>
	<!--引入uploadfiyjs-->
	<script src="/youxuan/youxuan/Public/admin/js/uploadify/jquery.uploadify.js"></script>
		<!--多图上传的js开始-->
	<!--非layer的多图片上传引入步骤
	1，引入uploadfiyjs,swfupload.js,handlers.js
	2,在public/imgaes复制两张图片，分别fancy_close.png,upload.png
	3,在Admin/Conf/config.php的下创建J方法
	4,在删除图片方法中加上斜杠，直接复制删除方法即可。
	5，在接收多图片时需要剔除首位的斜杠
	-->
		<script type="text/javascript">
            var path='/youxuan/youxuan/Public';
            var url='/youxuan/youxuan/index.php/Superadmin/Addgoods';
		</script>
	<script type="text/javascript" src="/youxuan/youxuan/Public/js/swfupload.js"></script>
		<script type="text/javascript" src="/youxuan/youxuan/Public/js/handlers.js"></script>
		<!--多图上传的js结束-->

		<!--layerjs部分-->
	<!--时间选择-->
	<script>
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            //日期时间选择器
            laydate.render({
                elem: '#test5'
                ,type: 'datetime'
            });
            laydate.render({
                elem: '#test11'
                ,format: 'MM月dd日'
            });
            laydate.render({
                elem: '#test12'
                ,format: 'MM月dd日'
            });
          laydate.render({
   				 elem: '#test13'
  				  ,type: 'datetime'
 			 });
        });
	</script>
		<script>
            layui.use('upload', function(){
                var $ = layui.jquery
                    ,upload = layui.upload;
                //封面图片上传
                var uploadInst = upload.render({
                    elem: '#test1'
                    ,url: "<?php echo U('image/uploadfortp');?>"
                    ,before: function(obj){
                        //预读本地文件示例，不支持ie8
//                        obj.preview(function(index, file, result){
//                            $('#demo1').attr('src', result); //图片链接（base64）
//                        });
                    }
                    ,done: function(res){
                        //如果上传失败
                        if(res.code > 0){
                            return layer.msg('上传失败');
                        }
                        console.log(res);
                        //var obj=JSON.parse(res);
						console.log(res.data);
                        var newElement = "<li><img class='layui-upload-img' id='showone' src='" +"/youxuan/youxuan/Public/admin/uploads/"+res.data + "' style='width:100px;height:100px;'><img class='button' id='oneimgclose' src="+window.path+"/images/fancy_close.png></li>";
                        if ($("#file_upload_image").val()!='images/nopic.png'){
                            if($("#file_upload_image").val()==''){
                                $("#showimg").append(newElement);//deleteqrcodeimg
                                $("#file_upload_image").attr('value',"admin/uploads/"+res.data);
                            }else{
                                $("#file_upload_image").attr('value',"admin/uploads/"+res.data);
                                $("#showone").attr('src',"/youxuan/youxuan/Public/admin/uploads/"+res.data);
                            }

                        }else{
                            $("#showimg").append(newElement);//deleteqrcodeimg
                            $("#file_upload_image").attr('value',"admin/uploads/"+res.data);
                        }
                        $("#oneimgclose").bind("click", deletefimg);
                        $('#demo1').show();
                        //上传成功
                    }
                    ,error: function(){
                        //演示失败状态，并实现重传
                        var demoText = $('#demoText');
                        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                        demoText.find('.demo-reload').on('click', function(){
                            uploadInst.upload();
                        });
                    }
                });
                //多图片上传
                upload.render({
                    elem: '#test3'
                    ,url: "<?php echo U('image/uploadfortp');?>"
                    ,multiple: true
                    ,before: function(obj){
                        //预读本地文件示例，不支持ie8
                        obj.preview(function(index, file, result){
                            // $('#demo3').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img" style="width: 250px;height: 200px;margin-left: 20px;margin-top: 20px;">')
                        });
                    }
                    ,done: function(res){
                        //每个文件提交一次触发一次。详见“请求成功的回调”
                        //alert(res);
                        console.log(res);
                        var newElement = "<li><img class='layui-upload-img'  src='" +"/youxuan/youxuan/Public/admin/uploads/"+res.data + "' style='width:100px;height:100px;'><img class='button' src="+window.path+"/images/fancy_close.png></li>";
                        $("#demo3").append(newElement);
                        $("img.button").last().bind("click", del);
                        var $svalue=$('#manyimg').val();
                        if($svalue==''){
                            $('#manyimg').val("|"+"/youxuan/youxuan/Public/admin/uploads/"+res.data);
                        }else{
                            $('#manyimg').val($svalue+"|"+"/youxuan/youxuan/Public/admin/uploads/"+res.data);
                        }
                        console.log('打印我');

                    }
                });
                //多图中的删除
                var del = function(){
                    var src=$(this).siblings('img').attr('src');
                    var $svalue=$('#manyimg').val();
                    $.ajax({
                        type: "POST", //访问WebService使用Post方式请求
                        url: window.url+"/del", //调用WebService的地址和方法名称组合---WsURL/方法名
                        data: "src=" + src,
                        success: function(data){
                            //alert(data);
                            var $val=$svalue.replace(data,'');
                            $('#manyimg').val($val);
                        }
                    });
                    $(this).parent().remove();
                }

            });
		</script>
		<script>
            $(document).ready(function(){
                var l = $( '.ladda-button-demo' ).ladda();
              var $summernote=  $('.summernote').summernote({
                    height: 200,
                    lang: 'zh-CN', // default: 'en-US'
                    //调用图片上传
                    callbacks: {
                        onImageUpload: function (files) {
                            sendFile($summernote, files[0]);
                        }
                    }

				});
                //ajax上传图片
                function sendFile($summernote, file) {
                    var formData = new FormData();
                    formData.append("file", file);
                    $.ajax({
                        url: "<?php echo U('image/uploadfornotice');?>",//路径是你控制器中上传图片的方法，
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function (data) {
                            $summernote.summernote('insertImage', data, function ($image) {
                                $image.attr('src', data);
                            });
                        }
                    });
                }
                $('.input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true
                });

                $('#postdata').click(function () {
                        l.ladda( 'start' );
                        var markupStr = $('.summernote').summernote('code');
                        //把编辑器中的内容放入input中一起提交
                        $("#editnotice").attr('value',markupStr.trim());
                        var data = $('form').serializeArray();
                        //开始提交数据进行保存
                        $.post("",data,function(e){
                            e = JSON.parse(e);
                            console.log(e);
                            if(e.status==1){
                                window.location.href = "<?php echo U('Goodslist/goodslist');?>";
                                l.ladda('stop');
                            }else{
                                swal({
                                    title: "添加失败",
                                    text: e.msg
                                });
                                l.ladda('stop');
							}
                        })

                })


            });
		</script>
		<script>
            function deletefimg() {
                var src=$(this).siblings('img').attr('src');
                //alert(src);
                $.ajax({
                    type: "POST", //访问WebService使用Post方式请求
                    url: "<?php echo U('Addgoods/delone');?>", //调用WebService的地址和方法名称组合---WsURL/方法名
                    data: "src=" + src,
                    success: function(data){
                        console.log(data);
                    }
                });
                $("#file_upload_image").attr('value','');
                $(this).parent().remove();

            }
            //ischeck=$("#checkbox2").is(":checked");
			

		</script>

	<script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
	</script>

	</body>

</html>