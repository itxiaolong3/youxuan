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
 * Class CashrecordController
 * @package Home\Controller
 * 交易明细
 */
class CashrecordController extends Controller {
    function index()
   {
       $getphone=session('session_phone');
       $getpassword=session('session_password');
       $shopinfo=M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->find();
       $sid=$shopinfo['did'];
       //全部记录
       $allinfo=M('jiaoyi')->where('rsid='.$sid)->select();
       foreach ($allinfo as $k=>$v){
           $allinfo[$k]['raddtime']=date('Y-m-d',$v['raddtime']);
       }
       $this->allinfo=$allinfo;
       //收益记录
       $getinfo=M('jiaoyi')->where('rsid='.$sid.' and rtype=0')->select();
       foreach ($getinfo as $k=>$v){
           $getinfo[$k]['raddtime']=date('Y-m-d',$v['raddtime']);
       }
       $this->getinfo=$getinfo;
       //支出记录
       $outinfo=M('jiaoyi')->where('rsid='.$sid.' and (rtype=1 or rtype=2)')->select();
       foreach ($outinfo as $k=>$v){
           $outinfo[$k]['raddtime']=date('Y-m-d',$v['raddtime']);
       }
       $this->outinfo=$outinfo;

       $this->display("Cashrecord/index");
    }

}