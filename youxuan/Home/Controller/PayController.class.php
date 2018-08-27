<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Think\Controller;
vendor('WxPayLib.WxPayApi','','.class.php');
vendor('WxPayLib.JsApiPay','','.class.php');
vendor('WxPayLib.NativePay','','.class.php');

class PayController extends Controller {

    public function _initialize(){

    }

    function index()
    {
        $sid=I('sid');
        $this->sid=$sid;
        $phone=I('userphone');
        $username=I('username');
        $goodid=json_decode(htmlspecialchars_decode(I('goodid')),true);
      	$this->goodsid=$goodid;
        $goodcomment=json_decode(htmlspecialchars_decode(I('goodcomment')),true);
        $mywxpay=new MyWxPayController();
        $out_trade_no=time()*($mywxpay->GetRandStr(2));
      	//查询用户id
 		$openId=session('session_islogin'.$sid);
       $user=M('user')->where('openid='.'"'.$openId.'"')->find();
      //更新用户的手机号
        $userphone['phone']=$phone;
        M('user')->where('uid='.$user['uid'])->save($userphone);
      //保存预订单
        $preorder['onumber']=$out_trade_no;
        $preorder['oaddtime']=time();
      	$preorder['ordertime']=date('Y-m-d h:i:s',time());//用于统计的时间
        //$preorder['ogid']=implode('-',$goodid);//数组转字符串
        $preorder['osid']=$sid;
        $preorder['ouid']=$user['uid'];
        $preorder['ousername']=$username;
        $preorder['ouserphone']=$phone;
        //$preorder['opaymoney']=I('totalprice');
        //$preorder['onum']=implode(' ',$goodcomment);//购买的数量 商品名称+数量
        //订单记录分条保存
      	 $getoid=I('oid');//从订单中再次进来时
        //从订单中进来付款时，默认数量为1
        $getonum=1;
       if(!empty($getoid)){
            $out_trade_no=I('onumber');
            $numinfo=I('numinfo');
           $num=explode('x', $numinfo);
           $getonum=intval($num[1]);
         $re=1;
        }else{
             $iske=session('iske');//是否是代客下单
            if (empty($iske)){
                foreach ($goodid as $k=>$v){
                    $goods=M('goods')->where('gid='.$v)->find();
                    $preorder['opaymoney']=$goods['gyhprice'];
                    $preorder['ogid']=$v;
                    $preorder['onum']=$goodcomment[$k];
                   $num=explode('x', $goodcomment[$k]);
                    $preorder['buynum']=intval($num[1]);
                    $re=M('order')->add($preorder);
                }
            }else{
                foreach ($goodid as $k=>$v){
                    $goods=M('goods')->where('gid='.$v)->find();
                    $preorder['opaymoney']=$goods['gyhprice'];
                    $preorder['ogid']=$v;
                    $preorder['oiske']=1;
                    $preorder['onum']=$goodcomment[$k];
                   $num=explode('x', $goodcomment[$k]);
                    $preorder['buynum']=intval($num[1]);
                    $re=M('order')->add($preorder);
                }
            }
        }
        if($re){
            //查询店名
            $shop=M('shop')->where('did='.$sid)->find();
            $shopname=$shop['dname'];
            $file = __DIR__ . '/postinfo.txt';
            file_put_contents($file,json_encode($preorder));
            $this->assign('total_fee',I('totalprice')*100*$getonum);
            $this->assign('shop_name',$shopname);
            $this->assign('out_trade_no',$out_trade_no);
            $this->assign('success_url','http://'.$_SERVER['HTTP_HOST'].'/tp3/youxuan/index.php?sid='.$sid);
            $this->display('Pay/index');
        }
    }
       public  function postpay(){
          $file = __DIR__ . '/paytestinfo.txt';
      	  $goods_name=I('shop_name');
          $total_fee=I('total_fee');
          $out_trade_no=I('out_trade_no');
          $sid=I('sid');
         $openId=session('session_islogin'.$sid);
        //1统一订单
        $res=(new MyWxPayController())->unifiedOrder($goods_name,$total_fee,$out_trade_no,$sid,$openId);
        // $res=(new WxApiController())->UnifiedOrder($goods_name,$out_trade_no,$total_fee,$openId);
           file_put_contents($file,$res);
      	$res = json_decode($res,true);
        $res['code'] = 0;
        $res['msg'] = 'ok';
        echo json_encode($res);
    }
 

}