<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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

<body style="background: none;">

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<div style="margin-top: 10px;"></div>
			<ol class="breadcrumb">
				<li>
					<a href="index.html" target="_parent">Home</a>
				</li>

				<li class="active">
					<strong>颜色</strong>
				</li>
			</ol>
		</div>
	</div>
	<!--主体部分-->
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox">
				<div class="ibox-content">
					<button type="button" class="btn btn-block btn-outline btn-primary" data-toggle="modal" data-target="#myModal5">新增</button>
					<div class="clients-list">
						<div class="full-height-scroll">

							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<tbody>
									<tr>
										<th>id</th>
										<th>颜色</th>
										<th>操作</th>
									</tr>
									<?php if(is_array($colorinfo)): foreach($colorinfo as $key=>$vv): ?><tr>
											<td><?php echo ($vv["cid"]); ?></td>
											<td><?php echo ($vv["cname"]); ?></td>
											<td>
												<a type="button" class="btn btn-primary btn-xs" data-toggle="modal" href="javascript:deleteuser('<?php echo ($vv["cid"]); ?>');">移除</a>
												<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal4"  onclick="doedit('<?php echo ($vv["cid"]); ?>','<?php echo ($vv["cname"]); ?>')">修改信息</button>
											</td>
										</tr><?php endforeach; endif; ?>

									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!--修改-->
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					编辑信息
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox float-e-margins">
							<div class="ibox-content">
								<form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
									<input type="hidden" placeholder="自动获取" name="cid" id="getid"  class="form-control" required="required">
									<div class="form-group">
										<label class="col-sm-2 control-label">颜色</label>
										<div class="col-sm-10">
											<input type="text" placeholder="黄色" name="cname" id="getname"  class="form-control" required="required">
										</div>
									</div>
									<div class="col-sm-10" style="width: 100%;text-align: center;">
										<input type="button" class="btn btn-primary" id="postadmin" value="点击我立即提交，不要按回车" />
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal -->
</div>
<!--添加-->
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					新增管理员
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox float-e-margins">
							<div class="ibox-content">
								<form method="post" class="form-horizontal"  enctype="multipart/form-data">
									<div class="form-group">
										<label class="col-sm-2 control-label">颜色</label>
										<div class="col-sm-10">
											<input type="text" placeholder="如：黄色" id="colors" name="cname" class="form-control" required="required">
										</div>
									</div>
									<div class="col-sm-10" style="width: 100%;text-align: center;">
										<input type="button" class="btn btn-primary" onclick="addadmin();" value="点击我立即提交，不要按回车" />
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal -->
</div>
</div>
<!--引入头部文件，如css-->
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
<script>
    $(".loadimg").on("change", "input[type='file']", function() {
        var filePath = $(this).val();
        if(filePath.indexOf("jpg") != -1 || filePath.indexOf("png") != -1) {
            $(".fileerrorTip").html("").hide();
            var arr = filePath.split('\\');
            var fileName = arr[arr.length - 1];
            $(".showFileName").html(fileName);
        } else {
            $(".showFileName").html("");
            $(".fileerrorTip").html("您未上传文件，或者您上传文件类型有误！").show();
            return false
        }
    });
</script>
<!--删除用户-->
<script>
    function deleteuser(id) {
        swal({
            title: "您确定移除吗",
            text: "温馨提示",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "是的, 移除先",
            closeOnConfirm: true
        }, function() {
            $.post(
                "<?php echo U('Addcolor/index');?>",
                {
                    cid:id
                },
                function(e){
                    obj=JSON.parse(e);
                    console.log(obj.status);
                    if(obj.status==1){
                        window.location.reload();
                    }else{
                        swal({
                            title: "删除失败",
                            text: "失败提示",
                            type: "warning",
                            confirmButtonText: "哦",
                        },function () {
                            window.location.reload();
                        });
                    }
                });

        });

    }
</script>
<script>
    function addadmin() {
        var l = $( '.ladda-button-demo' ).ladda();
        l.ladda( 'start' );
        var data = $('#colors').val();
        //开始提交数据进行保存
        $.post("<?php echo U('Addcolor/addcolor');?>",{cname:data},function(e){
            e1 = JSON.parse(e);
            console.log(e1);
            if(e1.status==1){
                window.location.reload();
                l.ladda('stop');
            }else if(e1.status==-3){
                swal({
                    title: "该颜色已存在",
                    text: "添加失败"
                });
                l.ladda('stop');
            }else{
                swal({
                    title: "添加失败",
                    text: "发生未知错误"
                });
                l.ladda('stop');
            }
        })
    }
</script>
<script>
    function doedit(id,name) {
        //alert(id);
        $("#getid").val(id);
        $("#getname").val(name);
    }
</script>
<script>
    $(function () {
        var l = $( '.ladda-button-demo' ).ladda();
        $("#postadmin").click(function () {
            l.ladda( 'start' );
            getid=$("#getid").val();
            getname=$("#getname").val();
            $.post(
                "<?php echo U('Addcolor/editcolor');?>",
                {
                    'cname':getname,
                    'cid':getid,
                }
                ,function(e){
                    e = JSON.parse(e);
                    console.log(e);
                    if(e.status==1){
                        window.location.reload();
                        l.ladda('stop');
                    }else{
                        swal({
                            title: "编辑失败",
                            text: "发生未知错误"
                        });
                        l.ladda('stop');
                    }
                });

        })
    })
</script>

</body>

</html>