<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;

use Think\Controller;

class PersonalController extends Controller {
    function index()
   {
       $islogin=session('session_islogin');
       if($islogin){
           $usermodel=M('vipinfo');
           $checkres=$usermodel->where(array("openid"=>$islogin))->find();
           if($checkres['name']){
               $this->userinfo=$checkres;
               $this->display('Personal/index2');
           }else{
               $this->display('Personal/index');
           }

       }else{
        $this->wxLogin();
       }
    }

    //微信登录入口
    public function wxLogin(){
        $infoModel=M('configinfo');
        $wxConfig=$infoModel->where('id=1')->find();
        $url = urlencode('https://pj.dede1.com/tp3/gongzhong/index.php/home/personal/dealwxlogin');
        $apiUrl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$wxConfig['appid']}&redirect_uri={$url}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        header('Location:'.$apiUrl);
    }
    //处理微信登录信息,这里只获取openid
    public function  dealwxlogin(){
        $getcode = $_GET['code'];

        $infoModel=M('configinfo');
        $wxConfig=$infoModel->where('id=1')->find();
        $tokenandappid=$this->get_access_token_and_openid($wxConfig['appid'],$wxConfig['appsecret'],$getcode);
        $openid=$tokenandappid['openid'];
        //保存openid到用户表中
        $usermodel=M('vipinfo');

        //先检查表中是否已经存在该用户，如果存在直接跳转
        $checkres=$usermodel->where(array("openid"=>$openid))->find();
        //exit($openid);
       if ($checkres){
           session("session_islogin", $openid);
           $this->redirect('personal/index');
       }else{
           $data['openid']=$openid;
           $addre=$usermodel->add($data);
           if ($addre){
               session("session_islogin", $openid);
               $this->redirect('personal/index');
           }else{
               echo "微信登录失败！请退出重试";
           }
       }

    }

    function get_access_token_and_openid($appid, $secret, $code)
    {
        $getaccess = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $secret . "&code=" . $code . '&grant_type=authorization_code');
        $getacctoken = json_decode($getaccess, true);
        return $getacctoken;
    }

}