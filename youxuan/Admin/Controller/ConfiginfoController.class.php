<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Admin\Controller;
use Think\Controller;
class ConfiginfoController extends Controller{
    function configinfo(){
        $infoModel=M('configinfo');
        $shopModel=M('shop');

        if(IS_POST){
            //var_dump(I('post.'));
            $arr=array();
            //copyright ttitle
            $data['title']=I('title');
            $data['copyright']=I('copyright');
            $data['id']=I('id');
            //商店信息
            $data1['dappid']=I('dappid');
            $data1['did']=I('did');
            $data1['dappsecret']=I('dappsecret');
            $data1['dpayshopnum']=I('dpayshopnum');
            $data1['dpaykey']=I('dpaykey');
            $data['addtime']=time();
            $data1['daddtime']=time();
            $re = $infoModel->save($data);
            $sre = $shopModel->save($data1);
            if ($re&&$sre) {
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
        }else{
            $getsid=I('sid');
            $allinfo=$infoModel->where('sid='.$getsid)->select();//配置信息的
            $this->info=$allinfo;
            $goodsdata=$shopModel->field('did,dappid,dappsecret,dpayshopnum,dpaykey')->where('did='.$getsid)->find();
            $this->shopconfig=$goodsdata;
            $this->display();
        }


    }

}