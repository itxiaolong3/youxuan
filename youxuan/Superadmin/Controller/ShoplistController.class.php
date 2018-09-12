<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Superadmin\Controller;
use Think\Controller;
class ShoplistController extends Controller{
    function shoplist(){
        $getname=session('session_superadmin');
        if (!empty($getname)){
            $infoModel=M('shop');
            $allinfo=$infoModel->where("dis_delete=0")->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['daddtime']=date('Y-m-d',$v['daddtime']);
                //$allinfo[$k]['notice']=htmlspecialchars_decode($v['notice']);
            }
            $this->info=$allinfo;

            // $this->assign("info",$allinfo);//传递所有信息
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }
    //生成二维码
    function getqrcorde(){
        //生成二维码
        $sid=I('get.sid');
        $getrooturl=$_SERVER['HTTP_HOST'];
        $url="http://".$getrooturl.'/tp3/youxuan?sid='.$sid;
        $level=3;
        $size=4;
        Vendor('phpqrcode.phpqrcode');
        $errorCorrectionLevel =intval($level) ;//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        //生成二维码图片
        $object = new \QRcode();
        $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
    }
    //删除店铺
    function deleteshop(){
        $upCtypeModel=M('shop');
        $arr=array();
        if (!empty($_POST)){
            $getid=$_POST['id'];
            $data['dis_delete']=1;
           $re=$upCtypeModel->where('did='.$getid)->delete();
            if ($re){
                $arr['status']=1;
                $arr['msg']='删除成功';
                echo json_encode($arr);
            }else{
                $arr['status']=0;
                $arr['msg']='删除失败';
                echo json_encode($arr);
            }
        }

    }
   //关闭店铺
    function closeshop(){
        $upCtypeModel=M('shop');
        $arr=array();
        if (!empty($_POST)){
            $getid=$_POST['id'];
         
            $colsestatus=$upCtypeModel->where('did='.$getid)->getField('discolse');
            if ($colsestatus){
                //如果是关闭的
                $data['discolse']=0;
            }else{
                $data['discolse']=1;
            }
            $re=$upCtypeModel->where('did='.$getid)->save($data);
            if ($re){
                $arr['status']=1;
                $arr['msg']='关闭成功';
                echo json_encode($arr);
            }else{
                $arr['status']=0;
                $arr['msg']='关闭失败';
                echo json_encode($arr);
            }
        }

    }
    //修改店铺
    function editshop(){
        $getid=I('did');
        if(IS_POST){
//            var_dump(I('post.'));
//            exit();
            $id=I('did');
            $arr=array();
            $data=I('post.');
            $data['daddtime']=time();
            $classModel = M('shop');
            if(empty($data['dname'])){
                $arr['status']=-1;
                $arr['msg']='店名不可为空';
                echo json_encode($arr);
                exit();
            } else if(empty(I('dheaderimg'))){
                $arr['status']=-2;
                $arr['msg']='头像不可为空';
                echo json_encode($arr);
                exit();
            }
            else if(empty(I('dphone'))){
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
                $re = $classModel->where('did='.$id)->save($data);
                if ($re) {
                    $arr['status']=1;
                    $arr['msg']='修改成功';
                    echo json_encode($arr);
                    exit();
                } else {
                    $arr['status']=0;
                    $arr['msg']='修改失败发生未知错误';
                    echo json_encode($arr);
                    exit();
                }
            }

        }else{
            $classModel=M('shop');
            $classdata=$classModel->where('did='.$getid)->find();
            $this->classinfo=$classdata;
            //var_dump($classdata);
            $this->display();
        }
    }

}