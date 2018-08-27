<?php
return array(
	//'配置项'=>'配置值'
    //页面底部显示跟踪信息
    'SHOW_PAGE_TRACE'=>false,
    //关闭缓存
    'TMPL_CACHE_ON' => false,
    'HTML_CACHE_ON' => false,
    //设置默认分组
    'DEFAULT_MODULE'=>'Home',// 默认模块
    //定义可供访问的分组列表
    'MODULE_ALLOW_LIST'=>array('Home','Admin','Superadmin'),

    /*数据库配置*/
    'DB_TYPE'            =>'mysql',         //数据库类型
    'DB_HOST'            =>'localhost',     //服务器地址
    'DB_NAME'            =>'web',        //数据库名
    'DB_USER'            =>'web',          //用户名
    'DB_PWD'             =>'zccm123456',           //密码
    'DB_PORT'            =>'3306',          //端口
    'DB_PREFIX'          =>'yx_',           //数据表前缀
    'DB_PARAMS'          =>array(),         //数据库链接参数
    'DB_DEBUG'           =>true,            //数据库调试模式，开启后可以记录sql日志
    'DB_FIELDS_CACHE'   =>true,            //启用字段缓存
    'DB_CHARSET'         =>'utf8',         //数据库编码默认采用utf8
);