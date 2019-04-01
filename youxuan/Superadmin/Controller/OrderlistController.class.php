<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 22:52
 */

namespace Superadmin\Controller;

use Think\Controller;

class OrderlistController extends Controller
{
    function orderlist()
    {
        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $orderModel=M('order');
            $getsid=I('sid');
            $isfind=I('isfind');
            $iistimefin=I('istimefin');

            if ($isfind){
                $gettime='';
            }
            $gettime=str_replace('+',' ',I('times'));
            $timearr=explode(',',$this->dealtime($gettime));
            $start=trim($timearr[0]);
            $end=trim($timearr[1]);
            //模糊查询
            $keyword=I('keyword');
            $keyword=urldecode($keyword);
          	if(substr_count($keyword,"%")>1){
              for ($i=1; $i<=20; $i++)
              {
                  $keyword=urldecode(urldecode($keyword));
              }
              
            }
            if (empty($getsid)){
                if (!empty($gettime)){
                    $where="o.ordertime >='{$start}' and o.ordertime <='{$end}' and (o.ousername like"."'%".$keyword."%'"
                        ." ||o.ouserphone like"."'%".$keyword."%'"
                       ." ||o.onum like"."'%".$keyword."%'"
                        ." ||o.oid='{$keyword}' || s.dnum='{$keyword}')";
                    //分页数据
                    $count=$orderModel
                        ->alias('o')
                        ->join('left join yx_goods AS g ON o.ogid=g.gid')
                        ->join('left join yx_shop AS s ON o.osid=s.did')
                        ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,g.gticheng,s.dname,s.dnum")//需要显示的字段
                        ->order('o.ordertime DESC')
                        ->where($where)->count();
                }else{
                    $where=" o.oid='{$keyword}' || s.dnum='{$keyword}' || o.ousername like"."'%".$keyword."%'"." ||o.ouserphone like"."'%".$keyword."%'" ." ||o.onum like"."'%".$keyword."%'";
                    //分页数据
                    $count=$orderModel
                        ->alias('o')
                        ->join('left join yx_goods AS g ON o.ogid=g.gid')
                        ->join('left join yx_shop AS s ON o.osid=s.did')
                        ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,g.gticheng,s.dname,s.dnum")//需要显示的字段
                        ->order('o.ordertime DESC')
                        ->where($where)->count();
                }

            }else{
                if (!empty($gettime)){
                    $where="o.osid='{$getsid}' and o.ordertime >='{$start}' and o.ordertime <='{$end}'
                     and (o.oid='{$keyword}'|| o.ousername like"."'%".$keyword."%'"." || s.dnum='{$keyword}'"." || o.onum='{$keyword}'"." ||o.ouserphone like"."'%".$keyword."%')";
                    $count=$orderModel
                        ->alias('o')
                        ->join('left join yx_goods AS g ON o.ogid=g.gid')
                        ->join('left join yx_shop AS s ON o.osid=s.did')
                        ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,g.gticheng,s.dname,s.dnum")//需要显示的字段
                        ->order('o.ordertime DESC')
                        ->where($where)
                        ->count();
                }else{
                    $where="o.osid='{$getsid}' and (o.oid='{$keyword} || s.dnum='{$keyword}' || o.ousername like"."'%".$keyword."%'"." || o.onum='{$keyword}'"." ||o.ouserphone like"."'%".$keyword."%')";
                    $count=$orderModel
                        ->alias('o')
                        ->join('left join yx_goods AS g ON o.ogid=g.gid')
                        ->join('left join yx_shop AS s ON o.osid=s.did')
                        ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,g.gticheng,s.dname,s.dnum")//需要显示的字段
                        ->order('o.ordertime DESC')
                        ->where($where)
                        ->count();
                }

            }
            $pagesize=50;
            $p=getpage($count,$pagesize);
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->join('left join yx_shop AS s ON o.osid=s.did')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,g.gticheng,s.dname,s.dnum")//需要显示的字段
                ->order('o.ordertime DESC')
                ->where($where)
                ->limit($p->firstRow,$p->listRows)
                ->select();//所有信息
            $this->assign('keyword',$keyword);
            $this->assign('findtime',$gettime);
            $this->assign('page', $p->show()); // 赋值分页输出
	
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d H:i:s',$v['oaddtime']);
                $allinfo[$k]['opaymoney']=$v['opaymoney'];
                $desc=$allinfo[$k]['onum'];
                $getps=strpos($desc,'x');
                $gettotostr=substr($desc,$getps,4);
                $allinfo[$k]['onum']=str_replace($gettotostr,'',$desc);

                $allinfo[$k]['goodallmoney']=$v['gyhprice']*$v['buynum'];
                $allinfo[$k]['gticheng']=$v['gticheng']*$v['buynum'];
            }
            $this->info=$allinfo;

