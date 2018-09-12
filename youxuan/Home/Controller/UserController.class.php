<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller {
    function index()
   {

       echo '进入';
    }

    //检查token响应
    //官方校验微信签名
    public function CheckSignature()
    {
        $data = array();
        $gethtml = file_get_contents('php://input');
        $data['getcon'] = $gethtml;

        $signature = I('signature');
        $timestamp = I('timestamp');
        $nonce = I('nonce');
        $token = 'xiaolong';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            echo I('echostr');
        } else {
            echo 'xxx';
        }

    }


}