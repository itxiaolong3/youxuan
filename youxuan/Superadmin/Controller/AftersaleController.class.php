<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:52
 */

namespace Superadmin\Controller;

use Think\Controller;

class AftersaleController extends Controller
{
    function aftersale()
    {
        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $infoModel=M('hou');
            $allinfo=$infoModel
                ->alias('h')
                ->join("yx_user u on h.huid=u.uid")
                ->join('left join yx_goods AS g ON h.hgid=g.gid')
                ->join('left join yx_shop AS s ON s.did=h.hsid')
                ->field("h.*,g.*,u.nickname,u.uid,s.dname,s.dnickname,s.dnum")//需要显示的字段
                ->where('h.htype=0')
                ->select();//所有信息
//            foreach ($allinfo as $k=>$v){
//                $allinfo[$k]['haddtime']=date('Y-m-d h:i:s',$v['haddtime']);
//            }
            $isdeal=$infoModel
                ->alias('h')
                ->join("yx_user u on h.huid=u.uid")
                ->join('left join yx_goods AS g ON h.hgid=g.gid')
                ->join('left join yx_shop AS s ON s.did=h.hsid')
                ->field("h.*,g.*,u.nickname,u.uid,s.dname,s.dnickname,s.dnum")//需要显示的字段
                ->where('h.htype=1')
                ->select();//所有信息
//            foreach ($isdeal as $k=>$v){
//                $isdeal[$k]['haddtime']=date('Y-m-d h:i:s',$v['haddtime']);
//            }
            $this->info=$allinfo;
            $this->isdeal=$isdeal;
           ///var_dump($isdeal);
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
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
        //向记录表中插入状态为1的退款记录
        //在交易表中填加一条提成记录
        $jiaoyi['rtype']=1;
        //这里的余额只是提供交易表中使用，具体计算方法如下：提成类型-退款类型-提现类型-提现表中的提现中金额
        //余额的计算是在插入数据成功后再更新
        $jiaoyi['ryue']=0;
        $getsid=$houModel->where('hid='.$id)->find();
        //获取提成金额
        $goods=M('goods')->where('gid='.$getsid['hgid'])->find();
        $getonum=1;//遗留bug.无法控制退款数量。默认先一个
        $jiaoyi['rmoney']=$goods['gticheng']*$getonum;
        $jiaoyi['rsid']=$getsid['hsid'];
        $jiaoyi['raddtime']=time();
        $jiaoyi['rordertime']=date('Y-m-d h:i:s',time());
        $getid=M('jiaoyi')->add($jiaoyi);
        //更新余额
        if ($getsid){
            //提成类型
            $tctotal=M('jiaoyi')->where('rsid='.$getsid['hsid']." and rtype=0")->sum('rmoney');
            //退款类型
            $tktotal=M('jiaoyi')->where('rsid='.$getsid['hsid']." and rtype=1")->sum('rmoney');
            //提现类型
            //$txtotal=M('jiaoyi')->where('rsid='.$getsid['osid']." and rtype=2")->sum('rmoney');
            $txtotal=M('tixian')->where('xsid='.$getsid['hsid'].' and xtype=1')->sum('xshenprice');
            //提现表中的提现中金额
            $txzhongtotal=M('tixian')->where('xsid='.$getsid['hsid'].' and xtype=0')->sum('xshenprice');
            $yue=$tctotal-($tktotal+$txtotal+$txzhongtotal);
            $yuedata['ryue']=$yue;
            
            //更新余额
            M('jiaoyi')->where('rid='.$getid)->save($yuedata);
            //更新售后表状态
            $re=$houModel->where('hid='.$id)->save($data);
        }

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
        $infoModel=M('hou');
        $afterorderinfo=$infoModel
            ->alias('h')
            ->join("yx_user u on h.huid=u.uid")
            ->join('left join yx_goods AS g ON h.hgid=g.gid')
            ->field("h.*,g.*,u.nickname,u.uid")//需要显示的字段
            ->where('h.htype=0 and h.hid='.$gethid)
            ->select();//所有信息
//        foreach ($afterorderinfo as $k=>$v){
//            $afterorderinfo[$k]['haddtime']=date('Y-m-d h:i:s',$v['haddtime']);
//        }
        $arr=array();
        $arr['status']=1;
        $arr['data']=$afterorderinfo;
        $arr['msg']='获取数据成功';
        echo json_encode($arr);
    }
}