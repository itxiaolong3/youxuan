<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:52
 */

namespace Admin\Controller;

use Think\Controller;

class OrderlistController extends Controller
{
    function orderlist()
    {
        //下一步，订单属于店铺
        //这个似乎没用
        //$getname=session('session_name');
        $getsid=I('sid');
        if(!empty($getsid)){
            $getname=session("session_sid".$getsid);
            //session("session_sid",$getsid);
        }
        $getsuperadminname=session('session_superadmin');
        if (!empty($getname)||!empty($getsuperadminname)){
            $orderModel=M('order');
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid")//需要显示的字段
                ->where(' o.osid='.$getsid)
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
                $allinfo[$k]['opaymoney']=$v['opaymoney']/1000;
            }
            $this->info=$allinfo;
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin?sid=".$getsid);
        }
    }

    //待支付订单
    function nopay()
    {
        $getsid=I('sid');
        if(!empty($getsid)){
            $getname=session("session_sid".$getsid);
        }
        $getsuperadminname=session('session_superadmin');
        if (!empty($getname)||!empty($getsuperadminname)){
            $orderModel=M('order');
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid")//需要显示的字段
                ->where('o.ostatus=0 and o.osid='.$getsid)
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
                $allinfo[$k]['opaymoney']=$v['opaymoney']/1000;
            }
            $this->info=$allinfo;
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin?sid=".$getsid);
        }
    }
    //待提货
    function payorder()
    {
        $getsid=I('sid');
        if(!empty($getsid)){
            $getname=session("session_sid".$getsid);
        }
        $getsuperadminname=session('session_superadmin');
        if (!empty($getname)||!empty($getsuperadminname)){
            $orderModel=M('order');
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid")//需要显示的字段
                ->where('o.ostatus=1 and o.osid='.$getsid)
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
            }
            $this->info=$allinfo;
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin?sid=".$getsid);
        }
    }
    //已完成的订单
    function finishedorder()
    {
        $getsid=I('sid');
        if(!empty($getsid)){
            $getname=session("session_sid".$getsid);
        }
        $getsuperadminname=session('session_superadmin');
        if (!empty($getname)||!empty($getsuperadminname)){
            $orderModel=M('order');
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid")//需要显示的字段
                ->where('o.ostatus=2 and o.osid='.$getsid)
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
            }
            $this->info=$allinfo;
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin?sid=".$getsid);
        }
    }
    //确认订单
    function sureorder()
    {
        $houModel = M('hou');// 实例化User对象
        $arr=array();
        $id=I('id');
        $data['htype']=1;
        $data['haddtime']=time();
        $re=$houModel->where('hid='.$id)->save($data);
        if ($re){
            $arr['status']=1;
            $arr['msg']='处理完成';
            echo json_encode($arr);
        }else{
            $arr['status']=0;
            $arr['msg']='处理失败';
            echo json_encode($arr);
        }


    }
    //删除售后订单
    function deleteaftersale(){
        $upCtypeModel=M('hou');
        $arr=array();
        if (!empty($_POST)){
            $getid=$_POST['id'];
            $re=$upCtypeModel->where('hid='.$getid)->delete();
            if ($re){
               $arr['status']=1;
               $arr['msg']='删除成功';
               echo json_encode($arr);
            }else{
                $arr['status']=0;
                $arr['msg']='删除失败';
                echo json_encode($arr);
            }
        }

    }
    function getdetail(){
        $gethid=I('hid');
        $getsid=I('sid');
        $infoModel=M('hou');
        $afterorderinfo=$infoModel
            ->alias('h')
            ->join("yx_user u on h.huid=u.uid")
            ->join('left join yx_goods AS g ON h.hgid=g.gid')
            ->field("h.*,g.*,u.nickname,u.uid")//需要显示的字段
            ->where('h.htype=0 and h.hsid='.$getsid.' and h.hid='.$gethid)
            ->select();//所有信息
        foreach ($afterorderinfo as $k=>$v){
            $afterorderinfo[$k]['haddtime']=date('Y-m-d h:i:s',$v['haddtime']);
        }
        $arr=array();
        $arr['status']=1;
        $arr['data']=$afterorderinfo;
        $arr['msg']='获取数据成功';
        echo json_encode($arr);
    }
}