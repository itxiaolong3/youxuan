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
 * Class OrderadminController
 * @package Home\Controller
 * 后台订单管理
 */
class OrderadminController extends Controller {
    function index()
   {
       $getphone=session('session_phone');
       $getpassword=session('session_password');
       if (!empty($getphone)&&!empty($getpassword)){
           $shopinfo=M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->find();
           //全部（代客，待提货，已提货）
           $orderinfo=M('order')
               ->alias('o')
               ->join("yx_goods g on o.ogid=g.gid")
               ->join("yx_user u on o.ouid=u.uid")
               ->field("o.*,g.*,u.*")//需要显示的字段
               ->where('(o.ostatus=1 or o.ostatus=2) and o.osid='.$shopinfo['did'])
               ->select();//所有信息
           $this->orderinfo=$orderinfo;
           //代客订单
           $daiinfo=M('order')
               ->alias('o')
               ->join("yx_goods g on o.ogid=g.gid")
               ->join("yx_user u on o.ouid=u.uid")
               ->field("o.*,g.*,u.*")//需要显示的字段
               ->where('(o.ostatus=1 or o.ostatus=2) and o.oiske=1 and o.osid='.$shopinfo['did'])
               ->select();//所有信息
           $this->daiinfo=$daiinfo;
           //待提货订单
           $nogetinfo=M('order')
               ->alias('o')
               ->join("yx_goods g on o.ogid=g.gid")
               ->join("yx_user u on o.ouid=u.uid")
               ->field("o.*,g.*,u.*")//需要显示的字段
               ->where('o.oiske=0 and o.ostatus=1 and o.osid='.$shopinfo['did'])
               ->select();//所有信息
           $this->nogetinfo=$nogetinfo;
           //已提货
           $getinfo=M('order')
               ->alias('o')
               ->join("yx_goods g on o.ogid=g.gid")
               ->join("yx_user u on o.ouid=u.uid")
               ->field("o.*,g.*,u.*")//需要显示的字段
               ->where('o.oiske=0 and o.ostatus=2 and o.osid='.$shopinfo['did'])
               ->select();//所有信息
           $this->getinfo=$getinfo;
           //判断是否有数据
           $this->allinfosize=$orderinfo|count;
           $this->daikesize=$daiinfo|count;
           $this->nopaysize=$nogetinfo|count;
           $this->getsize=$getinfo|count;
           $this->display('Orderadmin/index');

       }else{
           $this->redirect("Loginadmin/index");
       }

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