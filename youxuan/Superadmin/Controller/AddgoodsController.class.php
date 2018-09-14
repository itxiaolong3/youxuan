<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Superadmin\Controller;
use Think\Controller;
class AddgoodsController extends Controller{
    function addgoods(){
        if(IS_POST){
            $arr=array();
            $data=I('post.');
            $colors=I('color');
            $formats=I('format');
            $colorstr=implode(',',$colors);
            $formatstr=implode(',',$formats);
            $data['gcolor']=$colorstr;
            $data['gformat']=$formatstr;

            $data['gaddtime']=time();
            //对图片进行小处理
            $data['gimgs']=substr($data['gimgs'],1);
            $classModel = M('goods');
            if(empty($data['gtopimg'])){
                $arr['status']=-1;
                $arr['msg']='封面图不可为空';
                echo json_encode($arr);
                exit();
            }
            else if(empty($data['gtitle'])){

                $arr['status']=-2;
                $arr['msg']='商品名不可为空';
                echo json_encode($arr);
                exit();
            }else if(empty($data['gyhprice'])){
                $arr['status']=-3;
                $arr['msg']='价格不可为空';
                echo json_encode($arr);
                exit();
            }else if(empty($data['gticheng'])){
                $arr['status']=-4;
                $arr['msg']='提成不可为空';
                echo json_encode($arr);
                exit();
            }else{
              if(empty($data['guptime'])){
                    $data['gstatus']=1;
                }
                $re = $classModel->data($data)->add();
                if ($re) {
                    $arr['status']=1;
                    $arr['msg']='添加成功';
                    echo json_encode($arr);
                    exit();
                } else {
                    $arr['status']=0;
                    $arr['msg']='添加失败发生未知错误';
                    echo json_encode($arr);
                    exit();
                }
            }

        }else{
            $getcolor=M('color')->select();
            $getformat=M('format')->select();
            $this->colors=$getcolor;
            $this->formats=$getformat;
            $this->display();
        }


    }
    //批量图片上传,需要配置Admin/Conf/config.php的J方法
    function uploadImg() {
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->rootPath = './'; // 设置附件上传根目录
        $upload->savePath = './Public/admin/uploads/'; // 设置附件上传（子）目录
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        } else {// 上传成功
            foreach ($info as $file) {
                print_r(J(__ROOT__ . '/' . $file['savepath'] . $file['savename']));
            }
        }
    }
    //多图片的删除
    function del() {
        $src = str_replace(__ROOT__ . '/', '', str_replace('//', '/', I('src')));
        if (file_exists($src)) {
            unlink($src);
        }
        print_r('|'.I('src'));
        exit();
    }
    //单图片的删除
    function delone() {
        $src = str_replace(__ROOT__ . '/', '', str_replace('//', '/', I('src')));
        if (file_exists($src)) {
            unlink($src);
        }
        print_r(I('src'));
        exit();
    }

}