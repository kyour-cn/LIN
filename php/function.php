<?php
//常量 define(n,v);

$df_cl=array('未支付','待处理','正在处理','成功','失败','已退款');
$df_j=array('','充值','消费','转账',"退款");
$df_clid=array('不处理','URL/POST','Email','SHOP');
//函数
function cp($c,$b="",$a=false) {
    $d = curl_init();
    $e = curl_setopt($d, CURLOPT_URL, $c);
    curl_setopt($d, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($d, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($d, CURLOPT_HEADER, 0);
    curl_setopt($d, CURLOPT_TIMEOUT_MS, 5000);
    curl_setopt($d, CURLOPT_POST, 0);
    curl_setopt($d, CURLOPT_POSTFIELDS, $b);
    curl_setopt($d, CURLOPT_RETURNTRANSFER, 1);
    if($a!=false) curl_setopt($d, CURLOPT_HTTPHEADER, $a);
    $f = curl_exec($d);
    if ($f === false) {
        if (curl_errno($d) == CURLE_OPERATION_TIMEDOUT) {
            return "";
        }
    }curl_close($d);
    if ($f == NULL) {
        return "";
    }return $f;
}
$apipath=base64_decode("aHR0cDovL3cua3lvdXIudmlwL2xpbi9zcS5waHA=");
function trims($a){
global $pur;
global $pmp;
if(!isset($pur)){
require_once($pmp.'/php/hpf/library/HTMLPurifier.auto.php');
$pur = new HTMLPurifier(HTMLPurifier_Config::createDefault());
}
    return $pur->purify($a);
}

function alert($s,$m=0){
    if($m!=0)
    return '<div class="alert alert-danger" role="alert">'.$s.'</div>';
    else
    return'<div class="alert alert-success" role="alert">'.$s.'</div>';
}
function newpdo($a=null){
    global $dbcf;
	$dsn = 'mysql:host='.$dbcf["host"].';dbname='.$dbcf["dbname"].';port='.$dbcf["port"];
	try{
	$pdo = new PDO($dsn, $dbcf["user"], $dbcf["pwd"]);
	$pdo->query("SET NAMES utf8");
	if($a==null) $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
}catch(PDOException $e){
  die("数据库连接失败".$e->getMessage());
}
	return $pdo;
}
function query($s,$a=array()){
    global $pdo;
    try{
    $p=$pdo->prepare($s);
    $p->execute($a);
    } catch (PDOException $e) {
        die("数据库连接失败".$e->getMessage());
    }
    return $p;
}
function isnum($n){
    if(is_array($n)){
        foreach ($n as $v) {
            if(!is_numeric($v))return false;
        }
        return true;
    }
    return is_numeric($n);
}

//SESSION解决方案

function getConnection() {
global $pdo;
return $pdo;
}

//自定义的session的open函数
function sessionMysqlOpen($savePath, $sessionName) {
    return TRUE;
}

//自定义的session的close函数
function sessionMysqlClose() {
    return TRUE;
}
function sessionMysqlRead($sessionId) {
    try {
        $dbh = getConnection();
        $time = time();
        
        $sql = 'SELECT count(*) AS `count` FROM session '
                . 'WHERE skey = ? and expire > ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($sessionId, $time));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data['count'] = 0) {
            return '';
        }
        
        $sql = 'SELECT `data` FROM `session` '
                . 'WHERE `skey` = ? and `expire` > ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($sessionId, $time));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['data'];
    } catch (Exception $e) {
        return '';
    }
}
function sessionMysqlWrite($sessionId, $data) {
    try {
        $dbh = getConnection();
        $expire = time() + SESSION_MAXLIFETIME;

        $sql = 'INSERT INTO `session` (`skey`, `data`, `expire`) '
                . 'values (?, ?, ?) '
                . 'ON DUPLICATE KEY UPDATE data = ?, expire = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($sessionId, $data, $expire, $data, $expire));
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function sessionMysqlDestroy($sessionId) {
    try {
        $dbh = getConnection();

        $sql = 'DELETE FROM `session` where skey = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($sessionId));
        return TRUE;
    } catch (Exception $e) {
        return FALSE;
    }
}
function sessionMysqlGc($lifetime) {
    try {
        $dbh = getConnection();

        $sql = 'DELETE FROM `session` WHERE expire < ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(time()));
        $dbh = NULL;
        return TRUE;
    } catch (Exception $e) {
        return FALSE;
    }
}
function sessionMysqlId() {
    if (filter_input(INPUT_GET, session_name()) == '' and
            filter_input(INPUT_COOKIE, session_name()) == '') {
        try {
            $dbh = getConnection();
            $stmt = $dbh->query('SELECT uuid() AS uuid');
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $data = str_replace('-', '', $data['uuid']);
            session_id($data);
            return TRUE;
        } catch (Exception $ex) {
            return FALSE;
        }
        
    }
}
//结束SESSION

//计算站点价格
function getmytoolmon($tool){
    global $user;
    global $pdo;
    global $issite;
    global $conf;
    $userc=$user['class'];
    $b = $pdo->query("SELECT * FROM tools_money where tid='{$tool['tid']}'")->fetch();
    $money=$b[$userc];
    if($money=="main"){
        $money=$tool['money'];
        $c = $pdo->query("SELECT iszk FROM class where cid='{$tool['class']}'")->fetch();
        if($c['iszk']=="1"){
        $uc=$pdo->query("SELECT zk FROM user_class where vipid='{$userc}'")->fetch();
        $money=round($money*($uc['zk']/100),8);
        }
    }
    //分站提成计算
    if($issite){
        $sit=query("SELECT diytool FROM user where uid=?",array($conf['siteuid']))->fetch();
        $diyt=json_decode($sit['diytool'],true);
        //print_r($diyt);
        //echo "\n".$tool['tid']."/".[$userc]."/".$diyt[$tool['tid']][$userc];
        //exit;
        $tj=$diyt[$tool['tid']][$userc];
        if(empty($tj))$tj=0;
        $money+=$tj;
    }
    return $money;
}

function getsitetc($tid){//计算分站提成
    global $user;
    global $issite;
    global $conf;
    $userc=$user['class'];
    $money=0;
    //分站提成计算
    if($issite){
        $sit=query("SELECT diytool FROM user where uid=?",array($conf['siteuid']))->fetch();
        $diyt=json_decode($sit['diytool'],true);
        $tj=$diyt[$tid][$userc];
        if(empty($tj))$tj=0;
        $money=$tj;
    }
    return $money;
}

function gettoolmonsite($tool,$uc=""){//no site+
    global $user;
    global $pdo;
    $userc=($uc=="")?$user['class']:$uc;
    $b = $pdo->query("SELECT * FROM tools_money where tid='{$tool['tid']}'")->fetch();
    $money=$b[$userc];
    if($money=="main"){
        $money=$tool['money'];
        $c = $pdo->query("SELECT iszk FROM class where cid='{$tool['class']}'")->fetch();
        if($c['iszk']=="1"){
        $uc=$pdo->query("SELECT zk FROM user_class where vipid='{$userc}'")->fetch();
        $money=round($money*($uc['zk']/100),8);
        }
    }
    return $money;
}
function opensite(){
    global $usersite;
    global $conf;
    global $issite;
    $usersite= query("SELECT diyconf FROM user where host=?",array($_SERVER['HTTP_HOST']));
    $site=count($usersite->fetchAll(PDO::FETCH_ASSOC));
    if($site==1){
        $site=query("SELECT diyconf,uid,class FROM user where host=?",array($_SERVER['HTTP_HOST']))->fetch();
        $uclass=query("SELECT issite FROM user_class where vipid=?",array($site['class']))->fetch();
        if($uclass['issite']!=1){
            return array();
        }
        $issite=true;
        $sites=explode("|.|", $site['diyconf']);
        $conf['name']=$sites[0];
        $conf['title']=$sites[1];
        $conf['gg']=$sites[2];
        $conf['siteuid']=$site['uid'];
    }
    return $sites;
}