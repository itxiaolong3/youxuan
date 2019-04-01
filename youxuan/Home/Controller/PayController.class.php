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
      	$totalpric=I('totalprice');
        $goodid=json_decode(htmlspecialchars_decode(I('goodid')),true);
      	$this->goodsid=$goodid;
        $goodcomment=json_decode(htmlspecialchars_decode(I('goodcomment')),true);
        $mywxpay=new MyWxPayController();
        $out_trade_no=time()*($mywxpay->GetRandStr(2));
      	//查询用户id
 		$openId=session('session_islogin'.$sid);
       $user=M('user')->where('openid='.'"'.$openId.'"')->find();
      //更新用户的手机号,如果是代客就不用修改
        $iske=session('iske');
        if (!$iske){
            $userphone['phone']=$phone;
            M('user')->where('uid='.$user['uid'])->save($userphone);
        }
      //保存预订单
        $preorder['onumber']=$out_trade_no;
        $preorder['oaddtime']=time();
      	$preorder['ordertime']=date('Y-m-d H:i:s',time());//用于统计的时间
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
            $out_trade_no_old=I('onumber');
            //重新生成订单号
            $out_trade_no=$out_trade_no_old+1;
            $data['onumber']=$out_trade_no;
            M('order')->where('onumber='.$out_trade_no_old)->save($data);
            //查询商品
            $getordernum=$out_trade_no;
            $goods=M('order')->where('onumber='.$getordernum)->select();
            $pricearr=array();
            foreach ($goods as $k=>$v){
                $goods[$k]['gooddetail']=M('goods')->where('gid='.$v['ogid'])->find();
                array_push($pricearr,$v['opaymoney']*$v['buynum']);
            }
            //总价格
            $totalpric=array_sum($pricearr);
            $this->goods=$goods;
            
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
                  //库存减少
                    if ($re){
                        $upbuynum['gendnum']=$goods['gendnum']-intval($num[1]);
                        M('goods')->where('gid='.$v)->save($upbuynum);  
                    }
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
                  //库存减少
                    if ($re){
                        $upbuynum['gendnum']=$goods['gendnum']-intval($num[1]);
                        M('goods')->where('gid='.$v)->save($upbuynum);  
                    }
                }
            }
        }
        if($re){
           
            //查询店名
            $shop=M('shop')->where('did='.$sid)->find();
            $shopname=$shop['dname'];
            $file = __DIR__ . '/postinfo.txt';
            file_put_contents($file,json_encode($preorder));
            $this->assign('total_fee',$totalpric*100*$getonum);
            $this->assign('shop_name',$shopname);
            $this->assign('out_trade_no',$out_trade_no);
            $this->assign('success_url','http://'.$_SERVER['HTTP_HOST'].'/tp3/youxuan/index.php/Payresult?ordernum='.$out_trade_no.'&total='.$totalpric);
            $this->display('Pay/index');
        }
      //剔除重复订单。处理bug所用
       $tcsql="DELETE from yx_order WHERE oid not in (SELECT maxid from (SELECT MAX(oid) as maxid, CONCAT(onum,ordertime,ogid) as nameAndCode from yx_order GROUP BY nameAndCode) t)";
       M('order')->execute($tcsql);
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
  //提交订单时检查库存
    public function checkkucun(){
        $getgoods=I('goodids');
        $goodcomment=I('goodcomment');
        $isok=1;
        foreach ($getgoods as $k=>$v){
            $goodsinfo=M('goods')->where('gid='.$v.' and gstatus=1')->find();
            $num=explode('x', $goodcomment[$k]);
            $buynum=intval($num[1]);
            if ($goodsinfo['gendnum']<$buynum||$goodsinfo['gendnum']<=0){
                $isok=0;
                break;
            }
        }
        $arr=array();
        if ($isok){
            $arr['status']=1;
            $arr['msg']='allow to buy';
            echo json_encode($arr);
        }else{
            $arr['status']=0;
            $arr['msg']='no more good to buy';
            $arr['info']=$goodcomment;
            echo json_encode($arr);
        }
    }
 

}