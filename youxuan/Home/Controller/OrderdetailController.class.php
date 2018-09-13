<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Home\Common\BaseController;
class OrderdetailController extends BaseController {
    function index()
   {
       //店铺id
       $getsid=I('sid');
       $this->sid=$getsid;
       $getke=session('iske');
       $this->iske=$getke;
       //得到用户信息
       $getopenid=session('session_islogin'.$getsid);
       $usermodel=M('user');
       $userinfo=$usermodel->where(array("openid"=>$getopenid))->find();
        $this->userinfo=$userinfo;
        //商品信息
       $data=I("goods");
       $totalprice=I("totalprice");
       $data = json_decode(htmlspecialchars_decode($data),true);
       $onegood =I('onegood');
       $this->goods=$data;
       $this->totalprice=$totalprice;
       $this->goodtypenums=I('goodtypenums');//商品种类数量
       $onegood=json_decode(htmlspecialchars_decode($onegood),true);
       $this->onegood=$onegood;
      $this->onegoodsize=$onegood|count;
       //店铺
       $shopinfo=$this->getshopinfo($getsid);
       $this->shopinfo=$shopinfo;
      $this->display('Orderdetail/index');
    }
    function detail(){
        //当前请求的全路径$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
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
            $goods[$k]['gooddetail']=M('goods')->where('gid='.$v['ogid'])->find();
        }
        $goodid = substr($goodid,0,strlen($goodid)-1);
        $goodsnum=M('order')->where('onumber='.$getordernum)->count();
        $sid=$goods[0]['osid'];
        $uid=$goods[0]['ouid'];
        $userinfo=M('user')->where(array("uid"=>$uid))->find();
        $this->userinfo=$userinfo;
        $shopinfo=$this->getshopinfo($sid);
        //分享
        $requrl=$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        $jssdkArr['appId'] = $this->getWxConfig()['appid'];
        $jssdkArr['timestamp'] = time();
        $jssdkArr['nonceStr'] = md5(time());
        $jssdkArr['signature'] = $this->jsSdkSign($jssdkArr['nonceStr'],$jssdkArr['timestamp'],$requrl);
        $getke=session('iske');
        if (empty($getke)){
            //分享数据
            $fxArr['title'] = "老板，我是“".$userinfo['nickname']."”,刚在店里买的商品请接单！";
            $fxArr['link'] = $requrl;
            $fxArr['imgUrl'] =$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/tp3/youxuan/Public/home/images/other/orderlogo.png';
            $fxArr['desc'] = '【五鼎飞李购】：小伙伴们都购买了，大家赶快来晒单吧！';
            $fxArr['type'] = 'link';
        }else{
            //代客分享数据
            $fxArr['title'] = "亲爱的“".$userinfo['nickname']."”,刚才给你下单了，记得及时来提货哦！";
            $fxArr['link'] = $requrl;
            $fxArr['imgUrl'] =$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/tp3/youxuan/Public/home/images/other/orderlogo.png';
            $fxArr['desc'] = '【五鼎飞李购】：小伙伴们都购买了，大家赶快来晒单吧！';
            $fxArr['type'] = 'link';
        }
        //$this->assign('jssdkArr',$jssdkArr);
        $this->jssdkArr=$jssdkArr;
        $this->fxArr=$fxArr;
        $this->shopinfo=$shopinfo;
        $this->totalprice=$gettotal;
        $this->goods=$goods;
        $this->goodnum=$goodsnum;
        $this->goodid=$goodid;
        $this->display();
    }

}