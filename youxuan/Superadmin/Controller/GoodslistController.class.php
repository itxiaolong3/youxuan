<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:50
 */
namespace Superadmin\Controller;
use Think;
use Think\Controller;

class GoodslistController extends Controller{
    function goodslist(){
        $getname=session('session_name');
        $getsuperadminname=session('session_superadmin');
        if (!empty($getname)||!empty($getsuperadminname)){
            $infoModel=M('goods');

            $state=I('state');
            if (empty($state)){
                $state=1;
            }else if ($state==2){
                $state=0;
            }
            //模糊查询
            $keyword=I('keyword');
            if (!empty($keyword)){
                $where='g_isdelete=0 and gtitle like'."'%".$keyword."%'";
                //分页数据
                $count=$infoModel->where($where)->count();
            }else{
                $where="gstatus='{$state}'and g_isdelete=0 and gtitle like"."'%".$keyword."%'";
                //分页数据
                $count=$infoModel->where($where)->count();
            }

            $pagesize=50;
            $p=getpage($count,$pagesize);
            //分页数据结束
            $online=$infoModel->where('g_isdelete=0 and gstatus=1')->count();
            $waitonline=$infoModel->where('g_isdelete=0 and gstatus=0')->count();
            $this->online=$online;
            $this->waitonline=$waitonline;
            $this->state=I('state');

            $show=$p->show();
            $allinfo=$infoModel->where($where)->order('gorder asc') ->limit($p->firstRow,$p->listRows)->select();//所有信息
            $this->assign('page',$show); // 赋值分页输出
            $noup=$infoModel->where('gstatus=0 and g_isdelete=0')->select();
            $uptimearr=array();
            foreach ($noup as $kk=>$vv){
                if(!empty($vv['guptime'])){//手动下架的忽略
                  $sstime=strtotime($vv['guptime'])-time();
                    if ($sstime<=0){
                        $uptimearr['gstatus']=1;
                        $infoModel->where('gid='.$vv['gid'])->save($uptimearr);
                    }
                }
                
            }
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['gaddtime']=date('Y-m-d',$v['gaddtime']);
                //$allinfo[$k]['notice']=htmlspecialchars_decode($v['notice']);
            }
            //var_dump(I('.post'));
            $this->info=$allinfo;
            // $this->assign("info",$allinfo);//传递所有信息
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }
  //商品提成表
    function goodtichen(){
        $getname=session('session_name');
        $getsuperadminname=session('session_superadmin');
        if (!empty($getname)||!empty($getsuperadminname)){
            $infoModel=M('goods');
            $allinfo=$infoModel->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['gaddtime']=date('Y-m-d',$v['gaddtime']);
               $allinfo[$k]['mdprice']=$v['gyhprice']-$v['gticheng'];
            }
            $this->info=$allinfo;
            $this->display();

        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }

    }
    //删除商品
    function deletegoods(){
        $upCtypeModel=M('goods');
        $arr=array();
      $datas=array();
        if (!empty($_POST)){
            $getid=$_POST['gid'];
            $datas['g_isdelete']=1;
            //$re=$upCtypeModel->where('gid='.$getid)->delete();
            $re=$upCtypeModel->where('gid='.$getid)->save($datas);
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
  //上下架商品
    function changegoods(){
        $goodsModel=M('goods');
        $arr=array();
        if (!empty($_POST)){
            $getid=$_POST['id'];
            $colsestatus=$goodsModel->where('gid='.$getid)->getField('gstatus');
			$guptime=$goodsModel->where('gid='.$getid)->getField('guptime');
         
            if ($colsestatus){
               //如果是上架的
                $data['guptime']='';
                $data['gstatus']=0;
            }else{
                $data['gstatus']=1;
            }
            $re=$goodsModel->where('gid='.$getid)->save($data);
            if ($re){
                $arr['status']=1;
                $arr['msg']='操作成功';
                echo json_encode($arr);
            }else{
                $arr['status']=0;
                $arr['msg']='操作失败';
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
            $colors=I('color');
            $formats=I('format');
            $colorstr=implode(',',$colors);
            $formatstr=implode(',',$formats);
            $data['gcolor']=$colorstr;
            $data['gformat']=$formatstr;
            $data['gaddtime']=time();
            //对图片进行小处理
            $data['gimgs']=substr($data['gimgs'],1);
            $classModel = M('goods');
            $gtitle=I('gtitle');
            $gyhprice=I('gyhprice');
            $gticheng=I('gticheng');
            $guptime=I('guptime');
            if(empty($data['gtopimg'])){
                $arr['status']=-1;
                $arr['msg']='封面图不可为空';
                echo json_encode($arr);
                exit();
            }
            else if(empty($gtitle)){
                $arr['status']=-2;
                $arr['msg']='商品名不可为空';
                echo json_encode($arr);
                exit();
            }else if(empty($gyhprice)){
                $arr['status']=-3;
                $arr['msg']='价格不可为空';
                echo json_encode($arr);
                exit();
            }else if(empty($gticheng)){
                $arr['status']=-4;
                $arr['msg']='提成不可为空';
                echo json_encode($arr);
                exit();
            }else{
              $getuptime=$guptime;
                $uptime=strtotime($getuptime);
                if($uptime-time()>0){//开启预上架，这关闭当前上架状态
                    $data['gstatus']=0;
                }else{
                    $data['gstatus']=1;
                }
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
           //规格
            $getcolor=M('color')->select();
            $getformat=M('format')->select();
            $this->colors=$getcolor;
            $this->formats=$getformat;
            $getthiscolor=explode(',',$goodsdata['gcolor']);
            $getthisformat=explode(',',$goodsdata['gformat']);
            //var_dump($getthiscolor);
            $this->thiscolor=$getthiscolor;
            $this->thisformat=$getthisformat;
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