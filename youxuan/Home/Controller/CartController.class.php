<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */
namespace Home\Controller;
use Think\Controller;

class CartController extends Controller {
    function index()
   {
       $getsid=I('sid');
       $this->sid=$getsid;
       $data=I("shoppingcart");
       $data = json_decode(htmlspecialchars_decode($data),true);
       $this->goods=$data;
      $this->display('Cart/index');
    }


}