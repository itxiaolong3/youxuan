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
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <div style="margin-top: 15px;"></div>
            <ol class="breadcrumb">
                <li><a href="javascript:history.back(-1)" target="_parent">商品列表</a></li>
                <li class="active"><span>编辑商品</span></li>
            </ol>
        </div>
    </div>            <!--主体部分-->
    <div class="row">
        <div class="col-sm-12">
            <div class="clients-list">
                <div class="table-responsive">
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <fieldset class="form-horizontal"><input type="hidden" name="gid"
                                                                         value="<?php echo ($classinfo["gid"]); ?>">
                                    <div class="form-group"><label class="col-sm-2 control-label">商品名称:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" name="gtitle"
                                                                      required="required" value="<?php echo ($classinfo["gtitle"]); ?>"
                                                                      placeholder="商品名称"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">颜色:</label>
                                        <div class="col-sm-10">
                                            <?php if(is_array($colors)): foreach($colors as $k=>$v): ?><div class="box">
                                                        <div class="check-box">
                                                        <input type="checkbox" name="color[]"  id="checkbox<?php echo ($k); ?>" value="<?php echo ($v["cname"]); ?>"/><label for="checkbox<?php echo ($k); ?>"><?php echo ($v["cname"]); ?></label>
                                                        </div>
                                                </div><?php endforeach; endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">规格:</label>
                                        <div class="col-sm-10">
                                            <?php if(is_array($formats)): foreach($formats as $k=>$v): ?><div class="box">
                                                    <div class="ggcheck-box">
                                                    <input type="checkbox" name="format[]"  id="ggcheckbox<?php echo ($k); ?>" value="<?php echo ($v["ggname"]); ?>"/><label for="ggcheckbox<?php echo ($k); ?>"><?php echo ($v["ggname"]); ?></label>
                                                    </div>
                                                </div><?php endforeach; endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">商品简介:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" name="gdes"
                                                                      required="required" value="<?php echo ($classinfo["gdes"]); ?>"
                                                                      placeholder="商品简介，广告语"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">原价/元:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" name="gprice"
                                                                      required="required" value="<?php echo ($classinfo["gprice"]); ?>"
                                                                      placeholder="不参加优惠的价格"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">优惠价格/元:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" name="gyhprice"
                                                                      required="required" value="<?php echo ($classinfo["gyhprice"]); ?>"
                                                                      placeholder="实际买卖价格"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">限量数:</label>
                                        <div class="col-sm-10"><input type="text" required="required" name="gendnum"
                                                                      class="form-control" value="<?php echo ($classinfo["gendnum"]); ?>"
                                                                      placeholder="限量用户购买数"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">提成:</label>
                                        <div class="col-sm-10"><input type="text" required="required" name="gticheng"
                                                                      class="form-control" value="<?php echo ($classinfo["gticheng"]); ?>"
                                                                      placeholder="提成"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">排序:</label>
                                        <div class="col-sm-10"><input type="number" required="required" name="gorder"
                                                                      class="form-control" value="<?php echo ($classinfo["gorder"]); ?>"
                                                                      placeholder="默认为0"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">供应商:</label>
                                        <div class="col-sm-10"><input type="text" required="required" name="gboss"
                                                                      class="form-control" value="<?php echo ($classinfo["gboss"]); ?>"
                                                                      placeholder="商品供应商"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">品牌:</label>
                                        <div class="col-sm-10"><input type="text" required="required" name="gpingpai"
                                                                      class="form-control" value="<?php echo ($classinfo["gpingpai"]); ?>"
                                                                      placeholder="品牌"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">产地:</label>
                                        <div class="col-sm-10"><input type="text" required="required" name="gaddress"
                                                                      class="form-control" value="<?php echo ($classinfo["gaddress"]); ?>"
                                                                      placeholder="产地"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="layui-upload"><label class="col-sm-2 control-label">商品结束时间：</label>
                                            <div class="layui-inline col-sm-10">
                                                <div class="layui-input-inline"><input type="text" class="layui-input"
                                                                                       name="gendtime" id="test5"
                                                                                       value="<?php echo ($classinfo["gendtime"]); ?>"
                                                                                       placeholder="选填"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="layui-upload"><label class="col-sm-2 control-label">预售时间：</label>
                                            <div class="layui-inline col-sm-10">
                                                <div class="layui-input-inline"><input type="text" class="layui-input"
                                                                                       name="gbuypretime" id="test11"
                                                                                       placeholder="MM月dd日"
                                                                                       value="<?php echo ($classinfo["gbuypretime"]); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="layui-upload "><label class="col-sm-2 control-label">提货时间：</label>
                                            <div class="layui-inline col-sm-10">
                                                <div class="layui-input-inline"><input type="text" class="layui-input"
                                                                                       name="gbuyendtime" id="test12"
                                                                                       placeholder="MM月dd日"
                                                                                       value="<?php echo ($classinfo["gbuyendtime"]); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  <div class="form-group">
                                        <div class="layui-upload ">
                                            <label class="col-sm-2 control-label">预设上架时间：</label>
                                            <div class="layui-inline col-sm-10">
                                                <div class="layui-input-inline">
                                                    <input type="text" class="layui-input" name="guptime" id="test13" placeholder="年-月-日 时:分:秒" value="<?php echo ($classinfo["guptime"]); ?>">(不选则立即上架)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">封面图片：</label>
                                        <div class="layui-upload col-sm-10">
                                            <button type="button" class="layui-btn" id="test1">封面图片</button>
                                            <div class="layui-upload-list">
                                                <?php if($classinfo["gtopimg"] == '' ): ?><input type="hidden"
                                                                                                 id="file_upload_image"
                                                                                                 required="required"
                                                                                                 name="gtopimg"
                                                                                                 multiple="true"
                                                                                                 value=""/>
                                                    <div id="showimg"></div>
                                                    <p id="demoText"></p>
                                                    <?php else: ?>
                                                    <input type="hidden" id="file_upload_image" required="required"
                                                           name="gtopimg" multiple="true" value="<?php echo ($classinfo["gtopimg"]); ?>"/>
                                                    <div id="showimg">
                                                        <li><img class='layui-upload-img' id='showone'
                                                                 src="/youxuan/youxuan/Public/<?php echo ($classinfo["gtopimg"]); ?>"
                                                                 style='width:100px;height:100px;'> <img class='button'
                                                                                                         onclick="deletefimg('/youxuan/youxuan/Public/<?php echo ($classinfo["gtopimg"]); ?>');"
                                                                                                         id='oneimgclose'
                                                                                                         src="/youxuan/youxuan/Public/images/fancy_close.png">
                                                        </li>
                                                    </div>
                                                    <p id="demoText"></p><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">商品图片集</label>
                                        <div class="layui-upload col-sm-10">
                                            <div class="layui-upload">
                                                <button type="button" class="layui-btn" id="test3">多图片上传</button>
                                                <?php if($classinfo["gimgs"] == '' ): ?><blockquote class="layui-elem-quote layui-quote-nm"
                                                                style="margin-top: 10px;"> 预览图：
                                                        <div class="layui-upload-list" id="demo3"></div>
                                                    </blockquote>
                                                    <input type="hidden" name="gimgs" id="manyimg" value=""/>
                                                    <?php else: ?>
                                                    <blockquote class="layui-elem-quote layui-quote-nm"
                                                                style="margin-top: 10px;"> 预览图：
                                                        <div class="layui-upload-list" id="demo3">
                                                            <?php if(is_array($arrs)): $k = 0; $__LIST__ = $arrs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($k % 2 );++$k;?><li id="li<?php echo ($k); ?>"><img class='layui-upload-img'
                                                                                     src="<?php echo ($vv); ?>"
                                                                                     style='width:100px;height:100px;'>
                                                                    <img class='button' onclick="del('<?php echo ($vv); ?>','<?php echo ($k); ?>');"
                                                                         src="/youxuan/youxuan/Public/images/fancy_close.png"></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </div>
                                                    </blockquote>
                                                    <input type="hidden" name="gimgs" id="manyimg"
                                                           value="|<?php echo ($classinfo["gimgs"]); ?>"/><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="clear: both"><label class="col-sm-2 control-label">注意事项</label>
                                        <input value="" type="hidden" name="gcomment" id="editnotice">
                                        <div class="col-sm-10">
                                            <div id="summernote"> <?php echo ($classinfo["gcomment"]); ?></div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div id="content"></div>
                                <div class="col-sm-10" style="width: 100%;text-align: center;">
                                    <button class="ladda-button ladda-button-demo btn btn-primary" data-style="zoom-in"
                                            id="postdata">保存并提交
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
<script type="text/javascript">
    var path = '/youxuan/youxuan/Public';
