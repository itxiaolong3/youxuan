<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/7
 * Time: 14:07
 */
namespace Home\Common;
use Think\Controller;
class BaseController extends Controller{
    function isurlempty($sid)
    {
        if (empty($sid)){
            echo '<div class="no-container2 hid"style="text-align: center;"><img class="no-order" src="public/home/images/other/no_url.png" /></div>';
        }
    }
    function getshopinfo($sid){
        $shopmodel=M('shop');
        $shopinfo=$shopmodel->field('did,dname,dheaderimg,dphone,dpretime,dendtime,dsign,daddress')->where("did=".$sid)->find();
        return $shopinfo;
    }

}