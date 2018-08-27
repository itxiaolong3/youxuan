<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Think\Controller;
use Home\Common\WxApiController;
class MyController extends Controller {
    function index()
   {
      $getsid=I('sid');
       $this->sid=$getsid;
        $islogin=session('session_islogin'.$getsid);
        if ($islogin){
            $usermodel=M('user');
            //先检查表中是否已经存在该用户，如果存在直接跳转
            $userinfo=$usermodel->where(array("openid"=>$islogin))->find();
            $this->userinfo=$userinfo;
          ///
          // $openid=session('session_islogin'.$getsid);
       // $res=(new WxApiController())->UnifiedOrder('测试','2018548444',100,$openid);
       // $res = json_decode($res,true);
        ///$res['code'] = 0;
       // $res['msg'] = 'ok';
       // $res['sn'] = '2018548444';
          
       // return json_encode($res);
          
            $this->display('My/index');
        }else{
            $this->redirect('Index/wxLogin?sid='.$getsid);
        }
    }
  //生成二维码
    function getqrcorde(){
        //生成二维码
        $sid=I('get.sid');
       $shop= M('shop')->where('did='.$sid)->find();
        $url=$shop['durl'];
        $level=3;
        $size=4;
        Vendor('phpqrcode.phpqrcode');
        $errorCorrectionLevel =intval($level) ;//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        //生成二维码图片
        $object = new \QRcode();
        $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
    }

}