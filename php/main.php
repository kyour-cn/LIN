<?php
//error_reporting(0);
$stime=time();//开始计时
//if(!isset($_SESSION['last_access'])||($stime-$_SESSION['last_access'])>60)$_SESSION['last_access']=$stime;
header('Content-type: text/html; charset=utf-8');
$pmp=$_SERVER['DOCUMENT_ROOT'];
include $pmp.'/config.php';
include 'function.php';

$user=null;
$pdo=newpdo();

define('SESSION_MAXLIFETIME', 48*3600);//get_cfg_var('session.gc_maxlifetime')
//function startSession() {
ini_set('session.gc_maxlifetime', SESSION_MAXLIFETIME);
session_set_cookie_params(SESSION_MAXLIFETIME);

/*
session_set_save_handler(
    'sessionMysqlOpen',
    'sessionMysqlClose',
    'sessionMysqlRead',
    'sessionMysqlWrite',
    'sessionMysqlDestroy',
    'sessionMysqlGc');
register_shutdown_function('session_write_close');
sessionMysqlId();
*/
session_start();
//}
if($isl){
	if($_SESSION["islogin"]!="1"){
		exit('<script>alert("你还未登录账号，请先注册或登录！");window.location.href="./v.php?login"</script>');
	}
	$user=$pdo->query("SELECT * FROM user where uid='{$_SESSION["user_uid"]}'")->fetch();
}
$a=$pdo->query("SELECT n,v FROM config");
$conf=array();
foreach ($a as $r){
    $conf[$r['n']]=$r['v'];
}
unset($a);
if($conf['ptime']==1)date_default_timezone_set("PRC");
$cdn=$conf['cdn'];
$ver="2";

$issite=false;
$sites=opensite();