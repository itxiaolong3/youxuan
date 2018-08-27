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

		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<div style="margin-top: 10px;"></div>
					<ol class="breadcrumb">
						<li class="active">
							<span>提现订单</span>
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
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#tab-1"><i class="fa fa-bar-chart-o"></i>待审核</a>
									</li>

									<li class="">
										<a data-toggle="tab" href="#tab-3"><i class="fa fa-briefcase"></i>完成提现</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="tab-1" class="tab-pane active">
										<div class="full-height-scroll">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<tbody>
														<tr>
															<th>id</th>
															<th>订单来源</th>
															<th>提现金额</th>
															<th>申请时间</th>
															<th>操作</th>
														</tr>
														<?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
															<td><?php echo ($v["xid"]); ?></td>
															<td><?php echo ($v["dname"]); ?></td>
															<td><?php echo ($v["xshenprice"]); ?></td>
															<td><?php echo ($v["xaddtime"]); ?></td>
															<td>
																<a type="button" class="btn btn-primary btn-xs" data-toggle="modal" href='javascript:sureorder("<?php echo ($v["xid"]); ?>","<?php echo ($v["did"]); ?>","<?php echo ($v["xshenprice"]); ?>");'>确认处理</a>
															</td>
														</tr><?php endforeach; endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!--已处理-->
									<div id="tab-3" class="tab-pane">
										<div class="full-height-scroll">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<tbody>
													<tr>
														<th>id</th>
														<th>订单来源</th>
														<th>提现金额</th>
														<th>申请时间</th>
														<th>操作</th>
													</tr>
													<?php if(is_array($isdeal)): foreach($isdeal as $key=>$v): ?><tr>
															<td><?php echo ($v["xid"]); ?></td>
															<td><?php echo ($v["dname"]); ?></td>
															<td><?php echo ($v["xshenprice"]); ?></td>
															<td><?php echo ($v["xhaddtime"]); ?></td>
															<td>
																<a type="button" class="btn btn-warning btn-xs" data-toggle="modal" href='javascript:deletes("<?php echo ($v["xid"]); ?>");'>拒绝并删除</a>
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
		<script>

		</script>
			<!--删除订单-->
			<script>
				function deletes(id) {
                    getid=id;
					swal({
						title: "拒绝退款后用户提成金额将会恢复！",
						text: "请谨慎操作",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "是的, 删除先",
						closeOnConfirm: false
					}, function() {

                        $.post(
                            "<?php echo U('Tixian/deletetixian');?>",
							{
							    id:getid
							},
							function(e){
							console.log(e);
							 obj=JSON.parse(e);
							if(obj.status){
                                swal("已删除", "成功提示", "success");
                                window.location.reload();
							}else{
                                swal("删除失败", "温馨提示", "fail");
                                window.location.reload();
							}
                        });

					})
				}
				//确认订单
                function sureorder(id,sid,xshenprice) {
                    getid=id;
                    swal({
                        title: "确认提示",
                        text: "确认订单后表示已经完成此次提现，是否执行？",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "是的, 已经打款了",
                        closeOnConfirm: false
                    }, function() {

                        $.post(
                            "<?php echo U('Tixian/sureorder');?>",
                            {
                                id:getid,
								sid:sid,
								rmoney:xshenprice
                            },
                            function(e){
                                console.log(e);
                                obj=JSON.parse(e);
                                if(obj.status){
                                    swal("已处理", "成功提示", "success");
                                    window.location.reload();
                                }else if(obj.status==-1){
                                    swal("更新余额时出错", "失败提示", "fail");
                                    window.location.reload();
								}else{
                                    swal("处理失败", "温馨提示", "fail");
                                    window.location.reload();
                                }
                            });

                    })

                }
			</script>

	</body>

</html>