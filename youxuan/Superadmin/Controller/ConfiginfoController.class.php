<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Superadmin\Controller;
use Think\Controller;
class ConfiginfoController extends Controller{
    function configinfo(){
        $infoModel=M('configinfo');
        $allinfo=$infoModel->where('sid=0')->select();//所有信息
        $this->info=$allinfo;
        if(IS_POST){
            //var_dump(I('post.'));
            $arr=array();
            $data=I('post.');
            $data['addtime']=time();
            $re = $infoModel->where('sid=0')->save($data);
            if ($re) {
                $arr['status']=1;
                $arr['msg']='更新成功';
                echo json_encode($arr);
                exit();
            } else {
                $arr['status']=0;
                $arr['msg']='更新失败';
                echo json_encode($arr);
                exit();
            }
        }else{
            $this->display();
        }


    }

}