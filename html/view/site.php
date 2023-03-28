<?php
$uclass=$pdo->query("SELECT * FROM user_class where vipid='{$user['class']}'")->fetch();
if($uclass['issite']!=1){ 
    exit("你的用户组不允许使用分站，你无权访问；");
}
$btitle = "站点管理";
$usersite= query("SELECT diyconf FROM user where uid=?",array($user['uid']));
$site=count($usersite->fetchAll(PDO::FETCH_ASSOC));
if($site==1){
    $sites=query("SELECT diyconf FROM user where uid=?",array($user['uid']))->fetch();
    //exit($sites['uid']);
    $issite=true;
    $sites=explode("|.|", $sites['diyconf']);
    $conf['name']=$sites[0];
    $conf['title']=$sites[1];
    $conf['gg']=$sites[2];
}
?>

<?php
$path = "./html/site/" . $yms[1] . ".php";

if (!is_file($path)) {
    echo "不存在该页面请求";
    exit;
}
include $path;
if (!isset($adtag))
    $adtag = $yms[1];
