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
	<body style="background: none;">
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<div style="margin-top: 10px;"></div>
					<ol class="breadcrumb">

						<li class="active">
							<label>完成的订单:&nbsp;一共<span style="color: #0d8ddb;font-weight: bold;font-size: 25px;"><?php echo ($finishedcount); ?></span>单</label>
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
								<div class="tab-content">
									<div id="tab-2">
										<div class="full-height-scroll">
											<div class="table-responsive">
												<table class="table table-striped  dataTables-example">
													<thead>
													<tr>
														<th>提单号</th>
														<th>商品图片</th>
														<th>商品名称</th>
														<th>订单来源</th>
														<th>订单号</th>
														<th>价格</th>
														<th>数量</th>
														<th>实付金额</th>
														<th>手机号</th>
														<th>用户名</th>
														<th>添加时间</th>
													</tr>
													</thead>
													<tbody>
													<?php if(is_array($info)): foreach($info as $key=>$v): ?><tr class="gradeX">
														<td class="center"><?php echo ($v["oid"]); ?></td>
														<td><img src="/youxuan/youxuan/Public/<?php echo ($v["gtopimg"]); ?>" width="45" height="45" /></td>
														<td><?php echo ($v["gtitle"]); ?></td>
														<td><?php echo ($v["dname"]); ?></td>
														<td><?php echo ($v["onumber"]); ?></td>
														<td><?php echo ($v["gyhprice"]); ?></td>
														<td><?php echo ($v["onum"]); ?></td>
														<td><?php echo ($v["opaymoney"]); ?></td>
														<td><?php echo ($v["ouserphone"]); ?></td>
														<td><?php echo ($v["ousername"]); ?></td>
														<td><?php echo ($v["oaddtime"]); ?></td>
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
	</body>

</html>