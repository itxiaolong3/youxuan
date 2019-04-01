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
            $colors=explode(',',$goodsinfo['gcolor']);
           $formats=explode(',',$goodsinfo['gformat']);
           $goodsinfo['thums']=$thums;
           $goodsinfo['gcolor']=$colors;
           $goodsinfo['gformat']=$formats;
           $this->goodsinfo=$goodsinfo;
           //销量
           $ordermodel=M('order');
           $salenum=$ordermodel->where(" ostatus > 0 and ogid=".$getgid)->sum('buynum');
           //人数
          $usernum=$ordermodel->where("ostatus>0 and ogid=".$getgid)->count('distinct(ouid)');
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
         //分享
           $requrl=$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
           $jssdkArr['appId'] = $this->getWxConfig()['appid'];
           $jssdkArr['timestamp'] = time();
           $jssdkArr['nonceStr'] = md5(time());
           $jssdkArr['signature'] = $this->jsSdkSign($jssdkArr['nonceStr'],$jssdkArr['timestamp'],$requrl);
           //分享数据
           $fxArr['title'] = "【飞李购】 ".$goodsinfo['gtitle'].'￥ '.$goodsinfo['gyhprice'];
           $fxArr['link'] = $requrl;
           $fxArr['imgUrl'] =$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/tp3/youxuan/Public/home/images/other/logonew.jpg';
           $fxArr['desc'] = '亲，每周送货时间为周一、周三、周五。在规定时间内，100%售后';
           $fxArr['type'] = 'link';
           $this->jssdkArr=$jssdkArr;
           $this->fxArr=$fxArr;
         
           $this->selluserinfo=$selluser;
           $this->sid=$getsid;
           $this->display('Waredetail/index');
       }

    }

}