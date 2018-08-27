<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Home\Common\BaseController;

class WaredetailController extends BaseController {
    function index()
   {
       $getgid=I('gid');
       $getsid=I('sid');
       if (empty($getsid)){
           $this->isurlempty($getsid);
       }else{
           //该商品信息
           $goodmodel=M('goods');
           $goodsinfo=$goodmodel->where('gid='.$getgid)->find();
           $goodsinfo['gcomment']=htmlspecialchars_decode($goodsinfo['gcomment']);
           $imgs=array();
           $thums=explode('|',$goodsinfo['gimgs']);
           $goodsinfo['thums']=$thums;
           $this->goodsinfo=$goodsinfo;
           //销量
           $ordermodel=M('order');
           $salenum=$ordermodel->where("ostatus=1 and ogid=".$getgid)->sum('onum');
           //人数
           $usernum=$ordermodel->where('osid='.$getsid." and ostatus=1 and ogid=".$getgid)->count();
           $this->salenum=$salenum;
           $this->usernum=$usernum;
           //商店信息
           $shopinfo=$this->getshopinfo($getsid);
           $this->shopinfo=$shopinfo;
           //购买记录
           $selluser=$ordermodel
               ->alias('o')
               ->join("yx_user u on o.ouid=u.uid")
               ->field("o.onum,o.oaddtime,o.ostatus,u.*")//需要显示的字段
               ->where('o.ostatus=1 and ogid='.$getgid)
               ->select();//所有信息
           foreach ($selluser as $k=>$v){
               $selluser[$k]['oaddtime']=date('Y-m-d',$v['oaddtime']);
           }
           $this->selluserinfo=$selluser;
           $this->sid=$getsid;
           $this->display('Waredetail/index');
       }

    }

}