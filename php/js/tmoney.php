<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/main.php';
$t=$_GET['tid'];
//$q=query("SELECT * FROM tools_money where tid=? ORDER BY px",array($a));
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