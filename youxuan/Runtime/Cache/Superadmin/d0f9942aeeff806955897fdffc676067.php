<?php if (!defined('THINK_PATH')) exit();?><!--引入头部文件，如css--><!DOCTYPE html>
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


</head>	<body style="background: none;">		<div class="wrapper wrapper-content animated fadeInRight">			<!--主体部分-->			<div class="row">				<div class="col-sm-12">					<div class="clients-list">						<div class="table-responsive">							<div id="tab-2" class="tab-pane">								<div class="panel-body">									<form method="post" class="form-horizontal"  enctype="multipart/form-data">									<fieldset class="form-horizontal">										<input type="hidden" name="id" value="<?php echo ($info[0]["id"]); ?>">										<div class="form-group"><label class="col-sm-2 control-label">站点名称:<?php echo ($info["title"]); ?></label>											<div class="col-sm-10"><input type="text" class="form-control" value="<?php echo ($info[0]["title"]); ?>" name="title" required="required" placeholder="公司名称"/></div>										</div>										<div class="form-group"><label class="col-sm-2 control-label">版权信息:</label>											<div class="col-sm-10"><input type="text" class="form-control" name="copyright" value="<?php echo ($info[0]["copyright"]); ?>" required="required" placeholder="版权信息"/></div>										</div>										<div class="form-group"><label class="col-sm-2 control-label">appId:</label>											<div class="col-sm-10"><input type="text" class="form-control" value="<?php echo ($info[0]["appid"]); ?>" name="appid" required="required" placeholder="appId"/></div>										</div>										<div class="form-group"><label class="col-sm-2 control-label">appSecret:</label>											<div class="col-sm-10"><input type="text" class="form-control" name="appsecret" value="<?php echo ($info[0]["appsecret"]); ?>" required="required" placeholder="appSecret"/></div>										</div>										<div class="form-group"><label class="col-sm-2 control-label">支付商户号:</label>											<div class="col-sm-10"><input type="text" class="form-control" value="<?php echo ($info[0]["payshopnum"]); ?>" name="payshopnum" required="required" placeholder="支付商户号"/></div>										</div>										<div class="form-group"><label class="col-sm-2 control-label">支付密钥:</label>											<div class="col-sm-10"><input type="text" class="form-control" name="paykey" value="<?php echo ($info[0]["paykey"]); ?>" required="required" placeholder="支付密钥"/></div>										</div>										<div class="form-group"><label class="col-sm-2 control-label">短信模板code:</label>											<div class="col-sm-10"><input type="text" class="form-control" name="smscode" value="<?php echo ($info[0]["smscode"]); ?>" required="required" placeholder="短信模板code"/></div>										</div>										<div class="form-group"><label class="col-sm-2 control-label">短信签名:</label>											<div class="col-sm-10"><input type="text" class="form-control" name="smssign" value="<?php echo ($info[0]["smssign"]); ?>" required="required" placeholder="短信签名"/></div>										</div>										<div class="form-group"><label class="col-sm-2 control-label">短信AccessKey ID:</label>											<div class="col-sm-10"><input type="text" class="form-control" name="accesskeyid" value="<?php echo ($info[0]["accesskeyid"]); ?>" required="required" placeholder="AccessKey ID"/></div>										</div>										<div class="form-group"><label class="col-sm-2 control-label">短信accesskeysecret:</label>											<div class="col-sm-10"><input type="text" class="form-control" name="accesskeysecret" value="<?php echo ($info[0]["accesskeysecret"]); ?>" required="required" placeholder="短信accesskeysecret"/></div>										</div>									</fieldset>										<div class="col-sm-10" style="width: 100%;text-align: center;">											<button class ="ladda-button ladda-button-demo btn btn-primary"data-style ="zoom-in" id="postdata">保存并提交</button>										</div>									</form>								</div>							</div>						</div>					</div>				</div>			</div>		</div>		<!--引入头部文件，如css-->		<!--这里写引入的js文件-->
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
<script src="/youxuan/youxuan/Public/admin/js/plugins/iCheck/icheck.min.js"></script>		<script>            $(document).ready(function(){                var l = $( '.ladda-button-demo' ).ladda();                $('#postdata').click(function () {                        l.ladda( 'start' );                        var data = $('form').serializeArray();                        $.post("",data,function(e){                            e = JSON.parse(e);                            console.log(e);                            if(e.status==1){                                window.location.reload();                                l.ladda('stop');                            }else{                                swal({                                    title: "保存失败",                                    text: "发生未知错误"                                });                                l.ladda('stop');							}                        })                })            });		</script>	</body></html>