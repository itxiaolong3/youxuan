<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Home\Common\BaseController;
class PayresultController extends BaseController {
    function index()
   {
       $getordernum=I('ordernum');
       $gettotal=I('total');
       if (empty($gettotal)){
           if(!empty($getordernum)){
               $gettotal= M('order')->where('onumber='.$getordernum)->sum('opaymoney');
           }
       }
       $goods=M('order')->where('onumber='.$getordernum)->select();
       $goodid='';
       foreach ($goods as $k=>$v){
           $goodid.=$v['oid'].'-';
       }
       $goodid = substr($goodid,0,strlen($goodid)-1);
      /// var_dump($goodid);
      $getsid=$goods[0]['osid'];
       $this->goods=$goods;
       $this->goodid=$goodid;
       $this->ordernum=$getordernum;
       $this->total=$gettotal;
       $this->sid=$getsid;
       //查询店铺名和地址
       $getaddress=M('shop')->where('did='.$getsid)->getField('daddress');
       $this->getaddress=$getaddress;
      $this->display('Payresult/index');
    }


}