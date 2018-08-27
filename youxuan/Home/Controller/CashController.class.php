<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Think\Controller;

/**
 * Class CashController
 * @package Home\Controller
 * 结算中心
 */
class CashController extends Controller {
    function index()
   {
       $getphone=session('session_phone');
       $getpassword=session('session_password');
       if (!empty($getphone)&&!empty($getpassword)){


       $shopinfo=M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->find();
       //提成类型
       $tctotal=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=0")->sum('rmoney');
       //退款类型
       $tktotal=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=1")->sum('rmoney');
       //提现类型
       //$txtotal=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=2")->sum('rmoney');
       $txtotal=M('tixian')->where('xsid='.$shopinfo['did'].' and xtype=1')->sum('xshenprice');
       //提现表中的提现中金额
       $txzhongtotal=M('tixian')->where('xsid='.$shopinfo['did'].' and xtype=0')->sum('xshenprice');
       $yue=$tctotal-($tktotal+$txtotal+$txzhongtotal);
       $this->enablemoney=number_format($yue,2);
       $this->allmoney=number_format($yue+$txzhongtotal,2);
       $this->txzhong=number_format($txzhongtotal,2);
       $this->display("Cash/index");
       }else{
           $this->redirect("Loginadmin/index");
       }
    }

}