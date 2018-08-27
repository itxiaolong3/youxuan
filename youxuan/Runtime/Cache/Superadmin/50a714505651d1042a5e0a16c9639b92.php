<?php if (!defined('THINK_PATH')) exit();?><!--引入头部文件，如css-->
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo ($title); ?></title>
    <link href="/tp3/youxuan/Public/admin/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/tp3/youxuan/Public/admin/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="/tp3/youxuan/Public/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/tp3/youxuan/Public/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tp3/youxuan/Public/admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/tp3/youxuan/Public/admin/css/animate.css" rel="stylesheet">
    <link href="/tp3/youxuan/Public/admin/css/style.css" rel="stylesheet">
    <!-- Ladda style -->
    <link href="/tp3/youxuan/Public/admin/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="/tp3/youxuan/Public/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/tp3/youxuan/Public/admin/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!--多图上传的css-->
    <link href="/tp3/youxuan/Public/css/default.css" rel="stylesheet" type="text/css" />
    <!--layer-->
    <link href="/tp3/youxuan/Public/admin/js/layer/css/layui.css" rel="stylesheet">
    <script src="/tp3/youxuan/Public/admin/js/layer/layui.js" charset="utf-8"></script>

</head>
	<body style="background: none;">
	<div class="table-responsive">
		<div id="tab-2" class="tab-pane">
			<div class="panel-body">
				<form method="post" class="form-horizontal"  enctype="multipart/form-data">
					<fieldset class="form-horizontal">

						<div class="form-group"><label class="col-sm-2 control-label">店名:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="dname" required="required" placeholder="店名"></div>
						</div>

						<div class="form-group"><label class="col-sm-2 control-label">手机号:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="dphone" required="required" placeholder="手机号"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">密&nbsp;码:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="dpassword" required="required" placeholder="登录密码"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">提货地址:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="daddress" required="required" placeholder="提货地址"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">昵称:</label>
							<div class="col-sm-10"><input type="text" class="form-control" name="dnickname" required="required" placeholder="昵称"></div>
						</div>
						<div class="form-group">
							<div class="layui-upload">
								<label class="col-sm-2 control-label">预售时间：</label>
							<div class="layui-inline col-sm-10" >
								<div class="layui-input-inline">
									<input type="text" class="layui-input" name="dpretime" id="test11" placeholder="MM月dd日">
								</div>
							</div>
							</div>
						</div>
						<div class="form-group">
							<div class="layui-upload ">
								<label class="col-sm-2 control-label">提货时间：</label>
							<div class="layui-inline col-sm-10">
								<div class="layui-input-inline">
									<input type="text" class="layui-input" name="dendtime" id="test12" placeholder="MM月dd日">
								</div>
							</div>
							</div>
						</div>

						<div class="form-group"><label class="col-sm-2 control-label">个性签名:</label>
							<div class="col-sm-10"><input type="text" required="required" name="dsign" class="form-control" placeholder="选填"></div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">头像：</label>
							<div class="layui-upload col-sm-10">
								<button type="button" class="layui-btn" id="test2">上传头像</button>
								<div class="layui-upload-list">
									<input type="hidden" id="uploadqrcodeimg" required="required" name="dheaderimg" multiple="true" value="images/nopic.png"/>
									<a href="javascript:deleteqrcodeimg();" title="点击删除"><img style="display: none;margin-left: 120px;" id="deleteqrcode" src="/tp3/youxuan/Public/admin/js/img/uploadify-cancel.png">
									</a>
									<img class="layui-upload-img"  id="demo2" style="display: none;margin-left: -140px;" width="100" height="100">
									<p id="demoText2"></p>
								</div>
							</div>
						</div>
						<hr/>
					</fieldset>
					<div class="col-sm-10" style="width: 100%;text-align: center;">
						<button class ="ladda-button ladda-button-demo btn btn-primary"data-style ="zoom-in" id="postdata">保存并提交</button>
					</div>
					<hr/>
					<hr/>
					<hr/>
				</form>

			</div>
		</div>
	</div>
	<!--引入外部js文件-->
	<!--这里写引入的js文件-->
