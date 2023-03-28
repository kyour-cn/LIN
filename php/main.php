<?php
session_set_cookie_params(48*3600);//12h
session_start();
//date_default_timezone_set("PRC");
$stime=microtime(true);//开始计时
header('Content-type: text/html; charset=utf-8');
$pmp=$_SERVER['DOCUMENT_ROOT'];
include $pmp.'/config.php';
include 'function.php';
function newpdo(){
    global $dbcf;
	$dsn = 'mysql:host='.$dbcf["host"].';dbname='.$dbcf["dbname"].';port='.$dbcf["port"];
	try{
	$pdo = new PDO($dsn, $dbcf["user"], $dbcf["pwd"]);
	$pdo->query("SET NAMES utf8");
}catch(PDOException $e){
  die("数据库连接失败".$e->getMessage());
}
	return $pdo;
}
function query($s,$a=array()){
    global $pdo;
    $p=$pdo->prepare($s);
    $p->execute($a);
    return $p;
}
$user=null;
$pdo=newpdo();
if($isl){
	if($_SESSION["islogin"]!="1"){
		exit('<script>alert("你还未登录账号，请先注册或登录！");window.location.href="./v.php?login"</script>');
	}
	//已登录
	$user=$pdo->query("SELECT * FROM user where uid='{$_SESSION["user_uid"]}'")->fetch();
}
$a=$pdo->query("SELECT * FROM config");
$conf=array();
foreach ($a as $r){
    $conf[$r['n']]=$r['v'];
}
unset($a);
if($conf['setdt'])date_default_timezone_set("PRC");
$cdn=$conf['cdn'];
$ver="1";