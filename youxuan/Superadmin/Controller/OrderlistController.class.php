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
            $getsid=I('sid');
            if (empty($getsid)){
                $allinfo=$orderModel
                    ->alias('o')
                    ->join('left join yx_goods AS g ON o.ogid=g.gid')
                    ->join('left join yx_shop AS s ON o.osid=s.did')
                    ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,s.dname")//需要显示的字段
                    ->select();//所有信息
            }else{
                $allinfo=$orderModel
                    ->alias('o')
                    ->join('left join yx_goods AS g ON o.ogid=g.gid')
                    ->join('left join yx_shop AS s ON o.osid=s.did')
                    ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,s.dname")
                    ->where('did='.$getsid)
                    ->select();
            }
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
                $allinfo[$k]['opaymoney']=$v['opaymoney'];
            }
            $this->info=$allinfo;
          $this->sid=$getsid;
           if(empty($getsid)){
                $this->allcount=$orderModel->where('ostatus<3')->count();
            }else{
                $this->allcount=$orderModel->where('ostatus<3 and osid='.$getsid)->count();
            }
           $this->allshop=M('shop')->field('did,discolse,dname')->select();
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
           $this->nopaycount=$orderModel->where('ostatus=0')->count();
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
           $this->paycount=$orderModel->where('ostatus=1')->count();
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
           $this->finishedcount=$orderModel->where('ostatus=2')->count();
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }
}