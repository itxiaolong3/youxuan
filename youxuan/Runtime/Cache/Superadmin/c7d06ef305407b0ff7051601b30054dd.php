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
				<li class="active">
					<strong>用户管理</strong>
				</li>
			</ol>
		</div>
	</div>
	<!--主体部分-->
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox">
				<div class="ibox-content">
					<div class="clients-list">
						<div class="full-height-scroll">
							<div class="table-responsive">
								<table class="table table-striped  dataTables-example">
									<thead>
									<tr>
										<th>id</th>
										<th>头像</th>
										<th>用户名</th>
										<th>电话</th>
										<th>openid</th>
										<th>添加时间</th>
										<th>操作</th>
									</tr>
									</thead>
									<tbody>
									<?php if(is_array($userinfo)): foreach($userinfo as $key=>$vv): ?><tr>
											<td><?php echo ($vv["uid"]); ?></td>
											<td><img src="/youxuan/youxuan/Public/<?php echo ($vv["headerimg"]); ?>" width="60" height="60" /></td>
											<td><?php echo ($vv["nickname"]); ?></td>
											<td><?php echo ($vv["phone"]); ?></td>
											<td><?php echo ($vv["openid"]); ?></td>
											<td><?php echo ($vv["uaddtime"]); ?></td>
											<td>
												<a type="button" class="btn btn-primary btn-xs" data-toggle="modal" href="javascript:deleteuser('<?php echo ($vv["uid"]); ?>');">删除</a>
												<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal4"  onclick="doedit('<?php echo ($vv["uid"]); ?>','<?php echo ($vv["phone"]); ?>')">修改信息</button>
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
									<input type="hidden" placeholder="自动获取" name="uid" id="getid"  class="form-control" required="required">

									<div class="form-group">
										<label class="col-sm-2 control-label">手机</label>
										<div class="col-sm-10">
											<input type="text" placeholder="请输入手机" name="phone" id="getphone"  class="form-control" required="required">
										</div>
									</div>
									<div class="col-sm-10" style="width: 100%;text-align: center;">
										<input type="button" class="btn btn-primary" id="postadmin" value="立即提交" />
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

<!--删除用户-->
<script>
    function deleteuser(id) {
        swal({
            title: "您确定移除吗",
            text: "删除提示",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "是的, 移除先",
            closeOnConfirm: true
        }, function() {
            $.post(
                "<?php echo U('User/vipuser');?>",
                {
                    uid:id
                },
                function(e){
                    obj=JSON.parse(e);
                    console.log(obj.status);
                    if(obj.status==1){
                        window.location.reload();
                    }else{
                        swal({
                            title: "删除失败",
                            text: "发生未知错误",
                            type: "warning",
                            confirmButtonText: "明白",
                        },function () {
                            window.location.reload();
                        });

                    }
                });

        });

    }
</script>
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            buttons: [
                {
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });
</script>
<script>
	//<?php echo ($vv["t_id"]); ?>','<?php echo ($vv["name"]); ?>','<?php echo ($vv["briday"]); ?>','<?php echo ($vv["phone"]); ?>','<?php echo ($vv["school"]); ?>'
    function doedit(id,phone) {
        //alert(id);
        $("#getid").val(id);
        $("#getphone").val(phone);
    }
</script>
<script>
    $(function () {
        var l = $( '.ladda-button-demo' ).ladda();
        $("#postadmin").click(function () {
            l.ladda( 'start' );
            getid=$("#getid").val();
            getphone=$("#getphone").val();
            $.post(
                "<?php echo U('User/edituser');?>",
                {
                    'uid':getid,
                    'phone':getphone
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
                            text: "是否存在空字段"
                        });
                        l.ladda('stop');
                    }
                });

        })
    })
</script>

</body>

</html>