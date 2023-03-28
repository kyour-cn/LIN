<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/main.php';
$apipath=$apipath."?".$ver;
$a=eval(cp($apipath,$this_host));
echo $a;
if($a=="code"){
include "../code.php";
}




