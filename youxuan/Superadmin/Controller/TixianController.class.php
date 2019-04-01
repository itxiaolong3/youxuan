<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:52
 */

namespace Superadmin\Controller;

use Think\Controller;

class TixianController extends Controller
{
    function tixian()
    {
        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $infoModel=M('tixian');
          	$infoModel->where('xsid=0')->delete();
            $allinfo=$infoModel
                ->alias('x')
                ->join('left join yx_shop AS s ON s.did=x.xsid')
                ->field("x.*,s.dname,s.did,s.dnickname,s.dnum")//需要显示的字段
                ->where('x.xtype=0')
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['xaddtime']=date('Y-m-d h:i:s',$v['xaddtime']);
            }
            //待确认
            $isdeal=$infoModel
                ->alias('x')
                ->join('left join yx_shop AS s ON s.did=x.xsid')
                ->field("x.*,s.dname,s.dnickname,s.dnum")//需要显示的字段
                ->where('x.xtype=1')
                ->select();//所有信息
            foreach ($isdeal as $k=>$v){
                $isdeal[$k]['xaddtime']=date('Y-m-d h:i:s',$v['xaddtime']);
            }
            $this->info=$allinfo;
            $this->isdeal=$isdeal;
           ///var_dump($isdeal);
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }

    //确认提现订单
    function sureorder()
    {
        $houModel = M('tixian');// 实例化User对象
        $arr=array();
        $id=I('id');
        $sid=I('sid');
        $rmoney=I('rmoney');
        $data['xtype']=1;
        $data['xaddtime']=time();
        $re=$houModel->where('xid='.$id)->save($data);
        if ($re){
            //提现成功后给记录表添加一条提现记录
            $jiaoyidata['rtype']=2;
            $jiaoyidata['rsid']=$sid;
            $jiaoyidata['rmoney']=$rmoney;
            $jiaoyidata['raddtime']=time();
            $jiaoyimodel=M('jiaoyi');
            $addre=$jiaoyimodel->add($jiaoyidata);
            if($addre){
                //添加提现记录到交易表成功后更新此时的余额
                //余额计算公式：此时余额=提成类型-退款类型-提现类型-提现表中状态为0的审核中类型值
                $tichennum=$jiaoyimodel->where('rsid='.$sid." and rtype=0")->sum('rmoney');  //提成类型值
                $tuikuannum=$jiaoyimodel->where('rsid='.$sid." and rtype=1")->sum('rmoney');  //退款类型值
                $tixiannum=$jiaoyimodel->where('rsid='.$sid." and rtype=2")->sum('rmoney');  //提现类型值
                $shenhenum=$houModel->where('xsid='.$sid." and xtype=0")->sum('xshenprice');  //审核中金额
                //余额
                $yue=($tichennum-$tuikuannum-$tixiannum-$shenhenum);
                //更新交易表中对应的余额
                $datajiaoyi['ryue']=$yue;
                $datajiaoyi['raddtime']=time();
                $updatayuere=$jiaoyimodel->where('rid='.$addre)->save($datajiaoyi);
                if($updatayuere){
                    $arr['status']=1;
                    $arr['msg']='处理完成';
                    echo json_encode($arr);
                }else{
                    $arr['status']=-1;
                    $arr['msg']='更新交易表中的余额时出错';
                    echo json_encode($arr);
                }
            }
        }else{
            $arr['status']=0;
            $arr['msg']='处理失败';
            echo json_encode($arr);
        }


    }
    //删除订单
    function deletetixian(){
        $upCtypeModel=M('tixian');
        $arr=array();
        if (!empty($_POST)){
            $getid=$_POST['id'];
            $re=$upCtypeModel->where('xid='.$getid)->delete();
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
}