<?php
//微信支付公共接口
namespace Home\Common;
use Think\Controller;
class WxApiController extends Controller{
	private $wxApi = '';

	public function __construct(){
        include '../ThinkPHP/Library/Vendor/WxpayAPI_php_v3.0.1/lib/WxPay.Api.php';
        include '../ThinkPHP/Library/Vendor/WxpayAPI_php_v3.0.1/example/WxPay.JsApiPay.php';
        //$this->wxApi = new \WxPayApi();
	}

	//统一下单
	public function UnifiedOrder($body,$sn,$price,$openid,$tz_url = false){
		if(!$tz_url){
			$tz_url = 'http://'.$_SERVER['HTTP_HOST'].'/tp3/youxuan/index.php/Paynotify';
		}
     
		$inputObj = new \WxPayUnifiedOrder();
		
		$inputObj->SetNonce_str(md5(time()));								//设置随机字符串
		$inputObj->SetBody($body);											//设置商品描述
		$inputObj->SetOut_trade_no($sn);									//设置订单号   date("YmdHis").mt_rand ()
		$inputObj->SetTotal_fee($price);									//设置订单总金额
		$inputObj->SetSpbill_create_ip($_SERVER['REMOTE_ADDR']);					//设置ip
		$inputObj->SetNotify_url($tz_url);			//通知地址
		$inputObj->SetTrade_type('JSAPI');									//设置交易类型
		$inputObj->SetOpenid($openid);										//设置openid    o9uGT0dGkDNIm1Wi_Rx8G0cigyG8
		// $inputObj->SetScene_info('{"h5_info": {"type":"Wap","wap_url": "https://pay.weixin.qq.com/wiki/doc/api/H5.php?chapter=9_20&index=1","wap_name": "加湿器"}}');
		$inputObj->SetSign();												//设置签名
		$re = (new \WxPayApi())->unifiedOrder($inputObj);
		$tools = new \JsApiPay();
		return $tools->GetJsApiParameters($re);
	}

	//退款接口
	// public function tuiKuan(){
	// 	$inputObj = new \WxPayRefund();
	// 	$inputObj->SetAppid('wx89b2f4e23e9a82d6');
	// 	$inputObj->SetMch_id('1503295531');
	// 	$inputObj->SetNonce_str(md5(time()));
	// 	$inputObj->SetOut_trade_no('201806201840532107095386');
	// 	$inputObj->SetOut_refund_no('201806201840532107095389');
	// 	$inputObj->SetTotal_fee(1);
	// 	$inputObj->SetRefund_fee(1);
	// 	$inputObj->SetOp_user_id('1503295531');
	// 	$inputObj->SetSign();

	// 	$re = $this->wxApi->refund($inputObj);
	// 	print_r($inputObj);
	// }

	//根据通知的xml生成签名
	public function makeSign($xml){
		$WxPayDataBase = new \WxPayDataBase();
		$reArr = $WxPayDataBase->FromXml($xml);
		return $sign = $WxPayDataBase->MakeSign();
		print_r($sign);
	}

	//根据通知的xml转换成 数组
	public function fromXml($xml){
		$WxPayDataBase = new \WxPayDataBase();
		return $reArr = $WxPayDataBase->FromXml($xml);
	}

}