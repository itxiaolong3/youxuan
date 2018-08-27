<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use function Aliyun\DySDKLite\Sms\sendSms;
use Think\Controller;

class RepassController extends Controller {
    function index()
   {
       // var_dump(md5('xiaolong123456'));
       $getphone=session('session_phone');
       $isxiu=I('x');
       if ($isxiu){
           $this->title='修改密码';
       }else{
           $this->title='重置密码';
       }
       $this->phone=$getphone;
       $this->display("Repass/index");
    }
    public function sendcode(){
        $arr=array();
       $getphone= I('getphone');
       $code=$this->getcode();
       //先查手机号在商户店中是否存在
        $isexit=M('shop')->where('dphone='.$getphone)->find();
        if ($isexit){
            Vendor('Alidayu.sendSms');
            //获取配置信息$keyid,$keysecret,$signname,$tmpcode,$phone,$code
            $configinfo=M('configinfo')->where('id=1')->find();
            $keyid=$configinfo['accesskeyid'];
            $keysecret=$configinfo['accesskeysecret'];
            $signname=$configinfo['smssign'];
            $tmpcode=$configinfo['smscode'];

            $returninfo=sendSms($keyid,$keysecret,$signname,$tmpcode,$getphone,$code);
            $re=json_encode($returninfo);
            $dealre=json_decode($re,true);
            if ($dealre['Message']=='OK'){
                $arr['status']=1;
                $arr['msg']='发送成功';
                $arr['code']=md5('xiaolong'.$code);
                echo json_encode($arr);
            }else{
                $arr['status']=0;
                $arr['msg']='发送失败';
                echo json_encode($arr);
            }
        }else{
            $arr['status']=-1;
            $arr['msg']='该手机号不是商户，请联系管理员';
            echo json_encode($arr);
        }

    }
    public function getcode(){
        $num="";
        for($i=0;$i<4;$i++){
            $num .= rand(0,9);
        }
        return $num;
    }
    //修改密码
    public function updatainfo(){
        $arr=array();
        $getphone=I('phone');
        $getpsw=I('psw');
        $updatas['dpassword']=$getpsw;
        $re=M('shop')->where('dphone='.$getphone)->save($updatas);
        if ($re){
            session('session_phone',null);
            session('session_password',null);
            $arr['status']=1;
            $arr['msg']='修改成功';
            echo json_encode($arr);
        }else{
            $arr['status']=0;
            $arr['msg']='修改失败';
            echo json_encode($arr);
        }

    }

}