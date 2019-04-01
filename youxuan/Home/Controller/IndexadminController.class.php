<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Home\Common\BaseController;
use function PHPSTORM_META\elementType;
use Think\Controller;
use Think\Upload;
class IndexadminController extends BaseController {
    function index()
   {

       $getphone=cookie('session_phone');
       $getpassword=cookie('session_password');
     
       if (!empty($getphone)&&!empty($getpassword)){
           $getsid=I('sid');
           if (!empty($getsid)){

               $shopinfo=M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->find();
               if ($shopinfo['did']==$getsid){
                   //获取商店信息
                   $this->shopinfo=$shopinfo;
                   //今日订单数
              		 $gettodaynum=M('order')->where('osid='.$shopinfo['did'].' and to_days(ordertime) = to_days(now())')->sum('buynum');
               		$this->todaynum=$gettodaynum;
              		 //今日收益
              		 $gettodaymoney=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=0".' and to_days(rordertime) = to_days(now())')->sum('rmoney');
              		 $this->todaymoney=number_format($gettodaymoney,2);
              		 //累计收益
              		 $alltotal=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=0")->sum('rmoney');
              		 $this->allnum=number_format($alltotal,2);
                	 $this->sid=$shopinfo['did'];
                  //分享
               $requrl=$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
               $jssdkArr['appId'] = $this->getWxConfig()['appid'];
               $jssdkArr['timestamp'] = time();
               $jssdkArr['nonceStr'] = md5(time());
               $jssdkArr['signature'] = $this->jsSdkSign($jssdkArr['nonceStr'],$jssdkArr['timestamp'],$requrl);
               //分享数据
               $fxArr['title'] = $shopinfo['dname']." 门店管理系统";
               $fxArr['link'] = $requrl;
               $fxArr['imgUrl'] =$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/tp3/youxuan/Public/home/images/other/meng.png';
               $fxArr['desc'] = '';
               $fxArr['type'] = 'link';
               $this->jssdkArr=$jssdkArr;
               $this->fxArr=$fxArr;
                     $this->display("Indexadmin/index");
               }else{
                   //视图修改地址来访问他人的数据
                   $this->redirect('Loginadmin/index',"", 1, '无权访问他人数据');
               }
           }else{
               //首次登录或者已经登录过
               $shopinfo=M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->find();
               //获取商店信息
               $this->shopinfo=$shopinfo;
             	 //今日订单数
               $gettodaynum=M('order')->where('osid='.$shopinfo['did'].' and to_days(ordertime) = to_days(now())')->count();
               $this->todaynum=$gettodaynum;
               //今日收益
               $gettodaymoney=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=0".' and to_days(rordertime) = to_days(now())')->sum('rmoney');
               $this->todaymoney=number_format($gettodaymoney,2);
               //累计收益
               $alltotal=M('jiaoyi')->where('rsid='.$shopinfo['did']." and rtype=0")->sum('rmoney');
               $this->allnum=number_format($alltotal,2);
               $this->sid=$shopinfo['did'];
              //分享
               $requrl=$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
               $jssdkArr['appId'] = $this->getWxConfig()['appid'];
               $jssdkArr['timestamp'] = time();
               $jssdkArr['nonceStr'] = md5(time());
               $jssdkArr['signature'] = $this->jsSdkSign($jssdkArr['nonceStr'],$jssdkArr['timestamp'],$requrl);
               //分享数据
               $fxArr['title'] = $shopinfo['dname']." 门店管理系统";
               $fxArr['link'] = $requrl;
               $fxArr['imgUrl'] =$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/tp3/youxuan/Public/home/images/other/meng.png';
               $fxArr['desc'] = '梦想开始的地方';
               $fxArr['type'] = 'link';
               $this->jssdkArr=$jssdkArr;
               $this->fxArr=$fxArr;
               $this->display("Indexadmin/index");
           }

       } else{
        
           $this->redirect("Loginadmin/index");
       }

    }
    //注销方法
    function outlogin(){
//        session('session_phone',null);
//        session('session_password',null);
        cookie('session_phone',null);
        cookie('session_password',null);
        $this->redirect("Loginadmin/index");
    }
   //上传头像
  public function uploadimg(){
    	$getphone=cookie('session_phone');
        $getpassword=cookie('session_password');
        if ($_FILES) {
            if($_FILES['file'][error]<4){
                $arg=array(
                    'rootPath'      =>  './Public/admin/uploads/', //保存根路径
                );
                //处理上传文件
                $upload=new Upload($arg);
                //返回传到服务器后的名称和地址等信息
                $re=$upload->uploadOne($_FILES['file']);//如果上传多个文件就不用$_FILES参数，且改用upload()来上传
                //原图的保存路径
                $imgPath=$re['savepath'].$re['savename'];
                $savadata['dheaderimg']='admin/uploads/'.$imgPath;
                $re=M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->save($savadata);
				$this->redirect("Indexadmin/index");
               
            }
        }
    }
	//更新签名
   public  function updatasign(){
        $getphone=cookie('session_phone');
        $getpassword=cookie('session_password');
        $getdsgin=I('dsign');
        $data['dsign']=$getdsgin;
        M('shop')->where("dphone='".$getphone."' and dpassword='".$getpassword."'")->save($data);
        $this->redirect("Indexadmin/index");

    }

}