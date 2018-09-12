<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Home\Common\WxApi;
use Think\Controller;
class PaynotifyController extends Controller {
    function index()
    {
        //微信付款通知接收地址
        $file = __DIR__ . '/notifyinfo.txt';
        $postXml = $GLOBALS['HTTP_RAW_POST_DATA'];
        //签名
        $sign=$this->mymakesign($postXml);
        //将xml转换成数组
        $reArr = $this->FromXml($postXml);
        //验证签名
        if ($reArr['sign']==$sign){
          	$data['ostatus']=1;
          	$data['opaymoney']=$reArr['total_fee']/100;
            M('order')->where('onumber='.$reArr['out_trade_no'])->save($data);
            file_put_contents($file,$postXml);
            file_put_contents($file,'支付返回的签名='.$reArr['sign'].'回调再次签名='.$sign,FILE_APPEND);
        }else{
            file_put_contents($file,'签名不一样返回的签名='.$reArr['sign'].'签名不一样回调再次签名='.$sign);

        }
        if($reArr['sign'] != $sign) return '<xml> 
				<return_code><![CDATA[FAIL]]></return_code>
				<return_msg><![CDATA[签名失败]]></return_msg>
				</xml>';

        //查看是否已经处理过
        // $ordItem = Db::table('zc_order')->where('order_number',$reArr['out_trade_no'])->find();
        //is_pay = 1，说明已经处理过，不需要再处理了
//           if($ordItem['is_pay'] == 1) return '<xml>
//				<return_code><![CDATA[SUCCESS]]></return_code>
//				<return_msg><![CDATA[OK]]></return_msg>
//				</xml>';

        return '<xml> 
			<return_code><![CDATA[SUCCESS]]></return_code>
			<return_msg><![CDATA[OK]]></return_msg>
			</xml>';
    }
    public function mymakesign($xml){
        $key='wx07c7042328d04b81wx07c7042328d0';
        $arr=$this->FromXml($xml);
        $newarray=array();
        //对参数进行排序
        foreach($arr as $key=>$v){
            if($key=='sign'){
                continue;
            }
            array_push($newarray,$key);
        }
        sort($newarray);
        $s="";
        //拼接签名
        foreach($newarray as $k=>$v){
            $s.=$v.'='.$arr[$v].'&';
        }
        $mysign= strtoupper(md5($s.'key=wx07c7042328d04b81wx07c7042328d0'));
        return $mysign;
    }
    function FromXml($xml)
    {
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }
    //数组转为xml
    function ToXml($data)
    {
        $xml = "<xml>";
        foreach ($data as $key=>$val)
        {

            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";

        return $xml;
    }
}