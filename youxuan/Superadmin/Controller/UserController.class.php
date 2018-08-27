<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:32
 */

namespace Superadmin\Controller;

use Model\AdminModel;

class  UserController extends \Think\Controller
{
    //超级用户
    function superuser()
    {
        $superModel = M('admin');
        $getname=session('session_superadmin');
        if (IS_POST) {
            $getid = I('id');
            $size = $superModel->count();
            $admininfo = $superModel->where("id=".$getid)->find();
            $arr = array();
            if ($size == 1) {
                $arr['status'] = -1;
                $arr['msg'] = '删除失败';
                echo json_encode($arr);
            }else if ($admininfo['name']==$getname){
                $arr['status'] = -2;
                $arr['msg'] = '删除失败';
                echo json_encode($arr);
            } else {
                $re = $superModel->where('id=' . $getid)->delete();
                if ($re) {
                    $arr['status'] = 1;
                    $arr['msg'] = '删除成功';
                    echo json_encode($arr);
                } else {
                    $arr['status'] = 0;
                    $arr['msg'] = '删除失败';
                    echo json_encode($arr);
                }
            }
        } else {
            $infoModel=M('configinfo');
            $superinfo = $superModel->select();
            $configinfo=$infoModel->select();//所有信息
            $this->configs=$configinfo;
            $this->superinfo = $superinfo;
            $this->display();
        }


    }

    //增加管理员
    function addSuperUser()
    {
        $data = I('post.');
        $superModel = M('admin');
        $arr = array();
        if (empty($data['name'])) {
            $arr['status'] = -1;
            $arr['msg'] = '添加失败';
            echo json_encode($arr);
        } else if (empty($data['password'])) {
            $arr['status'] = -2;
            $arr['msg'] = '添加失败';
            echo json_encode($arr);
        } else {
            $info=$superModel->where("name="."'".$data['name']."'")->find();
            if($info){
                //用户名已经存在
                $arr['status'] = -3;
                $arr['msg'] = '用户名已存在，添加失败';
                echo json_encode($arr);
            }else{
                $data['md5psw']=md5($_POST['password']);
                $re = $superModel->data($data)->add();
                if ($re) {
                    $arr['status'] = 1;
                    $arr['msg'] = '添加成功';
                    echo json_encode($arr);
                } else {
                    $arr['status'] = 0;
                    $arr['msg'] = '添加失败';
                    echo json_encode($arr);
                }
            }


        }

    }

    //编辑管理员
    function editadmin()
    {
        $adminModel = M('admin');
        $arr = array();
        $id = I('id');
        $data['name'] = $_POST['name'];
        $data['password'] = $_POST['password'];
        $data['md5psw'] =md5($_POST['password']) ;
        if (empty($data['name'])) {
            $arr['status'] = -1;
            $arr['msg'] = '添加失败';
            echo json_encode($arr);
        } else if (empty($data['password'])) {
            $arr['status'] = -2;
            $arr['msg'] = '添加失败';
            echo json_encode($arr);
        } else {
            $re = $adminModel->where('id=' . $id)->save($data);
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
    //用户管理
    function vipuser()
    {
        $vipModel = M('user');
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
            $userinfo = $vipModel->select();
            foreach ($userinfo as $k=>$v){
                $userinfo[$k]['uaddtime']=date('Y-m-d',$v['uaddtime']);
            }
            $this->userinfo = $userinfo;
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
            //dump($_POST);
            $userModel = new AdminModel();
            $info = $userModel->checkPwName($username, $password);
            $yzm = $_POST['captcha'];
            //new一个方法（找到Verify()）
            $img = new \Think\Verify();
            //判断，如果验证码正确，在判断用户名密码（check($yzm)框架自带的验证方法
            if($img->check($yzm)){
                if ($info) {
                    //保存用户信息
                    session("session_superadmin", $info['name']);
                    $this->redirect("/Superadmin/Index/Index");
                } else {
                    $einfo = "错误";
                    //返回失败信息
                    $this->assign('erInfo', $einfo);//把错误信息传递到视图中
                    $this->redirect('mylogin', "", 1, '用户名或密码不对');
                }
            }else{
                $this->redirect('mylogin', "", 1, '验证码不对');
            }

        } else {
            $this->title="欢迎登录";
            $this->display();
        }
    }

    //注销方法
    function loginout()
    {
        session('session_superadmin',null);
        $this->redirect('mylogin');
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
}