var url = '/youxuan/youxuan/index.php/Superadmin/Goodslist';
</script>
<script>
    var colorarray = [];
    var formatarray = [];
    <?php if(is_array($thiscolor)): foreach($thiscolor as $key=>$vv): ?>colorarray.push("<?php echo ($vv); ?>");<?php endforeach; endif; ?>
    <?php if(is_array($thisformat)): foreach($thisformat as $key=>$vv): ?>formatarray.push("<?php echo ($vv); ?>");<?php endforeach; endif; ?>
    $('.check-box input').each(function () {
        if(isInArray(colorarray,$(this).val())){
            $(this).prop('checked','true');
        }
    });
    $('.ggcheck-box input').each(function () {
        if(isInArray(formatarray,$(this).val())){
            $(this).prop('checked','true');
        }
    });
    function isInArray(arr,value){
        for(var i = 0; i < arr.length; i++){
            if(value === arr[i]){
                return true;
            }
        }
        return false;
    }

</script>
<!--时间选择-->
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
    $(document).ready(function(){
        var l = $( '.ladda-button-demo' ).ladda();
        var $summernote=  $('#summernote').summernote({
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
            var markupStr = $('#summernote').summernote('code').trim();
            //alert(markupStr);
            //把编辑器中的内容放入input中一起提交
            $("#editnotice").attr('value',markupStr);
            var data = $('form').serializeArray();
            //开始提交数据进行保存
            $.post("<?php echo U('Goodslist/editgoods');?>",data,function(e){
                e = JSON.parse(e);
                console.log(e);
                if(e.status==1){
                    window.location.href = "<?php echo U('Goodslist/goodslist');?>";
                    l.ladda('stop');
                }else{
                    swal({
                        title: "编辑失败",
                        text: e.msg
                    });
                    l.ladda('stop');
                }
            })

        })


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
                if ($("#file_upload_image").val()){
                    $("#file_upload_image").attr('value',"admin/uploads/"+res.data);
                    $("#showone").attr('src',"/youxuan/youxuan/Public/admin/uploads/"+res.data);
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
    });

    function del(imgurl,imgid) {
        if(imgurl=='[object Object]' || imgurl=='' || imgurl=='undefined'){
            //alert('进入无值');
            var src=$(this).siblings('img').attr('src');
        }else{
            // alert('#li'+imgid);
            $('#li'+imgid).remove();
            var src=imgurl;
        }
        // var src=$(this).siblings('img').attr('src');
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
</script>

<script>
    function deletefimg(imgss) {
        if(imgss=='[object Object]' || imgss=='' || imgss=='undefined'){
            //alert('进入无值');
            var src=$(this).siblings('img').attr('src');
        }else{
            $('#showimg li').remove();
            var src=imgss;
        }
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
</script>
</body></html>