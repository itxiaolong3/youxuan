<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Superadmin\Controller;
use Think\Controller;
class AddformatController extends Controller{
    function index(){
        $formatModel = M('format');
        if (IS_POST) {
            $getid = I('ggid');
            $arr = array();
                $re = $formatModel->where('ggid=' . $getid)->delete();
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
            $formatinfo = $formatModel->select();
            $this->formatinfo = $formatinfo;
            $this->display('Addformat/index');
        }


    }
    //增加颜色
    function Addformat()
    {
        $data = I('post.');
        $superModel = M('format');

        $arr = array();
        if (empty($data['ggname'])) {
            $arr['status'] = -1;
            $arr['msg'] = '添加失败';
            echo json_encode($arr);
        }else {
            $info=$superModel->where("ggname="."'".$data['ggname']."'")->find();
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
    function editformat()
    {
        $adminModel = M('format');
        $arr = array();
        $id = I('ggid');
        $data['ggname'] = $_POST['ggname'];
        if (empty($data['ggname'])) {
            $arr['status'] = -1;
            $arr['msg'] = '添加失败';
            echo json_encode($arr);
        } else {
            $info=$adminModel->where("ggname="."'".$data['ggname']."'")->find();
            if($info){
                $arr['status'] = -3;
                $arr['msg'] = '已存在该尺寸';
                echo json_encode($arr);
            }else{
                $re = $adminModel->where('ggid=' . $id)->save($data);
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

}