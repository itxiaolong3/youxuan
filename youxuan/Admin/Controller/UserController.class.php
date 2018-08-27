<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:32
 */

namespace Admin\Controller;

use Model\AdminModel;

class  UserController extends \Think\Controller
{
    //用户管理
    function vipuser()
    {
        $vipModel = M('user');
        $getsid=I('sid');
        if (IS_POST) {
            $getid = I('uid');
            $arr = array();
            $re = $vipModel->where('uid=' . $getid)->delete();
            if ($re) {
                $arr['status'] = 1;
                $arr['msg'] = '删除成功';
                echo json_encode($arr);
            } else {
                $arr['status'] = 0;
                $arr['msg'] = '删除失败';
                echo json_encode($arr);
            }
        } else {
            $userinfo = $vipModel->where('shopid='.$getsid)->select();
            foreach ($userinfo as $k=>$v){
                $userinfo[$k]['uaddtime']=date('Y-m-d',$v['uaddtime']);
            }
            $this->userinfo = $userinfo;
            $this->sid = $getsid;
            $this->display();
        }


    }
    //编辑用户
    function edituser()
    {
        $adminModel = M('user');
        $arr = array();
        $data['phone'] = $_POST['phone'];
        $data['uid'] = $_POST['uid'];
        if (empty($data['phone'])) {
            $arr['status'] = -1;
            $arr['msg'] = '添加失败';
            echo json_encode($arr);
        }else {
            $re = $adminModel->save($data);
            if ($re) {
                $arr['status'] = 1;
                $arr['msg'] = '编辑成功';
                echo json_encode($arr);
            } else {
                $arr['status'] = 0;
                $arr['msg'] = '编辑失败';
                echo json_encode($arr);
            }
        }


    }
    //登录
    function mylogin()
    {
        if (!empty($_POST)) {
            $username = $_POST["name"];
            $password = $_POST["password"];
            $sid =$_GET['sid'];
            if(empty($sid)){
                $this->redirect('mylogin', "", 2, '登录路径有误，请联系总管理员');
                exit();
            }
            //dump($_POST);
            $info = $this->checkPwloginName($username,$password,$sid);
            $yzm = $_POST['captcha'];
            //new一个方法（找到Verify()）
            $img = new \Think\Verify();
            //判断，如果验证码正确，在判断用户名密码（check($yzm)框架自带的验证方法
            if($img->check($yzm)){
                if ($info) {
                    //保存用户信息
                    //session("session_name", $info['dloginname']);
                    session("session_sid".$info['did'], $info['did']);
                    $this->redirect("/Admin/Index/Index?sid=".$info['did']);
                } else {
                    $einfo = "错误";
                    //返回失败信息
                    $this->assign('erInfo', $einfo);//把错误信息传递到视图中
                    $this->redirect('mylogin', "sid=".$sid, 1, '用户名或密码不对');
                }
            }else{
                $this->redirect('mylogin', "sid=".$sid, 1, '验证码不对');
            }

        } else {
            $this->title="欢迎登录";
            $this->display();
        }
    }

    //注销方法
    function loginout()
    {
        $getsid=I('sid');
        session('session_sid'.$getsid,null);
        $this->redirect('mylogin',"sid=".$getsid);
    }
    //创建验证码方法
    public function VerifyImg(){
        //创建验证码的配置文件（框架自带的，可以直接从\Think\Verify拿过来用）
        $config = array(
            'length'    => 4,               // 验证码位数
            'useCurve'  => false,            // 是否画混淆曲线
            'useNoise'  => false,            // 是否添加杂点
            'codeSet'=>'0123456789'        // 设置验证码字符为纯数字
        );
        //实例化方法
        $Verify = new \Think\Verify($config);
        //创建验证码
        $Verify->entry();
    }
    //检查
    public  function checkPwloginName($name,$psw,$sid){
        //先查用户名是否存在再配对密码是否一致
        $shopmodel=M('shop');
        $info=$shopmodel->where("dloginname="."'".$name."'".'and did='.$sid)->find();
        if ($info){
            if ($info['dpasswordmd5']==md5('itxiaolong3'.$psw)){
                //登录成功
                return $info;
            }
        }else{
            return "";
        }
    }
}