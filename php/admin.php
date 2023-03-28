<?php
$isl = true;
include './main.php';
if($conf['admin']!=$_SESSION["user_uid"])exit("<script>alert('你不是管理员'); history.go(-1);</script>");;
@$ym = $_SERVER["QUERY_STRING"];
$yms = explode("&", $ym);
switch($yms[0]){
    case "system":
        $a=trims($_POST['name']);
        $b=trims($_POST['title']);
        $c=trims($_POST['cdn']);
        $d=trims($_POST['ccon']);
        $e=trims($_POST['gg']);
        $f=trims($_POST['ptime']);
        query("
UPDATE config SET v = ? WHERE n = 'name';
UPDATE config SET v = ? WHERE n = 'title';
UPDATE config SET v = ? WHERE n = 'cdn';
UPDATE config SET v = ? WHERE n = 'ccon';
UPDATE config SET v = ? WHERE n = 'gg';
UPDATE config SET v = ? WHERE n = 'ptime';
        ",array($a,$b,$c,$d,$e,$f));
        $_SESSION["alert"] = alert("修改成功！");
        exit("<script>history.go(-1);</script>");
        break;
    case "userdel":
        query("DELETE FROM user WHERE uid = ?",array($yms[1]));
        $_SESSION["alert"] = alert("用户删除成功！");
        exit("<script>history.go(-1);</script>");
    break;
    case "user_classdel":
        if($yms[1]=="main")exit("<script>alert('默认用户组，不能删除！'); history.go(-1);</script>");
        query("DELETE FROM user_class WHERE vipid = ?",array($yms[1]));
        $pdo->query("ALTER TABLE tools_money DROP {$yms[1]}");
        $pdo->query("UPDATE user SET class = 'main' WHERE class = '{$yms[1]}'");
        $_SESSION["alert"] = alert("用户分组删除成功！");
        exit("<script>history.go(-1);</script>");
    break;
    case "classdel":
        query("DELETE FROM class WHERE tid = ?",array($yms[1]));
        $_SESSION["alert"] = alert("商品分类删除成功！");
        exit("<script>history.go(-1);</script>");
    break;
    case "toolsdel":
        query("DELETE FROM tools WHERE tid = ?",array($yms[1]));
        $_SESSION["alert"] = alert("商品删除成功！");
        exit("<script>history.go(-1);</script>");
    break;
    case "dddel":
        query("DELETE FROM orders WHERE tradeno = ?",array($yms[1]));
        $_SESSION["alert"] = alert("订单删除成功！");
        exit("<script>history.go(-1);</script>");
    break;
    case "userupd":
        $u=trims($_POST['uid']);
        $n=trims($_POST['name']);
        $q=trims($_POST['qq']);
        $m=trims($_POST['money']);
        $p=trims($_POST['pass']);
        $cl=trims($_POST['cid']);
        $zt="0";
        if(!empty($_POST['zt']))$zt=1;
        if($yms[1]=="add"){
        $num = query("select uid from user where uid=?", array($u))->fetch();
        if ($num){
            exit("<script>alert('用户名已存在'); history.go(-1);</script>");
        }
        $skey = "";
    	$strPol = "123456789abcdefghijklmnpqrstuvwxyz";
	    $max = strlen($strPol)-1;
        for($i=0;$i<8;$i++){
                $skey.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        //判断key是否存在
        while(($pdo->query("SELECT count(Id) from user where apikey='{$skey}'")->fetch()[0]!=0)){
        $skey = "";
        for($i=0;$i<8;$i++){
                $skey.=$strPol[rand(0,$max)];
        }
        }
            query("INSERT INTO user(uid,pass,name,zt,qq,class,date,apikey) VALUES (?, ?, ?, ?,?,?,?,?)",array($u,$p,$n,$zt,$q,$cl,date('Y-m-d H:i:s'),$skey));
            $_SESSION["alert"] = alert("用户添加成功！");
        }else{
            query("UPDATE user SET name = ?, qq = ?, money = ?, class=?, zt=? WHERE uid = ?",array($n,$q,$m,$cl,$zt,$yms[1]));
        }
        if(!empty($p)){
            query("UPDATE user SET pass = ? WHERE uid = ?",array($p,$yms[1]));
        }
        $_SESSION["alert"] = alert("修改资料成功！");
        if(!empty($u)){
            query("UPDATE user SET uid = ? WHERE uid = ?",array($u,$yms[1]));
            exit("<script>window.location.href='../view.php?admin&user_edit&{$u}';</script>");
        }
        exit("<script>history.go(-1);</script>");
    break;
    case "classupd":
        $u=trims($_POST['cid']);
        $n=trims($_POST['name']);
        $z=trims($_POST['zt']);
        $p=trims($_POST['px']);
        $fu=$yms[1];
        $_SESSION["alert"] = alert("修改分类信息成功！");
        if($yms[1]=="add"){
        $_SESSION["alert"] = alert("添加分类成功！");
            query("INSERT INTO class(cid,name,zt,px) VALUES (?,?,?,?)",array($u,$n,$z,$p));
        }else{
        if(!empty($u)){
            $fu=$u;
            query("UPDATE class SET cid = ? WHERE cid = ?",array($u,$yms[1]));
        }
            query("UPDATE class SET name=?,zt=?,px=? WHERE cid = ?",array($n,$z,$p,$fu));
        }
            exit("<script>window.location.href='../view.php?admin&class_edit&{$fu}';</script>");
    break;
    case "user_classupd":
        $u=trims($_POST['vipid']);
        $n=trims($_POST['name']);
        $m=trims($_POST['money']);
        $z=trims($_POST['zk']);
        $p=trims($_POST['px']);
        $fu=$yms[1];
        $_SESSION["alert"] = alert("修改用户分组成功！");
        if($yms[1]=="add"){
        if($u=="main")exit("<script>alert('main为默认用户组id，不能添加！'); history.go(-1);</script>");
        $_SESSION["alert"] = alert("添加用户分组成功！");
            query("INSERT INTO user_class(vipid,name,money,zk,px) VALUES (?,?,?,?,?)",array($u,$n,$m,$z,$p));
            $pdo->query("alter table tools_money add {$u} varchar(16) NOT NULL DEFAULT 'main';");
            //exit("<script>window.location.href='../view.php?admin&user_class_edit&{$u}';</script>");
        }else{
        if(!empty($u)){
            $fu=$u;
            query("UPDATE user_class SET vipid = ? WHERE vipid = ?",array($u,$yms[1]));
            $pdo->query("ALTER TABLE tools_money CHANGE {$yms[1]} {$u} varchar(16) NOT NULL DEFAULT 'main';");
        }
            query("UPDATE user_class SET name=?,money=?,zk=?,px=? WHERE vipid = ?",array($n,$m,$z,$p,$fu));
        }
            exit("<script>window.location.href='../view.php?admin&user_class_edit&{$fu}';</script>");
    break;
    case "toolsupd":
        $u=trims($_POST['tid']);
        $n=trims($_POST['name']);
        $m=trims($_POST['money']);
        $i=trims($_POST['inputs']);
        $c=trims($_POST['cid']);
        $cl=trims($_POST['clid']);
        $cv=$_POST['clval'];
        $cp=trims($_POST['clpost']);
        $co=$_POST['cookie'];
        $t=str_replace("\n","\\n",trims($_POST['text']));
        $p=trims($_POST['px']);
        $zt="0";
        if(!empty($_POST['zt']))$zt=1;
        $fu=$yms[1];
        if($yms[1]=="add"){
        $_SESSION["alert"] = alert("商品添加成功！");
            query("INSERT INTO tools(tid,name,money,zt,px,text,class,clid,inputs) VALUES (?,?,?,?,?,?,?,?,?)",array($u,$n,$m,$zt,$p,$t,$c,$cl,$i));
            query("INSERT INTO tools_money(tid) VALUES (?)",array($u));
        }else{
        $_SESSION["alert"] = alert("商品修改成功！");
        if(isset($cv))query("UPDATE tools SET clval = ? WHERE tid = ?",array($cv,$fu));
        if(isset($cp))query("UPDATE tools SET clpost = ? WHERE tid = ?",array($cp,$fu));
        if(isset($co))query("UPDATE tools SET cookie = ? WHERE tid = ?",array($co,$fu));
        if(!empty($u)){
            query("UPDATE tools SET tid = ? WHERE tid = ?",array($u,$fu));
            $fu=$u;
        }
            query("UPDATE tools SET name=?,money=?,zt=?,px=?,text=?,class=?,clid=?,inputs=? WHERE tid = ?",array($n,$m,$zt,$p,$t,$c,$cl,$i,$fu));
        }
        exit("<script>window.location.href='../view.php?admin&tools_edit&{$fu}';</script>");
    break;
    case "tmoneyupd":
    $a=trims($_POST['data']);
    $in=explode('|',$a);
    $t=trims($_POST['tid']);
    $l=count($in);
    $a="";
    //$j="";
for($i=0;$i<$l;$i++){
$a=trims($_POST[$in[$i]]);
query("UPDATE tools_money SET {$in[$i]} = ? WHERE tid = ?",array($a,$t));
    //$j=$j."/".$in[$i]."=".$a;
 }//exit($j.$t);
    exit("修改成功！");
    break;
    default:
        exit("<script>alert('找不到该操作'); history.go(-1);</script>");
}