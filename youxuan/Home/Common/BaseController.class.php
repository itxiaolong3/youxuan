<?php

namespace Home\Common;

use Think\Controller;

class BaseController extends Controller
{
    function isurlempty($sid)
    {
        if (empty($sid)) {
            echo '<div class="no-container2 hid"style="text-align: center;"><img class="no-order" src="public/home/images/other/no_url.png" /></div>';
        }
    }

    function getshopinfo($sid)
    {
        $shopmodel = M('shop');
        $shopinfo = $shopmodel->field('did,dname,dheaderimg,dphone,dpretime,dendtime,dsign,daddress')->where("discole=0 and did=" . $sid)->find();
        return $shopinfo;
    }

    public function getWxConfig()
    {
        $wxconfig = M('configinfo')->where('id=1')->find();
        $wxconfig['appid'] = $wxconfig['appid'];
        return $wxconfig;
    }

    public function getAccess_token()
    {
        $file = __DIR__ . '/access_token.txt';
        $jsonStr = file_get_contents($file);
        if ($jsonStr) {
            $reArr = json_decode($jsonStr, true);
            if ($reArr['maxTime'] > time()) {
                return $reArr['access_token'];
            }
        }
        $wxConfig = $this->getWxConfig();
        $apiUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wxConfig['appid']}&secret={$wxConfig['appsecret']}";
        $reArr = json_decode(file_get_contents($apiUrl), true);
        $reArr['maxTime'] = time() + $reArr['expires_in'];
        file_put_contents($file, json_encode($reArr));
        return $reArr['access_token'];
    }

    public function getJsapi_ticket()
    {
        $file = __DIR__ . '/jsapi_ticket.txt';
        $jsonStr = file_get_contents($file);
        if ($jsonStr) {
            $reArr = json_decode($jsonStr, true);
        }
        if ($reArr['maxTime'] > time()) {
            return $reArr['ticket'];
        }
        $access_token = $this->getAccess_token();
        $apiUrl = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=jsapi";
        $reArr = json_decode(file_get_contents($apiUrl), true);
        $reArr['maxTime'] = time() + $reArr['expires_in'];
        file_put_contents($file, json_encode($reArr));
        return $reArr['ticket'];
    }

    public function jsSdkSign($noncestr, $time, $url)
    {
        $string1 = "jsapi_ticket={$this->getJsapi_ticket()}&noncestr={$noncestr}&timestamp={$time}&url={$url}";
        return sha1($string1);
    }
}

