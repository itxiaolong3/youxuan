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
							<a href="<?php echo U('index/index');?>" target="_parent">首页</a>
						</li>

						<li class="active">
							<strong>商家列表展示</strong>
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
														<th>id</th>
														<th>封面图</th>
														<th>店名</th>
														<th>手机号</th>
														<th>状态</th>
														<th>提货地址</th>
														<!--<th>预售时间</th>-->
														<!--<th>提货时间</th>-->
														<th>添加时间</th>
														<th>店铺链接</th>
														<th>店面二维码</th>
														<th>操作</th>
													</tr>
													</thead>
													<tbody>
													<?php if(is_array($info)): foreach($info as $key=>$v): ?><tr class="gradeX">
														<td class="center"><?php echo ($v["did"]); ?></td>
														<td><img src="/youxuan/youxuan/Public/<?php echo ($v["dheaderimg"]); ?>" width="60" height="60" /></td>
														<td><?php echo ($v["dname"]); ?></td>
														<td><?php echo ($v["dphone"]); ?></td>
														<td width="90"><?php if($v["discolse"] == 0): ?><span style="background-color: #0d8ddb;padding: 5px;color:white;">正在营业</span><?php else: ?><span  style="background-color: lightgray;padding: 5px;color:white;">已停营</span><?php endif; ?></td>
														<td><?php echo ($v["daddress"]); ?></td>
														<!--<td><?php echo ($v["dpretime"]); ?></td>-->
														<!--<td><?php echo ($v["dendtime"]); ?></td>-->
														<td><?php echo ($v["daddtime"]); ?></td>
														<td id="urlid<?php echo ($v["did"]); ?>"><?php echo ($v["durl"]); ?></td>
														<td><img src="/youxuan/youxuan/index.php/Superadmin/Shoplist/getqrcorde?sid=<?php echo ($v["did"]); ?>" width="60" height="60" /></td>
														<!--/youxuan/youxuan/index.php/Superadmin-->
														<!--/youxuan/youxuan-->
														<td>
															<input type="button" onClick="copyUrl('<?php echo ($v["did"]); ?>')" class="btn btn-info btn-xs"  href="javascript:;" style="margin-top: 10px;" value="复制链接"/>
															<a class="btn btn-primary btn-xs"  href="/youxuan/youxuan/index.php/Superadmin/Shoplist/editshop?did=<?php echo ($v["did"]); ?>" target="main" style="margin-top: 10px;">修改</a>
															<a type="button" class="btn btn-danger btn-xs" data-toggle="modal" href="javascript:deletes('<?php echo ($v["did"]); ?>');" style="margin-top: 10px;">删除</a>
                                                          <a type="button" class="btn btn-info btn-xs" data-toggle="modal" href="javascript:colses('<?php echo ($v["did"]); ?>','<?php echo ($v["discolse"]); ?>');" style="margin-top: 10px;"><?php if($v["discolse"] == 0): ?>关闭店铺<?php else: ?>开启店铺<?php endif; ?></a>
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

		</div>
		<!-- 模态框（Modal） -->
		<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModal">
							注意事项详细
						</h4>
					</div>
					<div style="width: 100%;text-align: center">
						<div id="noticedata"></div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal -->
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
		<script>
            function deletes(id) {
                getid=id;
                swal({
                    title: "确定要删除该店铺吗？",
                    text: "删除之后无法恢复",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "是的, 删除先",
                    closeOnConfirm: false
                }, function() {
                    $.post(
                        "<?php echo U('Shoplist/deleteshop');?>",
                        {
                            id:getid
                        },
                        function(e){
                            console.log(e);
                            obj=JSON.parse(e);
                            if(obj.status){
                                swal("已删除", "温馨提示", "success");
                                window.location.reload();
                            }else{
                                swal("删除失败", "温馨提示", "fail");
                                window.location.reload();
                            }
                        });

                })

            }
           function colses(id,iscolse) {
                isc='';
               if(iscolse==1){
                isc='开启';
			   }else{
                   isc='关闭'
			   }
                getid=id;
                swal({
                    title: "确定要"+isc+"该店铺吗？",
                    text: "温馨提示",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "是的",
                    closeOnConfirm: false
                }, function() {
                    $.post(
                        "<?php echo U('Shoplist/closeshop');?>",
                        {
                            id:getid
                        },
                        function(e){
                            console.log(e);
                            obj=JSON.parse(e);
                            if(obj.status){
                                swal("操作成功", "温馨提示", "success");
                                window.location.reload();
                            }else{
                                swal("操作失败", "温馨提示", "fail");
                                window.location.reload();
                            }
                        });

                })

            }
		</script>
		<script>
			function shownotice(data,id) {
				$("#noticedata").html();
				$("#noticedata").html(data);
            }
		</script>
		<script type="text/javascript">
            layui.use('layer', function(){ //独立版的layer无需执行这一句
                var $ = layui.jquery, layer = layui.layer;
            }); //独立版的layer无需执行这一句
            function copyUrl(did)
            {
                var Url2=document.getElementById("urlid"+did).innerText;
                var oInput = document.createElement('input');
                oInput.value = Url2;
                document.body.appendChild(oInput);
                oInput.select(); // 选择对象
                document.execCommand("Copy"); // 执行浏览器复制命令
                oInput.className = 'oInput';
                oInput.style.display='none';
                layer.msg('已复制到粘贴板');
                //alert('复制成功');
            }
		</script>
	</body>

</html>