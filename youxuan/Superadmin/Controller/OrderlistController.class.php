<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:52
 */

namespace Superadmin\Controller;

use Think\Controller;

class OrderlistController extends Controller
{
    function orderlist()
    {
        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $orderModel=M('order');
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->join('left join yx_shop AS s ON o.osid=s.did')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,s.dname")//需要显示的字段
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
                $allinfo[$k]['opaymoney']=$v['opaymoney'];
            }
            $this->info=$allinfo;
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }

    //待支付订单
    function nopay()
    {
        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $orderModel=M('order');
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->join('left join yx_shop AS s ON o.osid=s.did')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,s.dname")//需要显示的字段
                ->where('o.ostatus=0 ')
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
                $allinfo[$k]['opaymoney']=$v['opaymoney'];
            }
            $this->info=$allinfo;
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }
    //待提货
    function payorder()
    {

        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $orderModel=M('order');
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->join('left join yx_shop AS s ON o.osid=s.did')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,s.dname")//需要显示的字段
                ->where('o.ostatus=1')
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
            }
            $this->info=$allinfo;
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }
    //已完成的订单
    function finishedorder()
    {
        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $orderModel=M('order');
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->join('left join yx_shop AS s ON o.osid=s.did')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,s.dname")//需要显示的字段
                ->where('o.ostatus=2')
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
            }
            $this->info=$allinfo;
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }
}