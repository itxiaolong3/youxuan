<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Home\Common\BaseController;
class LoginadminController extends BaseController {
    function index()
   {
      date_default_timezone_set('RPC');
       if (IS_POST){
           $getphone=I('phone');
           $getpassword=I('password');
           $getshopinfo=$this->checkPwName($getphone,$getpassword);
          //session("loginphone", $getshopinfo['dphone']);
          //session("loginpassword", $getshopinfo['dpassword']);
          //改为cookice,这样可以设置过期时间
           cookie('loginphone',$getshopinfo['dphone'],time()+3600*86400);
           cookie('loginpassword',$getshopinfo['dpassword'],time()+3600*86400);

           if($getshopinfo){
               //session("session_phone", $getshopinfo['dphone']);
               //session("session_password", $getshopinfo['dpassword']);
               cookie('session_phone',$getshopinfo['dphone'],time()+3600*86400);
               cookie('session_password',$getshopinfo['dpassword'],time()+3600*86400);
               $this->redirect("/Home/Indexadmin/index?sid=".$getshopinfo['did']);
           }else{
               $this->redirect('Loginadmin/index', "", 1, '用户名或密码不对');
           }
       }else{
           //分享
           $requrl=$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
           $jssdkArr['appId'] = $this->getWxConfig()['appid'];
           $jssdkArr['timestamp'] = time();
           $jssdkArr['nonceStr'] = md5(time());
           $jssdkArr['signature'] = $this->jsSdkSign($jssdkArr['nonceStr'],$jssdkArr['timestamp'],$requrl);
           //分享数据
           $fxArr['title'] = "登录门店管理系统";
           $fxArr['link'] = $requrl;
           $fxArr['imgUrl'] =$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/tp3/youxuan/Public/home/images/other/meng.png';
           $fxArr['desc'] = '';
           $fxArr['type'] = 'link';
           $this->jssdkArr=$jssdkArr;
           $this->fxArr=$fxArr;
           //$getphone=session('loginphone');
           //$getpassword=session('loginpassword');
           //改为cookice
           $getphone=cookie('loginphone');
           $getpassword=cookie('loginpassword');
           $this->getphone=$getphone;
           $this->getpsw=$getpassword;
//         $getnologinphone=session('session_phone');
//          $getnologinpsw=session('session_password');
           $getnologinphone=cookie('session_phone');
           $getnologinpsw=cookie('session_password');
         $getshopinfo=$this->checkPwName($getnologinphone,$getnologinpsw);
         if($getshopinfo){
               $this->redirect("/Home/Indexadmin/index?sid=".$getshopinfo['did']);
           }else{
            $this->display("Loginadmin/index");
         
         }
          
       }
    }
    public  function checkPwName($phone,$psw){
        //先查用户名是否存在再配对密码是否一致
        $info=M('shop')->where("dis_delete=0 and dphone='".$phone."'")->find();
        if ($info){
            if ($info['dpassword']===$psw){
                //登录成功
                return $info;
            }
        }else{
            return "";
        }
    }

}