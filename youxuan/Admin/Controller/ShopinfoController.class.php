<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Admin\Controller;
use Think\Controller;
class ShopinfoController extends Controller{
    function shopinfo(){
        $shopModel=M('shop');
        if(IS_POST){
            $arr=array();
            //商店信息
            $data1=I("post.");
            $data1['daddtime']=time();
            if(empty(I('dheaderimg'))){
                $arr['status']=-1;
                $arr['msg']='头像不可为空';
                echo json_encode($arr);
                exit();
            }
            else if(empty(I('dphone'))){
                $arr['status']=-2;
                $arr['msg']='手机号不可为空';
                echo json_encode($arr);
                exit();
            }
            else if(empty(I('dpretime'))){
                $arr['status']=-2;
                $arr['msg']='预售时间不可为空';
                echo json_encode($arr);
                exit();
            }
            else if(empty(I('dendtime'))){
                $arr['status']=-2;
                $arr['msg']='提货时间不可为空';
                echo json_encode($arr);
                exit();
            }else{
                $sre = $shopModel->save($data1);
                if ($sre) {
                    $arr['status']=1;
                    $arr['msg']='更新成功';
                    echo json_encode($arr);
                    exit();
                } else {
                    $arr['status']=0;
                    $arr['msg']='更新失败';
                    echo json_encode($arr);
                    exit();
                }
            }

        }else{
            $getsid=I('sid');
            $goodsdata=$shopModel->field('did,dheaderimg,dphone,dnickname,dpretime,dendtime,dsign')->where('did='.$getsid)->find();
            $this->shopconfig=$goodsdata;
            $this->display();
        }


    }

}