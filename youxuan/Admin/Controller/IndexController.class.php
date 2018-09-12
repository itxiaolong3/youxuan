<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 23:13
 */
namespace Admin\Controller;
class indexController extends \Think\Controller{
    function index(){
        $getphone=session('session_name');
        $getsid=I('sid');
        if(!empty($getsid)){
            $getphone=session("session_sid".$getsid);
            //session("session_sid",$getsid);
        }
        //是否是总管理员进去的
        $getsuperadminname=session('session_superadmin');
        if (!empty($getphone)||!empty($getsuperadminname)){
            $getsid=session("session_sid".$getsid);
            $infoModel=M('configinfo');
            $shopModel=M('shop');
            if(!empty($getsuperadminname)){
                $configinfo=$infoModel->where('sid='.I('sid'))->select();//所有信息
                $shopinfo = $shopModel->where('did='.I('sid'))->find();
                $this->sid=I('sid');
            }else{
                $configinfo=$infoModel->where('sid='.$getsid)->select();//所有信息
                $shopinfo = $shopModel->where('did='.$getsid)->find();
                $this->sid=$getsid;
            }
            $this->configs=$configinfo;
            $this->shopinfo=$shopinfo;
            // var_dump($configinfo);
            $this->name=$getphone;

            $this->fromadmin=$getsuperadminname;
            $this->title=$configinfo[0]['title'].'首页';
            $this->display();
        }else{
            $getsid=I('sid');
            $this.redirect(__MODULE__."/User/mylogin?sid=".$getsid);
        }

    }
}