<!-- Mainly scripts -->
<script src="/tp3/youxuan/Public/admin/js/jquery-3.1.1.min.js"></script>
<script src="/tp3/youxuan/Public/admin/js/bootstrap.min.js"></script>
<script src="/tp3/youxuan/Public/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/tp3/youxuan/Public/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="/tp3/youxuan/Public/admin/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/tp3/youxuan/Public/admin/js/inspinia.js"></script>
<script src="/tp3/youxuan/Public/admin/js/plugins/pace/pace.min.js"></script>
<!-- Sweet alert -->
<script src="/tp3/youxuan/Public/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
<!-- Page-Level Scripts -->
<!-- Toastr script -->
<script src="/tp3/youxuan/Public/admin/js/plugins/toastr/toastr.min.js"></script>
<!-- SUMMERNOTE -->
<script src="/tp3/youxuan/Public/admin/js/plugins/summernote/summernote.min.js"></script>
<!-- Data picker -->
<script src="/tp3/youxuan/Public/admin/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="https://cdn.bootcss.com/summernote/0.8.10/lang/summernote-zh-CN.js"></script>
<!-- Select2 -->
<script src="/tp3/youxuan/Public/admin/js/plugins/select2/select2.full.min.js"></script>
<!-- Ladda -->
<script src="/tp3/youxuan/Public/admin/js/plugins/ladda/spin.min.js"></script>
<script src="/tp3/youxuan/Public/admin/js/plugins/ladda/ladda.min.js"></script>
<script src="/tp3/youxuan/Public/admin/js/plugins/ladda/ladda.jquery.min.js"></script>
		<!--多图上传的js开始-->
		<script type="text/javascript">
            var path='/tp3/youxuan/Public';
            var url='/tp3/youxuan/index.php/Superadmin/Addshop';
		</script>
		<!--图片上传逻辑已经封装这handlers.js里面-->
		<script type="text/javascript" src="/tp3/youxuan/Public/js/handlers.js"></script>
		<!--多图上传的js结束-->

		<!--layerjs部分-->
	<!--时间选择-->
	<script>
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            laydate.render({
                elem: '#test11'
                ,format: 'MM月dd日'
            });
            laydate.render({
                elem: '#test12'
                ,format: 'MM月dd日'
            });
        });
	</script>
		<script>
            layui.use('upload', function(){
                var $ = layui.jquery
                    ,upload = layui.upload
                ,laydate = layui.laydate;
                //封面图片上传
                var uploadInst2 = upload.render({
                    elem: '#test2'
                    ,url: "<?php echo U('image/uploadfortp');?>"
                    ,before: function(obj){
                        //预读本地文件示例，不支持ie8
                        obj.preview(function(index, file, result){
                            $('#demo2').attr('src', result); //图片链接（base64）
                        });
                    }
                    ,done: function(res){
                        //如果上传失败
                        if(res.code > 0){
                            return layer.msg('上传失败');
                        }
                        console.log(res);
                        //var obj=JSON.parse(res);
                        console.log(res.data);
                        $("#uploadqrcodeimg").attr('value',"admin/uploads/"+res.data);
                        $('#deleteqrcode').show();
                        $('#demo2').show();
                        //上传成功
                    }
                    ,error: function(){
                        //演示失败状态，并实现重传
                        var demoText = $('#demoText2');
                        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                        demoText.find('.demo-reload').on('click', function(){
                            uploadInst2.upload();
                        });
                    }
                });

            });
		</script>
		<script>
            $(document).ready(function(){
                var l = $( '.ladda-button-demo' ).ladda();
                $('.input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true
                });

                $('#postdata').click(function () {
                        l.ladda( 'start' );
                        var data = $('form').serializeArray();
                        //开始提交数据进行保存
                        $.post("",data,function(e){
                            e = JSON.parse(e);
                            console.log(e);
                            if(e.status==1){
                                window.location.href = "<?php echo U('Shoplist/shoplist');?>";
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
//			function getcontent() {
//                var markupStr = $('.summernote').summernote('code');
//                alert(markupStr)
//            }
            function deletefimg() {
                $("#file_upload_image").attr('value','');
                $("#demo1").attr('src','');
                $('#deletef').hide();
                $('#demo1').hide();

            }

			function deleteqrcodeimg() {
				$("#uploadqrcodeimg").attr('value','');
				$("#demo2").attr('src','');
				$('#deleteqrcode').hide();
				$('#demo2').hide();
			}
			function deletedimg() {
				$("#load_contentimg").attr('value','');
				$("#demo3").attr('src','');
				$('#deleted').hide();
				$('#demo3').hide();

			}
		</script>
	</body>

</html>