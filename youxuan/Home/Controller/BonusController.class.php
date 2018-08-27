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
 * Class BonusController
 * @package Home\Controller
 * 我的提成控制器
 */
class BonusController extends Controller {
    function index()
   {
       $getphone=session('session_phone');
       $getpassword=session('session_password');
       if (!empty($getphone)&&!empty($getpassword)){
        // substr(date('Y-m-d',time()),2);
       //今日提成
       $todayticheng=M('order')
           ->alias('o')
           ->join("yx_goods g on o.ogid=g.gid")
           ->field("o.buynum,o.ordertime,o.oaddtime,o.ogid,o.osid,g.gtitle,g.gticheng")//需要显示的字段
           ->where('o.ostatus=2'.' and to_days(ordertime) = to_days(now())')
           ->select();//所有信息
       $totaltoday=array();
       foreach ($todayticheng as $k=>$v){
           $todayticheng[$k]['oaddtime']=substr(date('Y-m-d',$v['oaddtime']),2);
           array_push($totaltoday,$v['buynum']*$v['gticheng']);
       }
       $this->totaltoday=number_format(array_sum($totaltoday),2);
       $this->todayticheng=$todayticheng;

       //本周提成YEARWEEK(date_format(ordertime,'%Y-%m-%d')) = YEARWEEK(now())
       $weekticheng=M('order')
           ->alias('o')
           ->join("yx_goods g on o.ogid=g.gid")
           ->field("o.buynum,o.ordertime,o.oaddtime,o.ogid,o.osid,g.gtitle,g.gticheng")//需要显示的字段
           ->where('o.ostatus=2'." and YEARWEEK(date_format(ordertime,'%Y-%m-%d')) = YEARWEEK(now())")
           ->select();//所有信息
       $totalweek=array();
       foreach ($weekticheng as $k=>$v){
           $weekticheng[$k]['oaddtime']=substr(date('Y-m-d',$v['oaddtime']),2);
           array_push($totalweek,$v['buynum']*$v['gticheng']);
       }
       $this->totalweek=number_format(array_sum($totalweek),2);
       $this->weekticheng=$weekticheng;

       //本月提成DATE_FORMAT( ordertime, '%Y%m' ) = DATE_FORMAT( CURDATE( ) , '%Y%m' )
       $monthticheng=M('order')
           ->alias('o')
           ->join("yx_goods g on o.ogid=g.gid")
           ->field("o.buynum,o.ordertime,o.oaddtime,o.ogid,o.osid,g.gtitle,g.gticheng")//需要显示的字段
           ->where('o.ostatus=2'." and DATE_FORMAT( ordertime, '%Y%m' ) = DATE_FORMAT( CURDATE( ) , '%Y%m' )")
           ->select();//所有信息
       $totalmonth=array();
       foreach ($monthticheng as $k=>$v){
           $monthticheng[$k]['oaddtime']=substr(date('Y-m-d',$v['oaddtime']),2);
           array_push($totalmonth,$v['buynum']*$v['gticheng']);
       }
       $this->totalmonth=number_format(array_sum($totalmonth),2);
       $this->monthticheng=$monthticheng;

       //累计提成，所有
       $allticheng=M('order')
           ->alias('o')
           ->join("yx_goods g on o.ogid=g.gid")
           ->field("o.buynum,o.ordertime,o.oaddtime,o.ogid,o.osid,g.gtitle,g.gticheng")//需要显示的字段
           ->where('o.ostatus=2')
           ->select();//所有信息
       $totalall=array();
       foreach ($allticheng as $k=>$v){
           $allticheng[$k]['oaddtime']=substr(date('Y-m-d',$v['oaddtime']),2);
           array_push($totalall,$v['buynum']*$v['gticheng']);
       }
       $this->totalall=number_format(array_sum($totalall),2);
       $this->allticheng=$allticheng;
       $this->display("Bonus/index");
       }else{
           $this->redirect("Loginadmin/index");
       }
    }

}