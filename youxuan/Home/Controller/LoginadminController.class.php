<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Think\Controller;

class LoginadminController extends Controller {
    function index()
   {
       if (IS_POST){
           $getphone=I('phone');
           $getpassword=I('password');
           $getshopinfo=$this->checkPwName($getphone,$getpassword);
           if($getshopinfo){
               session("session_phone", $getshopinfo['dphone']);
               session("session_password", $getshopinfo['dpassword']);
               $this->redirect("/Home/Indexadmin/index?sid=".$getshopinfo['did']);
           }else{
               $this->redirect('Loginadmin/index', "", 1, '用户名或密码不对');
           }
       }else{
           $this->display("Loginadmin/index");
       }
    }
    public  function checkPwName($phone,$psw){
        //先查用户名是否存在再配对密码是否一致
        $info=M('shop')->where("dphone='".$phone."'")->find();
        if ($info){
            if ($info['dpassword']===$psw){
                //登录成功
                return $info;
            }
        }else{
            return "";
        }
    }

}