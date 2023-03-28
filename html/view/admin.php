<?php
if($conf['admin']!=$_SESSION["user_uid"]){
exit( "你不是系统管理员，无法访问系统设置");
}
$btitle="后台管理"; 
$path = "./html/admin/" . $yms[1] . ".php";

    if (!is_file($path)) {
        echo "不存在该页面请求";
        exit;
    }
include $path;