            $this->sid=$getsid;
            if(empty($getsid)){
                $this->allcount=$orderModel->sum('buynum');
                $this->todaycount=$orderModel->where('ostatus=1 and to_days(ordertime) = to_days(now())')->sum('buynum');
            }else{
                $this->allcount=$orderModel->where('osid='.$getsid)->sum('buynum');
                $this->todaycount=$orderModel->where('ostatus=1 and to_days(ordertime) = to_days(now()) and osid='.$getsid)->sum('buynum');
            }
            $this->allshop=M('shop')->field('did,discolse,dname')->select();
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }

    //待支付订单
    function nopay()
    {
        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $orderModel=M('order');
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->join('left join yx_shop AS s ON o.osid=s.did')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,g.gticheng,s.dname,s.dnum")//需要显示的字段
                ->order('o.ordertime DESC')
                ->where('o.ostatus=0 ')
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d H:i:s',$v['oaddtime']);
                $allinfo[$k]['opaymoney']=$v['opaymoney'];
                $desc=$allinfo[$k]['onum'];
                $getps=strpos($desc,'x');
                $gettotostr=substr($desc,$getps,4);
                $allinfo[$k]['onum']=str_replace($gettotostr,'',$desc);
                $allinfo[$k]['goodallmoney']=$v['gyhprice']*$v['buynum'];
                $allinfo[$k]['gticheng']=$v['gticheng']*$v['buynum'];
            }
            $this->info=$allinfo;
            $this->nopaycount=$orderModel->where('ostatus=0')->count();
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }
    //待提货
    function payorder()
    {

        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $keyword=trim(I('keyword'));
            $orderModel=M('order');
            //分页数据
            $count=$orderModel->where("ostatus=1 and (oid='{$keyword}' ||ouserphone like"."'%".$keyword."%'"." || onumber like"."'%".$keyword."%')")->count();
            $pagesize=20;
            $p=getpage($count,$pagesize);
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->join('left join yx_shop AS s ON o.osid=s.did')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,g.gticheng,s.dname,s.dnum")//需要显示的字段
                ->order('o.ordertime DESC')
                ->limit($p->firstRow,$p->listRows)
                ->where("o.ostatus=1 and (o.oid='{$keyword}'|| o.ouserphone like"."'%".$keyword."%'"." || o.onumber like"."'%".$keyword."%')")
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d H:i:s',$v['oaddtime']);
                $desc=$allinfo[$k]['onum'];
                $getps=strpos($desc,'x');
                $gettotostr=substr($desc,$getps,4);
                $allinfo[$k]['onum']=str_replace($gettotostr,'',$desc);
                $allinfo[$k]['goodallmoney']=$v['gyhprice']*$v['buynum'];
                $allinfo[$k]['gticheng']=$v['gticheng']*$v['buynum'];
            }
            $this->assign('page', $p->show()); // 赋值分页输出
            $this->keyword=$keyword;
            $this->info=$allinfo;
            $this->paycount=$orderModel->where('ostatus=1')->sum('buynum');
            $this->todaycount=$orderModel->where('ostatus=1 and to_days(ordertime) = to_days(now())')->sum('buynum');
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }
    //已完成的订单
    function finishedorder()
    {
        $getsuperadminname=session('session_superadmin');
        if (!empty($getsuperadminname)){
            $keyword=trim(I('keyword'));
            $orderModel=M('order');
            //分页数据
            $count=$orderModel->where("ostatus=2 and (ouserphone='{$keyword}' || onum like"."'%".$keyword."%'"." || onumber like"."'%".$keyword."%')")->count();
            $pagesize=50;
            $p=getpage($count,$pagesize);
            $allinfo=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->join('left join yx_shop AS s ON o.osid=s.did')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,g.gticheng,s.dname,s.dnum")//需要显示的字段
                ->order('o.ordertime DESC')
                ->limit($p->firstRow,$p->listRows)
                ->where("o.ostatus=2 and (o.ouserphone='{$keyword}' || o.onum like"."'%".$keyword."%'"." || o.onumber like"."'%".$keyword."%')")
                ->select();//所有信息
            foreach ($allinfo as $k=>$v){
                $allinfo[$k]['oaddtime']=date('Y-m-d H:i:s',$v['oaddtime']);
                $desc=$allinfo[$k]['onum'];
                $getps=strpos($desc,'x');
                $gettotostr=substr($desc,$getps,4);
                $allinfo[$k]['onum']=str_replace($gettotostr,'',$desc);
                $allinfo[$k]['goodallmoney']=$v['gyhprice']*$v['buynum'];
                $allinfo[$k]['gticheng']=$v['gticheng']*$v['buynum'];
            }
            $this->assign('page', $p->show()); // 赋值分页输出
            $this->keyword=$keyword;
            $this->info=$allinfo;
            $this->finishedcount=$orderModel->where('ostatus=2')->sum('buynum');
            $this->display();
        }else{
            $this.redirect(__MODULE__."/User/mylogin");
        }
    }
    //处理时间范围
    function  dealtime($str){
        $n = 0;
        for($i = 1;$i <= 3;$i++) {
            $n = strpos($str, '-', $n);
            $i != 3 && $n++;
        }
        return substr($str,0,$n).','.substr($str,$n+1,strlen($str)-1);
    }
    //导出表
    public function exportexe(){
        M('order');
        $gettime=I('times');
        $state=I('status');//ostatus
        if (empty($gettime)){
            $this->error('请输入时间区间','',2);
            $redata['code']=0;
            $redata['msg']='请选择时间';
            echo json_encode($redata);die();
        }
        $timearr=explode(',',$this->dealtime($gettime));
        $start=trim($timearr[0]);
        $end=trim($timearr[1]);
        $orderModel=M('order');
        if (empty($state)){
            $count =$orderModel->where("ordertime >='{$start}' and ordertime <='{$end}' and ostatus>0")->count();
        }else{
            $count =$orderModel->where("ordertime >='{$start}' and ordertime <='{$end}' and ostatus='{$state}'")->count();
        }

        $pagesize = ceil($count/5000);
        //array_unshift( $names,  '活动名称');
        $header = array(
            'dru'=>'配送线路',
            'dnum' => '门店编号',
            'dname' => '订单来源',
            'oid'=>'提单号',
            'onum' => '商品描述',
            'gyhprice' => '价格',
            'buynum' => '数量',
            'goodallmoney' => '单品金额',
            'opaymoney' => '总单金额',
            'ouserphone' => '手机号',
            'ousername' => '用户名',
            'onumber' => '订单号',
            'gticheng' => '提成',
            'oaddtime' => '下单时间',
            'ostatus' => '订单状态'
        );
        $keys = array_keys($header);
        $html = "\xEF\xBB\xBF";
        foreach ($header as $li) {
            $html .= $li . "\t ,";
        }
        $html .= "\n";
        if (empty($state)){
            $where="o.ordertime >='{$start}' and o.ordertime <='{$end}' and ostatus>0";
        }else{
            $where="o.ordertime >='{$start}' and o.ordertime <='{$end}' and ostatus='{$state}'";
        }
        for ($j = 1; $j <= $pagesize; $j++) {
            $list=$orderModel
                ->alias('o')
                ->join('left join yx_goods AS g ON o.ogid=g.gid')
                ->join('left join yx_shop AS s ON o.osid=s.did')
                ->field("o.*,g.gyhprice,g.gtopimg,g.gtitle,g.gid,g.gticheng,s.dname,s.dnum,s.dru")//需要显示的字段
                ->order('o.ordertime DESC')
                ->where($where)
                ->limit(($j - 1) * 5000,5000)
                ->select();//所有信息
            foreach ($list as $k=>$v){
                $list[$k]['oaddtime']=date('Y-m-d H:i:s',$v['oaddtime']);
                $list[$k]['goodallmoney']=$v['gyhprice']*$v['buynum'];
              	$desc=$list[$k]['onum'];
                $getps=strpos($desc,'x');
                $gettotostr=substr($desc,$getps,4);
                $list[$k]['onum']=preg_replace('# #','',str_replace($gettotostr,'',$desc));
            }
        }
        if (!empty($list)) {
            $size = ceil(count($list) / 500);
            for ($i = 0; $i < $size; $i++) {
                $buffer = array_slice($list, $i * 500, 500);
                $user = array();
                foreach ($buffer as $k =>$row) {//'0:表示待付款  1:表示已付款待提货; 2表已经提货，3表示退款

                    $row['ids']= $k+1;
                    if($row['ostatus']==0){
                        $row['ostatus']='待付款';
                    }elseif($row['ostatus']==1){
                        $row['ostatus']='待提货';
                    }elseif($row['ostatus']==2){
                        $row['ostatus']='已提货';
                    }
                    foreach ($keys as $key) {
                        $data5[] = $row[$key];
                    }
                    $user[] = implode("\t ,", $data5) . "\t ,";
                    unset($data5);
                }
                $html .= implode("\n", $user) . "\n";
            }
        }
        //header("Content-type:application/vnd.ms-execl;charset=gb2312");//设置导出格式
        //header("Content-Disposition:attactment;filename=商品订单数据表.xls");//设置导出文件名
        //header("Pragma: no-cache");
        //header("Expires: 0");
        header("Content-type:text/csv");
        header("Content-Disposition:attachment; filename=商品订单数据表.csv");
        echo $html;
        exit();
    }
}