<?php
namespace Home\Controller;
use Think\Controller;
vendor('WxPayLib.WxPayApi','','.class.php');
vendor('WxPayLib.JsApiPay','','.class.php'); 
vendor('WxPayLib.NativePay','','.class.php'); 

/**
 * 微信支付控制器
 */

class WxpayController extends Controller {

    public function _initialize(){

    }

	/**
	 * 微信h5支付
	 */
	public function index(){
        $result=array(
            'goods_name'=>'商品名称',
            'total_fee'=>1,
            'out_trade_no'=>time(),
            'success_url'=>'http://www.baidu.com',
            'pt_name'=>'测试商家',
        );
        //1.获取用户的openid
        $tools = new \Vendor\WxPayLib\JsApiPay();
        $openId = $tools->GetOpenid();
        

        //2、统一下单  out_trade_no、body、total_fee、trade_type、openid必填
        $input = new \Vendor\WxPayLib\WxPayUnifiedOrder();
        $input->SetBody($result['goods_name']); //设置商品名称
        $input->SetTotal_fee($result['total_fee']); //价格，这是1分钱
        $input->SetOut_trade_no($result['out_trade_no']);
        $input->SetNotify_url('http://www.baidu.com');//回调地址
        $input->SetTrade_type("JSAPI"); //支付分类，这是JSAPI付款方式
        $input->SetOpenid($openId);

        $order = \Vendor\WxPayLib\WxPayApi::unifiedOrder($input);
              
        $jsApiParameters = $tools->GetJsApiParameters($order);
  $file = __DIR__ . '/testinfo.txt';file_put_contents($file,$jsApiParameters);
        $this->assign('total_fee',$result['total_fee']);
        $this->assign('pt_name',$result['pt_name']);
        $this->assign('jsApiParameters',$jsApiParameters);
        $this->assign('success_url',$result['success_url']);
        $this->display();
    }

  
}

