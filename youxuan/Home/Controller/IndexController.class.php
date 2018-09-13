<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Home\Common\BaseController;

class IndexController extends BaseController {
    function index()
   {
     
       $getsid=I('sid');
       $iske=I('ke');
       if (empty($iske)){
           session('iske',null);
       }
      //删除一个小时后的未付款订单
       $allorder=M('order')->where('ostatus=0')->select();
       foreach ($allorder as $k=>$v){
           if(time()-$v['oaddtime']>3600){
               $goods=M('goods')->where('gid='.$v['ogid'])->find();
               $upbuynum['gendnum']=($goods['gendnum']+$v['buynum']);
               M('goods')->where('gid='.$v['ogid'])->save($upbuynum);
              M('order')->where('oid='.$v['oid'])->delete();
           }
       }
       //检查店铺状态
       $isopen=M('configinfo')->where('id=1')->getField('isopen');
       if (!$isopen){
           $imgpath='http://'.$_SERVER['HTTP_HOST'].'/tp3/youxuan';
           echo '<div class="no-container2 hid"style="text-align: center;"><img class="no-order" src="'.$imgpath.'/Public/home/images/other/mengopen.jpg" style="width:100%;height: 100%;" /></div>';
           exit();
       }
       if (!empty($iske)){
           session('iske',$iske);
         $this->iske=$iske;
       }
       if (empty($getsid)){
           $this->isurlempty($getsid);
       }else{
           $islogin=session('session_islogin'.$getsid);
           if($islogin){
               //店铺
               $shopinfo=$this->getshopinfo($getsid);
             if (empty($shopinfo)){
                $imgpath='http://'.$_SERVER['HTTP_HOST'].'/tp3/youxuan';
                 echo '<div class="no-container2 hid"style="text-align: center;"><img class="no-order" src="'.$imgpath.'/Public/home/images/other/iscolse1.png" /></div>';
                   exit();
               }
               $this->shopinfo=$shopinfo;
               //购买指数
               $ordernummodel=M('order');
               $ordernum=$ordernummodel->where("ostatus=1")->sum('onum');
               //$yimai=$ordernummodel->where('osid='.$getsid." and ostatus=1 and ogid=".)->count();
               $this->ordernum=$ordernum;
               //粉丝数
               $usernummodel=M('user');
               $usernum=$usernummodel->where('shopid='.$getsid)->count();
               $this->usernum=$usernum;
               //商品
               $goodsmodel=M('goods');
               $goodsinfo=$goodsmodel->field('gid,gboss,sid,gtopimg,gtitle,gyhprice,gprice,gdes,gendnum,gbuypretime,gbuyendtime,gstatus,guptime,gorder')->where('gstatus=1')->order('gorder asc')->select();
              $noup=$goodsmodel->field('gid,guptime')->where('gstatus=0')->select();
               $uptimearr=array();
              foreach ($noup as $kk=>$vv){
                $ut=strtotime($vv['guptime'])-time();
                  if(!empty($vv['guptime'])){//手动下架的忽略
                       if ($ut<=0){
                           $uptimearr['gstatus']=1;
                           $goodsmodel->where('gid='.$vv['gid'])->save($uptimearr);
                       }
                   }
                  
               }
             foreach ($goodsinfo as $k=>$v){
                   $goodsinfo[$k]['salenum']=$ordernummodel->where("ostatus=1 and ogid=".$v['gid'])->sum('buynum');
                   $goodsinfo[$k]['userinfo']=$ordernummodel
                       ->alias('o')
                       ->join("yx_user u on o.ouid=u.uid")
                       ->field("o.oid,o.ostatus,u.nickname,u.headerimg")//需要显示的字段
                       ->where('o.ostatus=1 and ogid='.$v['gid'])
                       ->limit(3)
                       ->select();//所有信息
               }
               $this->goodsinfo=$goodsinfo;
               $this->sid=$getsid;
               //分享
               $requrl=$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
               $jssdkArr['appId'] = $this->getWxConfig()['appid'];
               $jssdkArr['timestamp'] = time();
               $jssdkArr['nonceStr'] = md5(time());
               $jssdkArr['signature'] = $this->jsSdkSign($jssdkArr['nonceStr'],$jssdkArr['timestamp'],$requrl);
               //分享数据
               $fxArr['title'] = "五鼎飞李购(今日商品)".$shopinfo['dphone'].' '.$shopinfo['daddress'];
               $fxArr['link'] = $requrl;
               $fxArr['imgUrl'] =$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/tp3/youxuan/Public/home/images/other/orderurl.png';
               $fxArr['desc'] = '亲，今天下单，明天下午18:00后来门店自提，在规定时间内，100%售后。';
               $fxArr['type'] = 'link';
               $this->jssdkArr=$jssdkArr;
               $this->fxArr=$fxArr;
               $this->display('Index/index');
           }else{
               $this->wxLogin($getsid);
           }

       }

    }
    //微信登录入口
    public function wxLogin($sid){
      if (empty($sid)){
            $sid=I('sid');
        }
        $infoModel=M('configinfo');
        $wxConfig=$infoModel->where('id=1')->find();
        $url = urlencode('http://'.$_SERVER['SERVER_NAME'].'/tp3/youxuan/index.php/index/dealwxlogin');
        $apiUrl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$wxConfig['appid']}&redirect_uri={$url}&response_type=code&scope=snsapi_userinfo&state=".$sid."#wechat_redirect";
        header('Location:'.$apiUrl);
    }
    //处理微信登录信息,这里只获取openid
    public function  dealwxlogin(){
      
        $getcode = $_GET['code'];
        $getsid = $_GET['state'];
      
        $infoModel=M('configinfo');
        $wxConfig=$infoModel->where('id=1')->find();
       
        $tokenandappid=$this->get_access_token_and_openid($wxConfig['appid'],$wxConfig['appsecret'],$getcode);
        $openid=$tokenandappid['openid'];
        $access_token=$tokenandappid['access_token'];
    
        //获取用户信息
        $userresult = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . '&lang=zh_CN');
        $userinfo = json_decode($userresult, true);

        $getusername = $userinfo['nickname'];
        $getheaderimg = $userinfo['headimgurl'];
        //保存openid到用户表中
        $usermodel=M('user');
        //先检查表中是否已经存在该用户，如果存在直接跳转
        $checkres=$usermodel->where(array("openid"=>$openid))->find();
        //exit($openid);
        if ($checkres){
            session("session_islogin".$getsid, $openid);
            $this->redirect('Index/index?sid='.$getsid);
        }else{
            $data['openid']=$openid;
            $data['headerimg']=$getheaderimg;
            $data['nickname']=$getusername;
          $data['shopid']=$getsid;
           $data['uaddtime']=time();
            $addre=$usermodel->add($data);
            if ($addre){
                session("session_islogin".$getsid, $openid);
                $this->redirect('Index/index?sid='.$getsid);
            }else{
                echo "微信登录失败！请退出重试";
            }
        }

    }

    //微信登录相关
    function get_access_token_and_openid($appid, $secret, $code)
    {
        $getaccess = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $secret . "&code=" . $code . '&grant_type=authorization_code');
        $getacctoken = json_decode($getaccess, true);
        return $getacctoken;
    }
  function  changestatus(){
        $infoModel=D('configinfo');
        $isopen=$infoModel->where('id=1')->getField('isopen');
        if ($isopen){
            $infoModel->where('id=1')->save(array('isopen'=>0));
        }else{
            $infoModel->where('id=1')->save(array('isopen'=>1));
        }
    }

}