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
 * Class CashapplyController
 * @package Home\Controller
 * 申请提现
 */
class CashapplyController extends Controller {
    function index()
   {
       $getphone=session('session_phone');
       $getpassword=session('session_password');
       $shopinfo=M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->find();
       //提成类型
       $tctotal=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=0")->sum('rmoney');
       //退款类型
       $tktotal=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=1")->sum('rmoney');
       //提现类型，这里应该是提现表中已经打款的提现类型，而不是记录表中的提现类型。否则会跟提现中金额冲突了，会导致数据有误
       //$txtotal=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=2")->sum('rmoney');
       $txtotal=M('tixian')->where('xsid='.$shopinfo['did'].' and xtype=1')->sum('xshenprice');
       //提现表中的提现中金额
       $txzhongtotal=M('tixian')->where('xsid='.$shopinfo['did'].' and xtype=0')->sum('xshenprice');
       $yue=$tctotal-($tktotal+$txtotal+$txzhongtotal);
       $this->enablemoney=number_format($yue,2);
       $this->sid=$shopinfo['did'];
       $this->display("Cashapply/index");
    }
    //提现方法
    function tixian(){
        $getmoney=I('txmoney');
        $yue=I('yue');
        $sid=I('sid');
        //向交易表中添加一条提现记录，这里只是显示用作
        $jiaoyi['rtype']=2;
        //这里的余额只是提供交易表中使用，具体计算方法如下：提成类型-退款类型-提现类型-提现表中的提现中金额
        $jiaoyi['ryue']=$yue-$getmoney;
        $jiaoyi['rmoney']=$getmoney;
        $jiaoyi['rsid']=$sid;
        $jiaoyi['raddtime']=time();
        $jiaoyi['rordertime']=date('Y-m-d h:i:s',time());
        $getid=M('jiaoyi')->add($jiaoyi);
        //在提现表中添加一条审核中记录
        $tixian['xsid']=$sid;
        $tixian['xtype']=0;
        $tixian['xshenprice']=$getmoney;
        $tixian['xaddtime']=time();
        $tixianre=M('tixian')->add($tixian);
        if ($getid&&$tixianre){
            $this->redirect("Cash/index");
        }else{
            $this->redirect('Cash/index', "", 1, '提现出现异常');
        }
    }

}