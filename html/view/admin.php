<?php
$a=$pdo->query("SELECT * FROM config");
$conf=array();
foreach ($a as $r){
    $conf[$r['n']]=$r['v'];
}
if ($conf['admin'] != $_SESSION["user_uid"]) {
    exit("你不是系统管理员，无法访问系统设置");
}
$btitle = "后台管理";
?>

<div class="row">
    <div class="col-lg-8 col-xs-12">
        <ul class="nav nav-tabs nav-justified">
            <li role="presentation" id="nsystem"><a href="admin-system">系统设置</a></li>
            <li role="presentation" class="btn-group" id="nuser">
                <a href="admin-tools" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">用户管理<span class="caret"></a>
                <ul class="dropdown-menu">
                    <li><a href="admin-user">所有用户</a></li>
                    <li><a href="admin-user_class">用户组管理</a></li>
                </ul>
            </li>
            <li role="presentation" class="btn-group" id="ntools">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">商品管理<span class="caret"></a>
                <ul class="dropdown-menu">
                    <li><a href="admin-class">分类管理</a></li>
                    <li><a href="admin-tools">所有商品</a></li>
                    <li><a href="admin-tools_money">商品价格</a></li>
                </ul>
            </li>
            <li role="presentation" id="ndd"><a href="admin-dd">订单管理</a></li>
            <li role="presentation" id="ngd"><a href="admin-gd">工单管理</a></li>
            <li role="presentation" class="btn-group" id="ngg">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">公告/消息<span class="caret"></a>
                <ul class="dropdown-menu">
                    <li><a href="admin-gg">公告设置</a></li>
                    <li><a href="admin-news">站内消息</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<?php
$path = "./html/admin/" . $yms[1] . ".php";
if (!is_file($path)){
    echo "不存在该页面请求";
    exit;
}
include $path;
if (!isset($adtag))
    $adtag = $yms[1];
$botjs = '$("#n' . $adtag . '").addClass("active");';
