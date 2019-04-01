<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 23:13
 */
namespace Superadmin\Controller;
class indexController extends \Think\Controller{
    function index(){
        $getphone=session('session_superadmin');
        if (!empty($getphone)){
            $infoModel=D('configinfo');
            $configinfo=$infoModel->select();//所有信息
            $this->configs=$configinfo;
            // var_dump($configinfo);
            $this->name=$getphone;
            $this->title='总管理员首页';
            $isadmin=M('admin')->where("name="."'".$getphone."'")->getField('isadmin');
            $this->isadmin=$isadmin;
            $this->display("Index/index");
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }

    }
}