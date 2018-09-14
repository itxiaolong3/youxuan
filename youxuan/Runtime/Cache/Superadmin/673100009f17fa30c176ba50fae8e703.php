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
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"><span>                            <img alt="image"
                                                                                                 class="img-circle"
                                                                                                 src="/youxuan/youxuan/Public/admin/img/profile_small.jpg"/>                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="clear"> <span
                                class="block m-t-xs">  <strong class="font-bold"><?php echo ($name); ?></strong>                             </span> <span
                                class="text-muted text-xs block">更多<b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="javascript:logout();">注销</a></li>
                        </ul>
                    </div>
                    <div class="logo-element"> 展开</div>
                </li>
                <li><a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">店铺管理</span> <span
                        class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Shoplist/shoplist" target="main">店铺列表</a></li>
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Addshop/addshop" target="main">添加店铺</a></li>
                    </ul>
                </li>
                <li><a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">商品管理</span> <span
                        class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Goodslist/goodslist" target="main">商品列表</a></li>
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Addgoods/addgoods" target="main">添加商品</a></li>
                       <li><a href="/youxuan/youxuan/index.php/Superadmin/Goodslist/goodtichen" target="main">商品提成表</a></li>
                    </ul>
                </li>
                <li><a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">规格管理</span> <span
                        class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Addcolor/index" target="main">颜色管理</a></li>
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Addformat/index" target="main">尺寸管理</a></li>
                    </ul>
                </li>
                <li class="active"><a href="/youxuan/youxuan/index.php/Superadmin/Configinfo/configinfo" target="main"><i
                        class="fa fa-diamond"></i> <span class="nav-label">站点设置</span></a></li>
                <li><a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">订单管理</span> <span
                        class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Orderlist/orderlist" target="main"> <span class="nav-label">全部订单</span></a>
                        </li>
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Orderlist/nopay" target="main"> <span class="nav-label">待付款</span></a>
                        </li>
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Orderlist/payorder" target="main"> <span
                                class="nav-label">待提货</span></a></li>
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Orderlist/finishedorder" target="main"><span
                                class="nav-label">完成订单</span></a></li>
                    </ul>
                </li>
                <li><a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">分销管理</span> <span
                        class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Jiaoyi/jiaoyi" target="main"> <span class="nav-label">交易记录</span></a>
                        </li>
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Tixian/tixian" target="main"> <span class="nav-label">提现审核</span></a>
                        </li>
                    </ul>
                </li>
                <li><a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">售后管理</span> <span
                        class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/Aftersale/aftersale?sid=<?php echo ($sid); ?>" target="main"><i
                                class="fa fa-shield"></i> <span class="nav-label">售后订单</span></a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">人员管理</span><span
                        class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/youxuan/youxuan/index.php/Superadmin/User/superuser" target="main">管理员</a> <a
                                href="/youxuan/youxuan/index.php/Superadmin/User/vipuser?sid=<?php echo ($sid); ?>" target="main"><span
                                class="nav-label">用户管理</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                        class="fa fa-bars"></i> </a></div>
                <ul class="nav navbar-top-links navbar-right">
                    <li></li>
                    <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#"> <span
                            class="m-r-sm text-muted welcome-message">欢迎进入<?php echo ($configs[0]["title"]); ?>总后台管理系统</span> </a></li>
            </nav>
        </div>                <!--主体内容-->
        <iframe name="main" frameborder="0" style="margin: 0;" src="/youxuan/youxuan/index.php/Superadmin/Configinfo/configinfo" height="720px"
                width="100%" scrolling="auto"></iframe>
        <div class="footer" style="text-align: center;">
            <div> <?php echo ($configs[0]["copyright"]); ?></div>
        </div>
    </div>
</div>        <!--引入外部js文件-->
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
<script>            $(document).ready(function () {
    $('.dataTables-example').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{extend: 'excel', title: 'ExampleFile'}]
    });
    /*$("#side-menu li").click(function() {					if($(this).attr('class') == "active") {						//$(this).siblings().removeClass("active");						//alert("可以吗");					} else {						//$(this).addClass("active").siblings().removeClass("active");					}				});*/
});        </script>        <!--确认注销-->
<script>            function logout() {
    swal({title: "确定要退出吗", text: "点击确定后直接退出系统。如需进入再次登录即可", showCancelButton: true}, function () {
        window.top.location.href = "/youxuan/youxuan/index.php/Superadmin/User/loginout";
    });
}        </script>
<script type="text/javascript">            $(function () {
    $('#showtoast,#showtoast2').click(function () {
        var shortCutFunction = "warning"; //显示类型					var msg = "该功能还没开发";					var title = "温馨提示";					//显示框的参数，位置、特效					toastr.options = {						"closeButton": true,						"debug": false,						"progressBar": false,						"preventDuplicates": false,						"positionClass": "toast-top-center",						"onclick": null,						"showDuration": "400",						"hideDuration": "1000",						"timeOut": "1000", //显示时长						"extendedTimeOut": "1000",						"showEasing": "swing",						"hideEasing": "linear",						"showMethod": "fadeIn",						"hideMethod": "fadeOut"					};					//显示提示框					toastr[shortCutFunction](msg, title);				});			})		</script>
</body></html>