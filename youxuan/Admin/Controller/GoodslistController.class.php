<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Admin\Controller;
use Think\Controller;
class GoodslistController extends Controller{
    function goodslist(){
        $getname=session('session_name');
        $getsid=I('sid');
        $getsuperadminname=session('session_superadmin');
        if (!empty($getname)||!empty($getsuperadminname)){
            $infoModel=M('goods');
            $allinfo=$infoModel->where('sid='.$getsid)->select();//所有信息
           // $allinfo['addtime']=date('Y-m-d',$allinfo['addtime']);
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['gaddtime']=date('Y-m-d',$v['gaddtime']);
                //$allinfo[$k]['notice']=htmlspecialchars_decode($v['notice']);
            }
            $this->info=$allinfo;
            // $this->assign("info",$allinfo);//传递所有信息
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin?sid=".$getsid);
        }
    }
    //删除商品
    function deletegoods(){
        $upCtypeModel=M('goods');
        $arr=array();
        if (!empty($_POST)){
            $getid=$_POST['gid'];
            $re=$upCtypeModel->where('gid='.$getid)->delete();
            if ($re){
                $arr['status']=1;
                $arr['msg']='删除成功';
                echo json_encode($arr);
            }else{
                $arr['status']=0;
                $arr['msg']='删除失败';
                echo json_encode($arr);
            }
        }

    }
    //修改商品
    function editgoods(){
        $getid=I('gid');
        if(IS_POST){
//            var_dump(I('post.'));
//            exit();
            $id=I('gid');
            $arr=array();
            $data=I('post.');
            $data['gaddtime']=time();
            //对图片进行小处理
            $data['gimgs']=substr($data['gimgs'],1);
            $classModel = M('goods');
            if(empty($data['gtopimg'])){
                $arr['status']=-1;
                $arr['msg']='封面图不可为空';
                echo json_encode($arr);
                exit();
            }
            else if(empty(I('gtitle'))){
                $arr['status']=-2;
                $arr['msg']='商品名不可为空';
                echo json_encode($arr);
                exit();
            }else if(empty(I('gyhprice'))){
                $arr['status']=-3;
                $arr['msg']='价格不可为空';
                echo json_encode($arr);
                exit();
            }else if(empty(I('gticheng'))){
                $arr['status']=-4;
                $arr['msg']='提成不可为空';
                echo json_encode($arr);
                exit();
            }else{
                $re = $classModel->where('gid='.$id)->save($data);
                if ($re) {
                    $arr['status']=1;
                    $arr['msg']='修改成功';
                    echo json_encode($arr);
                    exit();
                } else {
                    $arr['status']=0;
                    $arr['msg']='修改失败发生未知错误';
                    echo json_encode($arr);
                    exit();
                }
            }

        }else{
            $goodsModel=M('goods');
            $goodsdata=$goodsModel->where('gid='.$getid)->find();
            $goodsdata['gcomment']=htmlspecialchars_decode($goodsdata['gcomment']);
            $thums=explode('|',$goodsdata['gimgs']);
            $this->assign('arrs',$thums);
            $this->classinfo=$goodsdata;
            //var_dump($classdata);
            $this->display();
        }
    }
    //多图片的删除
    function del() {
        $src = str_replace(__ROOT__ . '/', '', str_replace('//', '/', I('src')));
        if (file_exists($src)) {
            unlink($src);
        }
        print_r('|'.I('src'));
        exit();
    }
    //单图片的删除
    function delone() {
        $src = str_replace(__ROOT__ . '/', '', str_replace('//', '/', I('src')));
        if (file_exists($src)) {
            unlink($src);
        }
        print_r(I('src'));
        exit();
    }

}