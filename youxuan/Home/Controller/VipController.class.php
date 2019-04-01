<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Think\Controller;

class VipController extends Controller {
    function index()
   {
       $getphone=cookie('session_phone');
       $getpassword=cookie('session_password');
       $shopinfo=M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->find();
       $sid=$shopinfo['did'];
       $allvipinfo=M('user')->where('shopid='.$sid)->select();
       foreach ($allvipinfo as $k=>$v){
           $allvipinfo[$k]['uaddtime']=date('Y-m-d',$v['uaddtime']);
           $allvipinfo[$k]['ordernum']= M('order')->where('ouid='.$v['uid'].' and ostatus>=1')->count();
           $allvipinfo[$k]['ordermoney']=number_format(M('order')->where('ouid='.$v['uid'].' and ostatus>=1')->sum('opaymoney'),2);
       }
       $this->allvipinfo=$allvipinfo;
       $this->display("Vip/index");
    }

}