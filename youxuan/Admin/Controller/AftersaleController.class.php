<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:52
 */

namespace Admin\Controller;

use Think\Controller;

class AftersaleController extends Controller
{
    function aftersale()
    {
        $getname=session('session_name');
        $getsid=I('sid');
        $getsuperadminname=session('session_superadmin');
        if (!empty($getname)||!empty($getsuperadminname)){
            $infoModel=M('hou');
            $allinfo=$infoModel
                ->alias('h')
                ->join("yx_user u on h.huid=u.uid")
                ->join('left join yx_goods AS g ON h.hgid=g.gid')
                ->field("h.*,g.*,u.nickname,u.uid")//需要显示的字段
                ->where('h.htype=0 and h.hsid='.$getsid)
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['haddtime']=date('Y-m-d h:i:s',$v['haddtime']);
            }
            $isdeal=$infoModel
                ->alias('h')
                ->join("yx_user u on h.huid=u.uid")
                ->join('left join yx_goods AS g ON h.hgid=g.gid')
                ->field("h.*,g.*,u.nickname,u.uid")//需要显示的字段
                ->where('h.htype=1 and h.hsid='.$getsid)
                ->select();//所有信息
            foreach ($isdeal as $k=>$v){
                $isdeal[$k]['haddtime']=date('Y-m-d h:i:s',$v['haddtime']);
            }
            $this->info=$allinfo;
            $this->isdeal=$isdeal;
           ///var_dump($isdeal);
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