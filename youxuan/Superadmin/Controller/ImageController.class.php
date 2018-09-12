<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Superadmin\Controller;
//tp5中需要引入use think/Request
use Think\Controller;
use Think\Upload;
class ImageController extends Controller{
   public function upload(){
       /**
        * tp5中需要引入Request请求类
        * $file=Request::instance()->file('file);
        */
       $data=[
           'status'=>1,
           'mes'=>'OK',
           'data'=>'https://pj.dede1.com/attachment/images/99/2018/07/GiPW61id1f49GYvC6l9GYiYiyIVWU5.jpg'
       ];
       echo json_encode($data);
   }
   public function uploadfortp(){
       if ($_FILES) {
           if($_FILES['file'][error]<4){
               $arg=array(
                   'rootPath'      =>  './Public/admin/uploads/', //保存根路径
               );
               //处理上传文件
               $upload=new Upload($arg);
               //返回传到服务器后的名称和地址等信息
               $re=$upload->uploadOne($_FILES['file']);//如果上传多个文件就不用$_FILES参数，且改用upload()来上传
               //原图的保存路径
               $imgPath=$re['savepath'].$re['savename'];
               $data=[
                   'status'=>1,
                   'mes'=>'OK',
                   'data'=>$imgPath,
               ];
               echo json_encode($data);
           }
       }
   }
    public function uploadvideo(){
        if ($_FILES) {
            if($_FILES['file'][error]<4){
                $arg=array(
                    'rootPath'      =>  './Public/uploadvideo/', //保存根路径
                );
                //处理上传文件
                $upload=new Upload($arg);
                //返回传到服务器后的名称和地址等信息
                $re=$upload->uploadOne($_FILES['file']);//如果上传多个文件就不用$_FILES参数，且改用upload()来上传
                //原图的保存路径
                $videoPath=$re['savepath'].$re['savename'];
                $data=[
                    'status'=>1,
                    'mes'=>'OK',
                    'data'=>$videoPath,
                ];
                echo json_encode($data);
            }
        }
    }
   public function uploadfornotice(){
       if ($_FILES) {
           if($_FILES['file'][error]<4){
               $arg=array(
                   'rootPath'      =>  './Public/admin/editimg/', //保存根路径
               );
               //处理上传文件
               $upload=new Upload($arg);
               //返回传到服务器后的名称和地址等信息
               $re=$upload->uploadOne($_FILES['file']);//如果上传多个文件就不用$_FILES参数，且改用upload()来上传
               //原图的保存路径
               $imgPath=$re['savepath'].$re['savename'];

               echo "/tp3/youxuan/Public/admin/editimg/".$imgPath;
           }
       }
   }


}