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
            //立即生效订单分成开始
            $getonumber=$reArr['out_trade_no'];
            $allorderinfo=M('order')->where('onumber='.$reArr['out_trade_no'])->select();
            foreach ($allorderinfo as $k=>$vv){
                //在交易表中填加一条提成记录
                $jiaoyi['rtype']=0;
                //这里的余额只是提供交易表中使用，具体计算方法如下：提成类型-退款类型-提现类型-提现表中的提现中金额
                //余额的计算是在插入数据成功后再更新
                $jiaoyi['ryue']=0;
               // $getsid=M('order')->where('oid='.$orderinfo['oid'])->find();
                //获取提成金额
                $goods=M('goods')->where('gid='.$vv['ogid'])->find();
                $jiaoyi['rmoney']=$goods['gticheng']*$vv['buynum'];
                $jiaoyi['rsid']=$vv['osid'];
                $jiaoyi['raddtime']=time();
                $jiaoyi['rordertime']=date('Y-m-d h:i:s',time());
                $getid=M('jiaoyi')->add($jiaoyi);
                //更新余额
                    //提成类型
                    $tctotal=M('jiaoyi')->where('rsid='.$vv['osid']." and rtype=0")->sum('rmoney');
                    //退款类型
                    $tktotal=M('jiaoyi')->where('rsid='.$vv['osid']." and rtype=1")->sum('rmoney');
                    //提现类型
                    //$txtotal=M('jiaoyi')->where('rsid='.$getsid['osid']." and rtype=2")->sum('rmoney');
                    $txtotal=M('tixian')->where('xsid='.$vv['osid'].' and xtype=1')->sum('xshenprice');
                    //提现表中的提现中金额
                    $txzhongtotal=M('tixian')->where('xsid='.$vv['osid'].' and xtype=0')->sum('xshenprice');
                    $yue=$tctotal-($tktotal+$txtotal+$txzhongtotal);
                    $yuedata['ryue']=$yue;
                    //更新余额
                    M('jiaoyi')->where('rid='.$getid)->save($yuedata);

            }
            //立即生成订单结束
            file_put_contents($file,$postXml);
            file_put_contents($file,'支付返回的签名='.$reArr['sign'].'回调再次签名='.$sign,FILE_APPEND);
        }else{
            file_put_contents($file,'签名不一样返回的签名='.$reArr['sign'].'签名不一样回调再次签名='.$sign);

        }
        if($reArr['sign'] != $sign) echo '<xml> 
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

        echo '<xml> 
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