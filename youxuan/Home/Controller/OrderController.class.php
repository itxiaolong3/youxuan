<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Think\Controller;

class OrderController extends Controller {
    function index()
   {
       $geti=I('i');
       $getsid=I('sid');
      $this->sid=$getsid;
       $openid=session('session_islogin'.$getsid);
      $user=M('user')->where('openid='.'"'.$openid.'"')->find();
       //全部订单
       $allorderinfo=M('order')
           ->alias('o')
           ->join("yx_goods g on o.ogid=g.gid")
           ->field("o.*,g.*")//需要显示的字段
           ->where('o.osid='.$getsid.' and o.ouid='.$user['uid'])
           ->select();//所有信息
       foreach ($allorderinfo as $k=>$v){
           $allorderinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
       }
       //待付款
       $nopayinfo=M('order')
           ->alias('o')
           ->join("yx_goods g on o.ogid=g.gid")
           ->field("o.*,g.*")//需要显示的字段
           ->where('o.ostatus=0 and o.osid='.$getsid.' and o.ouid='.$user['uid'])
           ->select();//所有信息
       foreach ($nopayinfo as $k=>$v){
           $nopayinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
       }
       //已付款，未取货
       $payinfo=M('order')
           ->alias('o')
           ->join("yx_goods g on o.ogid=g.gid")
           ->field("o.*,g.*")//需要显示的字段
           ->where('o.ostatus=1 and o.osid='.$getsid.' and o.ouid='.$user['uid'])
           ->select();//所有信息
       foreach ($payinfo as $k=>$v){
           $payinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
       }
       //已提货
       $finisheorderinfo=M('order')
           ->alias('o')
           ->join("yx_goods g on o.ogid=g.gid")
           ->field("o.*,g.*")//需要显示的字段
           ->where('o.ostatus=2 and o.osid='.$getsid.' and o.ouid='.$user['uid'])
           ->select();//所有信息
       foreach ($finisheorderinfo as $k=>$v){
           $finisheorderinfo[$k]['oaddtime']=date('Y-m-d h:i:s',$v['oaddtime']);
       }

       $this->allorderinfo=$allorderinfo;
       $this->nopayinfo=$nopayinfo;
       $this->payinfo=$payinfo;
       $this->finisheorderinfo=$finisheorderinfo;
       $this->i=$geti;
       //判断是否有数据
       $this->allinfosize=$allorderinfo|count;
       $this->nopaysize=$nopayinfo|count;
       $this->finishesize=$finisheorderinfo|count;
       $this->paysize=$payinfo|count;
      $this->display('Order/index');
    }
  //确认提货
public function updatastatus(){
       $getoid= I('oid');
       $getstatus=I('status');
       $getonum=I('onum');
  	   $num=explode('x', $getonum);
       $getonum=intval($num[1]);
       $data['ostatus']=$getstatus;
       $re=M('order')->where('oid='.$getoid)->save($data);
       $arr=array();
       if($re){
         //确认提货
        if ($getstatus==2){
            //在交易表中填加一条提成记录
                $jiaoyi['rtype']=0;
                //这里的余额只是提供交易表中使用，具体计算方法如下：提成类型-退款类型-提现类型-提现表中的提现中金额
                //余额的计算是在插入数据成功后再更新
                $jiaoyi['ryue']=0;
                $getsid=M('order')->where('oid='.$getoid)->find();
                //获取提成金额
                $goods=M('goods')->where('gid='.$getsid['ogid'])->find();
                $jiaoyi['rmoney']=$goods['gticheng']*$getonum;
                $jiaoyi['rsid']=$getsid['osid'];
         		$jiaoyi['raddtime']=time();
                $jiaoyi['rordertime']=date('Y-m-d h:i:s',time());
                $getid=M('jiaoyi')->add($jiaoyi);
                //更新余额
                if ($getsid){
                    //提成类型
                    $tctotal=M('jiaoyi')->where('rsid='.$getsid['osid']." and rtype=0")->sum('rmoney');
                    //退款类型
                    $tktotal=M('jiaoyi')->where('rsid='.$getsid['osid']." and rtype=1")->sum('rmoney');
                    //提现类型
                    //$txtotal=M('jiaoyi')->where('rsid='.$getsid['osid']." and rtype=2")->sum('rmoney');
                    $txtotal=M('tixian')->where('xsid='.$getsid['osid'].' and xtype=1')->sum('xshenprice');
                    //提现表中的提现中金额
                    $txzhongtotal=M('tixian')->where('xsid='.$getsid['osid'].' and xtype=0')->sum('xshenprice');
                    $yue=$tctotal-($tktotal+$txtotal+$txzhongtotal);
                    $yuedata['ryue']=$yue;
                    //更新余额
                    M('jiaoyi')->where('rid='.$getid)->save($yuedata);
                }
        }
           $arr['code']=0;
           echo json_encode($arr);
       }else{
           $arr['code']=1;
           echo json_encode($arr);
       }
    }
}