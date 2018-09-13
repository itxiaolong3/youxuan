<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Superadmin\Controller;
use Think\Controller;
class AddcolorController extends Controller{
    function index(){
        $colorModel = M('color');
        if (IS_POST) {
            $getid = I('cid');
            $arr = array();
                $re = $colorModel->where('cid=' . $getid)->delete();
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
            $colorinfo = $colorModel->select();
            $this->colorinfo = $colorinfo;
            $this->display();
        }


    }
    //增加颜色
    function Addcolor()
    {
        $data = I('post.');
        $superModel = M('color');

        $arr = array();
        if (empty($data['cname'])) {
            $arr['status'] = -1;
            $arr['msg'] = '添加失败';
            echo json_encode($arr);
        }else {
            $info=$superModel->where("cname="."'".$data['cname']."'")->find();
            if($info){
                //颜色已经存在
                $arr['status'] = -3;
                $arr['msg'] = '该颜色存在，添加失败';
                echo json_encode($arr);
            }else{
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

    //编辑
    function editcolor()
    {
        $adminModel = M('color');
        $arr = array();
        $id = I('cid');
        $data['cname'] = $_POST['cname'];
        if (empty($data['cname'])) {
            $arr['status'] = -1;
            $arr['msg'] = '添加失败';
            echo json_encode($arr);
        } else {
            $re = $adminModel->where('cid=' . $id)->save($data);
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

}