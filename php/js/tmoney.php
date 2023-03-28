<?php
$isl=true;
include $_SERVER['DOCUMENT_ROOT'].'/php/main.php';
$t=$_GET['tid'];
//$q=query("SELECT * FROM tools_money where tid=? and px ORDER BY px",array($a));
if($_GET['n']=='1'){//分站
$a=$pdo->query("SELECT px FROM user_class where vipid='{$user['class']}'")->fetch();
$r = $pdo->query("SELECT * FROM user_class where px<".$a['px']);

$sit=query("SELECT diytool FROM user where uid=?",array($user['uid']))->fetch();
$diyt=json_decode($sit['diytool'],true);
//$r = $pdo->query("SELECT * FROM user_class");
$uclass = $r->fetchAll(PDO::FETCH_ASSOC);
$var="plist=[";
echo '$("#modk").html(';
$b = $pdo->query("SELECT * FROM tools_money where tid='{$t}'")->fetch();
foreach ($uclass as $a){
    $tsm=gettoolmonsite($pdo->query("SELECT * FROM tools where tid='{$t}'")->fetch(),$a['vipid']);
    $var=$var."'{$a['vipid']}',";
    $tj=$diyt[$t][$a['vipid']];
    if(empty($tj))$tj=0;
    echo "ginp('{$a['name']} ( 原价：{$tsm} )','{$a['vipid']}','{$tj}')+";
 }
echo '"");
';
echo $var."];";

}else{
$r = $pdo->query("SELECT * FROM user_class");
$uclass = $r->fetchAll(PDO::FETCH_ASSOC);

$var="plist=[";
echo '$("#modk").html(';
$b = $pdo->query("SELECT * FROM tools_money where tid='{$t}'")->fetch();
foreach ($uclass as $a){
    $var=$var."'{$a['vipid']}',";
    echo "ginp('{$a['name']}','{$a['vipid']}','{$b[$a['vipid']]}')+";
 }
echo '"");
';

echo $var."];";

}