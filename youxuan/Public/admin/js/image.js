/*图片上传js*/
$(function() {
    $("#uploadimg").uploadify({
        'swf'      : swf,
        'uploader' : image_upload_url,
        'buttonText':'上传二维码',
        'fileTypeDesc':'Image files',
        'fileObjName':'file',
        'fileTypeExts':'*.gif;*.jpg;*.png',
        'onUploadSuccess' : function(file, data, response) {//上传成功的回调方法
            console.log(data);
            if (response){
                var obj=JSON.parse(data);
                $("#showimg").attr('src',"/tp3/gongzhong/Public/admin/uploads/"+obj.data);
                $("#file_upload_image").attr('value',"admin/uploads/"+obj.data);
                $("#showimg").show();
                $('#deletes').show();
            }
        }
    });
    $("#fimg").uploadify({
        'swf'      : swf,
        'uploader' : image_upload_url,
        'buttonText':'上传封面',
        'fileTypeDesc':'Image files',
        'fileObjName':'file',
        'fileTypeExts':'*.gif;*.jpg;*.png',
        'onUploadSuccess' : function(file, data, response) {//上传成功的回调方法
            console.log(data);
            if (response){
                var obj=JSON.parse(data);
                $("#showfimg").attr('src',"/tp3/gongzhong/Public/admin/uploads/"+obj.data);
                $("#fuploadimg").attr('value',"admin/uploads/"+obj.data);
                $("#showfimg").show();
                $('#deletef').show();
            }
        }
    });
});