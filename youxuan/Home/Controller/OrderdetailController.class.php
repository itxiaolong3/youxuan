<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Home\Common\BaseController;
class OrderdetailController extends BaseController {
    function index()
   {
       //店铺id
       $getsid=I('sid');
       $this->sid=$getsid;
       //得到用户信息
       $getopenid=session('session_islogin'.$getsid);
       $usermodel=M('user');
       $userinfo=$usermodel->where(array("openid"=>$getopenid))->find();
        $this->userinfo=$userinfo;
        //商品信息
       $data=I("goods");
       $totalprice=I("totalprice");
       $data = json_decode(htmlspecialchars_decode($data),true);
       $onegood =I('onegood');
       $this->goods=$data;
       $this->totalprice=$totalprice;
       $this->goodtypenums=I('goodtypenums');//商品种类数量
       $onegood=json_decode(htmlspecialchars_decode($onegood),true);
       $this->onegood=$onegood;
      $this->onegoodsize=$onegood|count;
       //店铺
       $shopinfo=$this->getshopinfo($getsid);
       $this->shopinfo=$shopinfo;
      $this->display('Orderdetail/index');
    }
    function detail(){
        $this->display();
    }

}