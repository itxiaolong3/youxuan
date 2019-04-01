<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:52
 */

namespace Superadmin\Controller;

use Think\Controller;

class JiaoyiController extends Controller
{
    function jiaoyi()
    {
        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $infoModel=M('jiaoyi');
            //提成
            $ticheninfo=$infoModel
                ->alias('j')
                ->join('left join yx_shop AS s ON s.did=j.rsid')
                ->field("j.*,s.dname,s.dnum,s.dnickname")//需要显示的字段
                ->where('j.rtype=0')
                ->order('j.raddtime DESC')
                ->select();//所有信息
            foreach ($ticheninfo as $k=>$v){
                $ticheninfo[$k]['raddtime']=date('Y-m-d h:i:s',$v['raddtime']);
            }
            //退款
            $tuikuaninfo=$infoModel
                ->alias('j')
                ->join('left join yx_shop AS s ON s.did=j.rsid')
                ->field("j.*,s.dname,s.dnum,s.dnickname")//需要显示的字段
                ->where('j.rtype=1')
               ->order('j.raddtime DESC')
                ->select();//所有信息
            foreach ($tuikuaninfo as $k=>$v){
                $tuikuaninfo[$k]['raddtime']=date('Y-m-d h:i:s',$v['raddtime']);
            }
            //提现
            $tixianinfo=$infoModel
                ->alias('j')
                ->join('left join yx_shop AS s ON s.did=j.rsid')
                ->field("j.*,s.dname,s.dnum,s.dnickname")//需要显示的字段
                ->where('j.rtype=2')
               ->order('j.raddtime DESC')
                ->select();//所有信息
            foreach ($tixianinfo as $k=>$v){
                $tixianinfo[$k]['raddtime']=date('Y-m-d h:i:s',$v['raddtime']);
            }
            $this->ticheninfo=$ticheninfo;
            $this->tuikuaninfo=$tuikuaninfo;
            $this->tixianinfo=$tixianinfo;
           ///var_dump($isdeal);
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }

}