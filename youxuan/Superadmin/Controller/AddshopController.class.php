<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Superadmin\Controller;
use Think\Controller;
class AddshopController extends Controller{
    function addshop(){
        if(IS_POST){
            //var_dump(I('post.'));
            $arr=array();
            $data=I('post.');
            $data['daddtime']=time();
            $classModel = M('shop');
            if(empty(I('dname'))){
                $arr['status']=-1;
                $arr['msg']='店名不可为空';
                echo json_encode($arr);
                exit();
            }else if(empty(I('dphone'))){
                $arr['status']=-4;
                $arr['msg']='手机号不可为空';
                echo json_encode($arr);
                exit();
            }else if(empty(I('dpassword'))){
                $arr['status']=-4;
                $arr['msg']='登录密码不可为空';
                echo json_encode($arr);
                exit();
            }else if(empty(I('daddress'))){
                $arr['status']=-4;
                $arr['msg']='提货地址不可为空';
                echo json_encode($arr);
                exit();
            }else{
                $re = $classModel->data($data)->add();
                if ($re) {
                    $arr['status']=1;
                    $arr['msg']='添加成功';
                    $arr['newid']=$re;
                    //生成店铺链接
                    $getrooturl=$_SERVER['HTTP_HOST'];
                    $durl=$getrooturl.'/tp3/youxuan/?sid='.$re;
                    $updata['durl']=$durl;
                    $classModel->where('did='.$re)->save($updata);
                    echo json_encode($arr);
                    exit();
                } else {
                    $arr['status']=0;
                    $arr['msg']='发生未知错误';
                    echo json_encode($arr);
                    exit();
                }
            }

        }else{
            $this->display();
        }


    }
    //删除图片
    function del() {
        $src = str_replace(__ROOT__ . '/', '', str_replace('//', '/', I('src')));
        if (file_exists($src)) {
            unlink($src);
        }
        print_r(I('src'));
        exit();
    }

}