<?php
$zname = "科佑儿下单平台";
/*
$dbcf = array(
    'host' => '39.105.36.166', //数据库服务器
    'port' => 3306, //数据库端口
    'user' => 'lsdb', //数据库用户名
    'pwd' => 'lsdb123123', //数据库密码
    'dbname' => 'lsdb', //数据库名
);
*/
$dbcf = array(
    'host' => 'localhost', //数据库服务器
    'port' => 3306, //数据库端口
    'user' => 'cs11', //数据库用户名
    'pwd' => 'cs111', //数据库密码
    'dbname' => 'cs11', //数据库名
);

//程序运行根目录，请勿改动
$pmp=$_SERVER['DOCUMENT_ROOT'];
//程序访问域名，无特殊原因请勿修改
$this_host=$_SERVER['SERVER_NAME'];
$this_url="http://".$this_host;