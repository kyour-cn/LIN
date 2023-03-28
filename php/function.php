<?php

//常量 define(n,v);

$df_cl=array('未支付','待处理','正在处理','成功','失败','已退款');
$df_j=array('','充值','消费','转账');
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