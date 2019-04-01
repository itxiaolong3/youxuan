<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Think\Controller;

class RefundController extends Controller {
    /**
     * 售后订单
     */
    function index()
   {
       $getphone=cookie('session_phone');
       $getpassword=cookie('session_password');
       if (!empty($getphone)&&!empty($getpassword)){
           $shopinfo=M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->find();
           //已提货
           $orderinfo=M('order')
               ->alias('o')
               ->join("yx_goods g on o.ogid=g.gid")
               ->join("yx_user u on o.ouid=u.uid")
               ->field("o.*,g.*,u.*")//需要显示的字段
               ->where('o.ostatus=2 and o.osid='.$shopinfo['did'])
               ->select();//所有信息
           $this->orderinfo=$orderinfo;
           //申请记录
           $houinfo=M('hou')
               ->alias('h')
               ->join("yx_goods g on h.hgid=g.gid")
               ->join("yx_user u on h.huid=u.uid")
               ->field("h.*,g.*,u.*")//需要显示的字段
               ->where('h.hsid='.$shopinfo['did'])
               ->select();//所有信息
           $this->houinfo=$houinfo;
           $this->display("Refund/index");

       }else{
           $this->redirect("Loginadmin/index");
       }

    }
    //添加售后表记录，交易记录表中的退款记录等后台确认退款了才添加
    public function dorefund(){
        //$getdata=I('post.');
        $getdata['hsid']=I('hsid');
        $getdata['huid']=I('huid');
        $getdata['hphone']=I('hphone');
        $getdata['hgid']=I('hgid');
        $getdata['hordernum']=I('hordernum');
        $getdata['haddtime']=date('Y-m-d h:i:s',time());
        $getdata['htype']=0;
        $re=M('hou')->add($getdata);
        if ($re){
            $updatas['ostatus']=3;
            M('order')->where('oid='.I('oid'))->save($updatas);
            $arr=array();
            $arr['code']=0;
            $arr['msg']='添加售后记录成功';
            echo json_encode($arr);
        }else{
            $arr=array();
            $arr['code']=-1;
            $arr['msg']='add refund fail';
            echo json_encode($arr);
        }
    }


}