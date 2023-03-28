<?php
//工单系统
$isl = true;
include './main.php';
//if($conf['admin']!=$_SESSION["user_uid"])exit("<script>alert('你不是管理员'); history.go(-1);</script>");
@$ym = $_SERVER["QUERY_STRING"];
$yms = explode("&", $ym);

//cid

switch($yms[0]){
    case "del":
        if($conf['admin']!=$_SESSION["user_uid"])exit("<script>alert('你不是管理员'); history.go(-1);</script>");
        query("DELETE FROM gd WHERE Id = ?;DELETE FROM gd WHERE gid = ?",array($yms[1],$yms[1]));
        $_SESSION["alert"] = alert("工单删除成功！");
        header("Location:../view.php?admin&gd");
    break;
    case "end":
        if($conf['admin']!=$_SESSION["user_uid"])exit("<script>alert('你不是管理员'); history.go(-1);</script>");
        query("UPDATE gd SET uc =1 WHERE Id = ?",array($yms[1]));
        $_SESSION["alert"] = alert("工单结束成功！");
        header("Location:../view.php?admin&gd");
    break;
    case "upd":
        $t=trims($_POST['text']);
        $td=date("Y-m-d H:i:s",time());
        
        if($yms[1]=="add"){
        query("INSERT INTO `gd`(`uid`, `cid`, `text`, `time`) VALUES (?,0,?,?)",array($user['uid'],$t,$td));
        $_SESSION["alert"] = alert("工单创建成功！");
        header("Location:../view.php?gd");
        exit;
        }
        
        query("INSERT INTO gd(`uid`, `cid`, `text`, `uc`, `time`, `gid`) VALUES (?, 1,?, '0', ?, ?)",array($user['name'],$t,$td,$yms[1]));
        header("Location:../view.php?gd_view&{$yms[1]}");
    break;
    case "ad_upd":
        if($conf['admin']!=$_SESSION["user_uid"])exit("<script>alert('你不是管理员'); history.go(-1);</script>");
        $t=trims($_POST['text']);
        $td=date("Y-m-d H:i:s",time());
        query("INSERT INTO gd(`uid`, `cid`, `text`, `uc`, `time`, `gid`) VALUES (?, 1,?, '1', ?, ?)",array($user['name'],$t,$td,$yms[1]));
        header("Location:../view.php?admin&gd_view&{$yms[1]}");
    break;
    default:
    exit("<script>alert('找不到该操作'); history.go(-1);</script>");
}