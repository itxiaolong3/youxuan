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
							<span>交易记录</span>
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
										<a data-toggle="tab" href="#tab-0"><i class="fa fa-bar-chart-o"></i>提成记录</a>
									</li>

									<li class="">
										<a data-toggle="tab" href="#tab-1"><i class="fa fa-briefcase"></i>退款记录</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i>提现记录</a>
									</li>
								</ul>

								<div class="tab-content">
									<!--提成记录-->
									<div id="tab-0" class="tab-pane active">
										<div class="full-height-scroll">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<tbody>
														<tr>
															<th>id</th>
															<th>订单来源</th>
															<th>交易金额</th>
															<th>账户余额</th>
															<th>操作时间</th>
														</tr>
														<?php if(is_array($ticheninfo)): foreach($ticheninfo as $key=>$v): ?><tr>
															<td><?php echo ($v["rid"]); ?></td>
															<td><?php echo ($v["dname"]); ?></td>
															<td><?php echo ($v["rmoney"]); ?></td>
															<td><?php echo ($v["ryue"]); ?></td>
															<td><?php echo ($v["raddtime"]); ?></td>
														</tr><?php endforeach; endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!--退款记录-->
									<div id="tab-1" class="tab-pane active">
										<div class="full-height-scroll">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<tbody>
													<tr>
														<th>id</th>
														<th>订单来源</th>
														<th>交易金额</th>
														<th>账户余额</th>
														<th>操作时间</th>
													</tr>
													<?php if(is_array($tuikuaninfo)): foreach($tuikuaninfo as $key=>$v1): ?><tr>
															<td><?php echo ($v1["rid"]); ?></td>
															<td><?php echo ($v1["dname"]); ?></td>
															<td><?php echo ($v1["rmoney"]); ?></td>
															<td><?php echo ($v1["ryue"]); ?></td>
															<td><?php echo ($v1["raddtime"]); ?></td>
														</tr><?php endforeach; endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!--提现记录-->
									<div id="tab-2" class="tab-pane active">
										<div class="full-height-scroll">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<tbody>
													<tr>
														<th>id</th>
														<th>订单来源</th>
														<th>交易金额</th>
														<th>账户余额</th>
														<th>操作时间</th>
													</tr>
													<?php if(is_array($tixianinfo)): foreach($tixianinfo as $key=>$v2): ?><tr>
															<td><?php echo ($v2["rid"]); ?></td>
															<td><?php echo ($v2["dname"]); ?></td>
															<td><?php echo ($v2["rmoney"]); ?></td>
															<td><?php echo ($v2["ryue"]); ?></td>
															<td><?php echo ($v2["raddtime"]); ?></td>
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
		<!--查看商品信息-->
		<!-- 模态框（Modal） -->
		<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">
							商品信息
						</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="ibox float-e-margins">
									<fieldset class="form-horizontal">
										<div class="form-group">
											<div class="layui-upload">
												<label class="col-sm-2 control-label">商品图片：</label>
												<div class="layui-inline col-sm-10" >
													<div class="layui-input-inline">
														<img src="" id="imgs" width="60" height="60" />
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="layui-upload">
												<label class="col-sm-2 control-label">商品：</label>
												<div class="layui-inline col-sm-10" >
													<div class="layui-input-inline">
														<input type="text" class="layui-input" disabled="disabled" id="gname"/>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="layui-upload">
												<label class="col-sm-2 control-label">订单号：</label>
												<div class="layui-inline col-sm-10" >
													<div class="layui-input-inline">
														<input type="text" class="layui-input" disabled="disabled" id="gnum"/>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="layui-upload">
												<label class="col-sm-2 control-label">价格：</label>
												<div class="layui-inline col-sm-10" >
													<div class="layui-input-inline">
														<input type="text" class="layui-input" style="color: red" disabled="disabled" id="gprice"/>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="layui-upload">
												<label class="col-sm-2 control-label">申请时间：</label>
												<div class="layui-inline col-sm-10" >
													<div class="layui-input-inline">
														<input type="text" class="layui-input" disabled="disabled" id="saddtime"/>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="layui-upload">
												<label class="col-sm-2 control-label">手机号：</label>
												<div class="layui-inline col-sm-10" >
													<div class="layui-input-inline">
														<input type="text" class="layui-input" disabled="disabled" id="gphone"/>
													</div>
												</div>
											</div>
										</div>


									</fieldset>
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
		<!--编辑框结束-->
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

            $(document).ready(function (){
                var l = $( '.ladda-button-demo' ).ladda();
                $("#sub").click(function () {
                    l.ladda( 'start' );
                    getval=$("#tname").val();
                    $.post(
                        "<?php echo U('Classtype/addclasstype');?>",
						{'t_name':getval}
						,function(e){
                        e = JSON.parse(e);
                        console.log(e);
                        if(e.status==1){
                            window.location.href = "<?php echo U('Classtype/classtype');?>";
                            l.ladda('stop');
                        }else{
                            swal({
                                title: "添加失败",
                                text: "发生未知错误"
                            });
                            l.ladda('stop');
                        }
                    });

                });
                $("#postedit").click(function () {
                    l.ladda( 'start' );
                    getid=$("#getid").val();
                    getname=$("#getname").val();
                    $.post(
                        "<?php echo U('Classtype/editclasstype');?>",
                        {
                            't_name':getname,
							't_id':getid
						}
                        ,function(e){
                            e = JSON.parse(e);
                            console.log(e);
                            if(e.status==1){
                                window.location.href = "<?php echo U('Classtype/classtype');?>";
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
            });

		</script>
		<script>

		</script>
			<!--删除售后订单-->
			<script>
				function deletes(id) {
                    getid=id;
					swal({
						title: "确定要删除该售后申请订单吗？",
						text: "请谨慎操作",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "是的, 删除先",
						closeOnConfirm: false
					}, function() {

                        $.post(
                            "<?php echo U('Aftersale/deleteaftersale');?>",
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
				//确认售后订单
                function sureorder(id) {
                    getid=id;
                    swal({
                        title: "确认提示",
                        text: "确认订单后表示已经完成该售后订单的出来，是否执行？",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "是的, 已经打款了",
                        closeOnConfirm: false
                    }, function() {

                        $.post(
                            "<?php echo U('Aftersale/sureorder');?>",
                            {
                                id:getid
                            },
                            function(e){
                                console.log(e);
                                obj=JSON.parse(e);
                                if(obj.status){
                                    swal("已处理", "成功提示", "success");
                                    window.location.reload();
                                }else{
                                    swal("处理失败", "温馨提示", "fail");
                                    window.location.reload();
                                }
                            });

                    })

                }
			</script>
			<script>
				function edits(id) {
					//alert(id);
                    $.post(
                        "<?php echo U('Aftersale/getdetail');?>",
                        {
                            hid:id
                        },
                        function(e){
                            obj=JSON.parse(e);
                            info=obj.data[0];
//imgs gname gnum gprice saddtime  gphone
						$("#imgs").attr('src','/tp3/youxuan/Public/'+info.gtopimg);
						$("#gname").val(info.gtitle);
						$("#gnum").val(info.hordernum);
						$("#gprice").val(info.gyhprice);
						$("#saddtime").val(info.haddtime);
						$("#gphone").val(info.hphone);
                        });
//					$("#getid").val(id);
//					$("#getname").val(name);
				}
			</script>
	</body>

</html>