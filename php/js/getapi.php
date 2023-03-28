<?php
$isl=true;
include $_SERVER['DOCUMENT_ROOT'].'/php/main.php';


$a=query("SELECT * FROM tools where tid=?",array($_GET['tid']))->fetch();
$i="[input]";
$aa=count(explode("|",$a['inputs']));

for($x=1; $x<$aa; $x++){
    $i.="|[input{$x}]";
}
echo "http://{$this_host}/api.php?order&key={$user['apikey']}&tid={$_GET['tid']}&input={$i}&num={$a['num']}";