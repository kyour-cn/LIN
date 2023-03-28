<?php
empty($_SERVER['HTTP_VIA']) or exit('Access Denied'); 
$timestampcc = time();
$cc_nowtime = $timestampcc;
if(isset($_SESSION['cc_lasttime'])){
    $cc_lasttime = $_SESSION['cc_lasttime'];
    $cc_times = $_SESSION['cc_times']+1;
    $_SESSION['cc_times'] = $cc_times;
}else{
    $cc_lasttime = $cc_nowtime;
    $cc_times = 1;
    $_SESSION['cc_times'] = $cc_times;
    $_SESSION['cc_lasttime'] = $cc_lasttime;
}
if(($cc_nowtime-$cc_lasttime)<3){
    if($cc_times>=5){
        echo '请等待5秒！<script>alert("操作太快!")</script>';
        exit;
    }
}else{
    $cc_times = 0;
    $_SESSION['cc_lasttime'] = $cc_nowtime;
    $_SESSION['cc_times'] = $cc_times;
}