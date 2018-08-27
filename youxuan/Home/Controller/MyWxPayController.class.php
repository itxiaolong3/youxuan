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

class MyWxPayController extends Controller {

   
    //随机数
    function GetRandStr($length){
        $str='0123456789';
        $len=strlen($str)-1;
        $randstr='';
        for($i=0;$i<$length;$i++){
            $num=mt_rand(0,$len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }
    //xml转为数组
    function FromXml($xml)
    {
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }
    function unifiedOrder($goods_name,$total_fee,$out_trade_no,$sid,$openId,$tz_url = false){
        if(!$tz_url){
            $tz_url = 'http://'.$_SERVER['HTTP_HOST'].'/tp3/youxuan/index.php/Paynotify';
        }
        //1.获取用户的openid
        $tools = new \Vendor\WxPayLib\JsApiPay();
        //$openId = $tools->GetOpenid();
      if(empty($openId)){
            $openId = $tools->GetOpenid();
        }
			
        //2、统一下单  out_trade_no、body、total_fee、trade_type、openid必填
        $input = new \Vendor\WxPayLib\WxPayUnifiedOrder();
        $input->SetBody($goods_name); //设置商品名称
        $input->SetTotal_fee($total_fee); //价格，这是1分钱
        $input->SetOut_trade_no($out_trade_no);
        $input->SetNotify_url($tz_url);//回调地址
        $input->SetTrade_type("JSAPI"); //支付分类，这是JSAPI付款方式
        $input->SetDevice_info((string)$sid);
        $input->SetOpenid($openId);
        $order = \Vendor\WxPayLib\WxPayApi::unifiedOrder($input);
        $payre=$tools->GetJsApiParameters($order);
      	//$file = __DIR__ . '/mywxpayparameterinfo.txt';file_put_contents($file,$payre);
        return $payre;
    }
   
}