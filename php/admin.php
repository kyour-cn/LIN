<?php
$isl = true;
include './main.php';
@$ym = $_SERVER["QUERY_STRING"];
$yms = explode("&", $ym);
$time=date("Y-m-d H:i:s",time());
switch ($yms[0]) {
    case "tsuclass":
        $a = trims($_POST['ucid']);
        $aa=query("SELECT * FROM user_class where vipid=?",array($a))->fetch();
        if(!isset($aa['vipid']))exit('用户组不存在');
        $km=$aa['money']-$user['sitem'];
        if($km<0)$km=0;
        if($km>$user['money'])exit("升级失败,用户余额不足");
        query("UPDATE user SET money = money-{$km},xfmoney=xfmoney+{$km},sitem=sitem+{$km},class=? WHERE uid = ?", array($a, $user['uid']));
        if($km>0){
            query("INSERT user_log (uid,time,name,m,cid) VALUES ('{$user['uid']}','{$time}','提升用户组：{$aa['name']}','{$km}','2')",array());
        }
        $_SESSION["alert"] = alert("提升用户组成功");
        exit("ok");
        break;
    case "sethost":
        $a = trims($_POST['qz']);
        $b = trims($_POST['host']);
        if($a=="www"||$a=="")exit("<script>alert('前缀不能为www或留空'); history.go(-1);</script>");
        if(!preg_match("/^[a-z\d]*$/i",$a))exit("<script>alert('前缀只能为英文字母和数字'); history.go(-1);</script>");
        $h=$a.".".$b;
        $hh = query("select host from user where host=?", array($h))->fetch();
        if($hh)exit("<script>alert('该域名已被注册'); history.go(-1);</script>");
        query("UPDATE user SET host = ? WHERE uid = ?", array($h, $user['uid']));
        $_SESSION["alert"] = alert("域名设置成功");
        exit("<script>window.location.href='../v-user';</script>");
        break;
    case "mysiteupd"://站点设置
        $a = trims($_POST['name']);
        $b = trims($_POST['title']);
        $g = trims($_POST['ggtext']);
        $str=implode("|.|",array($a,$b,$g));
        query("UPDATE user SET diyconf = ? WHERE uid = ?", array($str, $user['uid']));
        exit("<script>window.location.href='../v-site-set';</script>");
        break;
    case "sitemupd":
        $a = trims($_POST['data']);
        $in = explode('|', $a);
        $t = trims($_POST['tid']);
        $l = count($in);
        $as=array();
        
        //$ts=$pdo->query("SELECT diytool FROM user where uid='{$user["uid"]}'")->fetch();
        $as=json_decode($user['diytool'],true);
        for ($i = 0; $i < $l; $i++) {
            $a = trims($_POST[$in[$i]]);
            $a = ($a=="")?0:$a;
            if(!isnum($a)){
                $_SESSION["alert"] = alert("输入内容只能为数值:{$a}",1);
                exit;
            }
            //query("UPDATE tools_money SET {$in[$i]} = ? WHERE tid = ?", array($a, $t));
            $as[$t][$in[$i]]=$a;
        }
        $j=json_encode($as);
        query("UPDATE user SET diytool = ? WHERE uid = ?", array($j, $user['uid']));
        $_SESSION["alert"] = alert("修改成功");
        exit("ok");
        break;
}


if ($conf['admin'] != $_SESSION["user_uid"])
    exit("<script>alert('你不是管理员'); history.go(-1);</script>");
switch ($yms[0]) {
    case "system":
        $a = trims($_POST['name']);
        $b = trims($_POST['title']);
        $c = trims($_POST['cdn']);
        $d = trims($_POST['ccon']);
        $h = trims($_POST['hosts']);
        $f = trims($_POST['ptime']);
        query("
UPDATE config SET v = ? WHERE n = 'name';
UPDATE config SET v = ? WHERE n = 'title';
UPDATE config SET v = ? WHERE n = 'cdn';
UPDATE config SET v = ? WHERE n = 'ccon';
UPDATE config SET v = ? WHERE n = 'hosts';
UPDATE config SET v = ? WHERE n = 'ptime';
        ", array($a,$b,$c,$d,$h,$f));
        $_SESSION["alert"] = alert("修改成功！");
        exit("<script>history.go(-1);</script>");
        break;
    case "systemgg":
        $a = trims($_POST['ggtext']);
        query("
UPDATE config SET v = ? WHERE n = 'gg';
        ", array($a));
        $_SESSION["alert"] = alert("修改成功！");
        exit("<script>history.go(-1);</script>");
        break;
    case "systemtg":
        //$a = trims($_POST['ggtext']);
        $v1=implode("|.|",array($_POST['va1'],$_POST['vb1'],$_POST['vc1'],$_POST['vd1']));
        $v2=implode("|.|",array($_POST['va2'],$_POST['vb2'],$_POST['vc2'],$_POST['vd2']));
        $v3=implode("|.|",array($_POST['va3'],$_POST['vb3'],$_POST['vc3'],$_POST['vd3']));
        $v4=implode("|.|",array($_POST['va4'],$_POST['vb4'],$_POST['vc4'],$_POST['vd4']));
        query("
UPDATE news SET c2 =?,c3=?,c4=?,text=? WHERE c1 = 'top';
        ", array($v1,$v2,$v4,$v3));
        $_SESSION["alert"] = alert("修改成功！");
        exit("<script>history.go(-1);</script>");
        break;
    case "userdel":
        query("DELETE FROM user WHERE uid = ?", array($yms[1]));
        $_SESSION["alert"] = alert("用户删除成功！");
        exit("<script>history.go(-1);</script>");
        break;
    case "user_classdel":
        if ($yms[1] == "main")
            exit("<script>alert('默认用户组，不能删除！'); history.go(-1);</script>");
        query("DELETE FROM user_class WHERE vipid = ?", array($yms[1]));
        $pdo->query("ALTER TABLE tools_money DROP {$yms[1]}");
        $pdo->query("UPDATE user SET class = 'main' WHERE class = '{$yms[1]}'");
        $_SESSION["alert"] = alert("用户分组删除成功！");
        exit("<script>history.go(-1);</script>");
        break;
    case "classdel":
        query("DELETE FROM class WHERE cid = ?", array($yms[1]));
        $_SESSION["alert"] = alert("商品分类删除成功！");
        exit("<script>history.go(-1);</script>");
        break;
    case "newdel":
        query("DELETE FROM news WHERE nid = ?", array($yms[1]));
        $_SESSION["alert"] = alert("消息删除成功！");
        exit("<script>history.go(-1);</script>");
        break;
    case "toolsdel":
        query("DELETE FROM tools WHERE tid = ?", array($yms[1]));
        $_SESSION["alert"] = alert("商品删除成功！");
        exit("<script>history.go(-1);</script>");
        break;
    case "dddel":
        query("DELETE FROM orders WHERE tradeno = ?", array($yms[1]));
        $_SESSION["alert"] = alert("订单删除成功！");
        exit("<script>history.go(-1);</script>");
        break;
        
    case "newupd":
        $n = trims($_POST['name']);
        $t = trims($_POST['text']);
        $d=date("Y-m-d H:i:s",time());
        $fu = $yms[1];
        $_SESSION["alert"] = alert("修改消息成功！");
        if ($yms[1] == "add") {
            $_SESSION["alert"] = alert("添加消息成功！");
            query("INSERT INTO news(c1,c2,time,text) VALUES ('new',?,?,?)", array($n,$d,$t));
        } else {
            query("UPDATE news SET c2=?,text=?,time=? WHERE nid = ?", array($n,$t,$d,$fu));
        }
        exit("<script>window.location.href='../admin-new_edit-{$fu}';</script>");
        break;
    case "userupd":
        $u = trims($_POST['uid']);
        $n = trims($_POST['name']);
        $q = trims($_POST['qq']);
        $m = trims($_POST['money']);
        $p = trims($_POST['pass']);
        $cl = trims($_POST['cid']);
        $zt = "0";
        if (!empty($_POST['zt']))
            $zt = 1;
        if ($yms[1] == "add") {
            $num = query("select uid from user where uid=?", array($u))->fetch();
            if ($num) {
                exit("<script>alert('用户名已存在'); history.go(-1);</script>");
            }
            $skey = "";
            $strPol = "123456789abcdefghijklmnpqrstuvwxyz";
            $max = strlen($strPol) - 1;
            for ($i = 0; $i < 8; $i++) {
                $skey .= $strPol[rand(0, $max)]; //rand($min,$max)生成介于min和max两个数之间的一个随机整数
            }
            //判断key是否存在
            while (($pdo->query("SELECT count(Id) from user where apikey='{$skey}'")->fetch()[0] != 0)) {
                $skey = "";
                for ($i = 0; $i < 8; $i++) {
                    $skey .= $strPol[rand(0, $max)];
                }
            }
            query("INSERT INTO user(uid,pass,name,zt,qq,class,date,apikey) VALUES (?, ?, ?, ?,?,?,?,?)", array($u, $p, $n, $zt, $q, $cl, date("Y-m-d H:i:s",time()), $skey));
            $_SESSION["alert"] = alert("用户添加成功！");
        } else {
            query("UPDATE user SET name = ?, qq = ?, money = ?, class=?, zt=? WHERE uid = ?", array($n, $q, $m, $cl, $zt, $yms[1]));
        }
        if (!empty($p)) {
            query("UPDATE user SET pass = ? WHERE uid = ?", array($p, $yms[1]));
        }
        $_SESSION["alert"] = alert("修改资料成功！");
        if (!empty($u)) {
            query("UPDATE user SET uid = ? WHERE uid = ?", array($u, $yms[1]));
            exit("<script>window.location.href='../admin-user_edit-{$u}';</script>");
        }
        exit("<script>history.go(-1);</script>");
        break;
    case "classupd":
        $u = trims($_POST['cid']);
        $n = trims($_POST['name']);
        $t = trims($_POST['text']);
        $z = trims($_POST['zt']);
        $iz = trims($_POST['iszk']);
        $p = trims($_POST['px']);
        $fu = $yms[1];
        $_SESSION["alert"] = alert("修改分类信息成功！");
        if ($yms[1] == "add") {
            $_SESSION["alert"] = alert("添加分类成功！");
            query("INSERT INTO class(cid,name,zt,iszk,px,text) VALUES (?,?,?,?,?,?)", array($u, $n, $z, $iz, $p, $t));
        } else {
            if (!empty($u)) {
                $fu = $u;
                query("UPDATE class SET cid = ? WHERE cid = ?", array($u, $yms[1]));
            }
            query("UPDATE class SET name=?,zt=?,px=?,text=?,iszk=? WHERE cid = ?", array($n, $z, $p, $t, $iz, $fu));
        }
        exit("<script>window.location.href='../admin-class_edit-{$fu}';</script>");
        break;
    case "user_classupd":
        $u = trims($_POST['vipid']);
        $n = trims($_POST['name']);
        $m = trims($_POST['money']);
        $z = trims($_POST['zk']);
        $p = trims($_POST['px']);
        $zt = $_POST['zt'];
        $fu = $yms[1];
        if (!preg_match ("/^[a-z]/", $u)&&$u!="") {
            $_SESSION["alert"] = alert("用户组ID必须为英文！",1);
            exit("<script>window.location.href='../admin-user_class_edit-{$fu}';</script>");
        }
        if ($yms[1] == "add") {
            if ($u == "main"||$fu=="main")
           exit("<script>alert('main为默认用户组id，不能添加和修改！'); history.go(-1);</script>");
            $_SESSION["alert"] = alert("添加用户分组成功！");
            query("INSERT INTO user_class(vipid,name,money,zk,px,issite) VALUES (?,?,?,?,?,'{$zt}')", array($u, $n, $m, $z, $p));
            $pdo->query("alter table tools_money add {$u} varchar(16) NOT NULL DEFAULT 'main';");
            //exit("<script>window.location.href='../view.php?admin&user_class_edit&{$u}';</script>");
        }else {
            $_SESSION["alert"] = alert("修改用户分组成功！");
            if (!empty($u)) {
                if ($u == "main"||$fu=="main")
                    exit("<script>alert('main为默认用户组id，不能添加和修改！'); history.go(-1);</script>");
                $fu = $u;
                query("UPDATE user_class SET vipid = ? WHERE vipid = ?", array($u, $yms[1]));
                query("UPDATE user SET class = ? WHERE class = ?", array($u, $yms[1]));
                $pdo->query("ALTER TABLE tools_money CHANGE {$yms[1]} {$u} varchar(16) NOT NULL DEFAULT 'main'");
            }
            query("UPDATE user_class SET name=?,money=?,zk=?,px=?,issite=? WHERE vipid = ?", array($n, $m, $z, $p, $zt, $fu));
        }
        exit("<script>window.location.href='../admin-user_class_edit-{$fu}';</script>");
        break;
    case "toolsupd":
        $u = $_POST['tid'];
        $num = $_POST['num'];
        $n = $_POST['name'];
        $m = $_POST['money'];
        $i = $_POST['inputs'];
        $c = $_POST['cid'];
        $cl = $_POST['clid'];
        $cv = $_POST['clval'];
        $cp = $_POST['clpost'];
        $co = $_POST['cookie'];
        $vals = $_POST['vals'];
        $t = $_POST['text'];
        $t = str_replace("\n", "", str_replace(PHP_EOL, '', $t)); //str_replace(PHP_EOL, '',$t);
        //str_replace("\n","\\n",trims($t));
        $p = trims($_POST['px']);
        $zt = "0";
        if (!empty($_POST['zt']))
            $zt = 1;
        $fu = $yms[1];
        if ($yms[1] == "add") {
            if (!isset($cv))
                $cv = "";
            if (!isset($cp))
                $cp = "";
            if (!isset($co))
                $co = "";
            if (!isset($vals))
                $vals = "";
            $_SESSION["alert"] = alert("商品添加成功！");
            query("INSERT INTO tools(tid,name,money,zt,px,text,class,clid,inputs,num,vals,clval,clpost,cookie) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($u, $n, $m, $zt, $p, $t, $c, $cl, $i, $num, $vals, $cv, $cp, $co));
            query("INSERT INTO tools_money(tid) VALUES (?)", array($u));
        }else {
            $_SESSION["alert"] = alert("商品修改成功！");
            if (isset($cv))
                query("UPDATE tools SET clval = ? WHERE tid = ?", array($cv, $fu));
            if (isset($cp))
                query("UPDATE tools SET clpost = ? WHERE tid = ?", array($cp, $fu));
            if (isset($co))
                query("UPDATE tools SET cookie = ? WHERE tid = ?", array($co, $fu));
            if (!empty($u)) {
                query("UPDATE tools SET tid = ? WHERE tid = ?", array($u, $fu));
                $fu = $u;
            }
            query("UPDATE tools SET name=?,money=?,zt=?,px=?,text=?,class=?,clid=?,inputs=?,num=?,vals=? WHERE tid = ?", array($n, $m, $zt, $p, $t, $c, $cl, $i, $num, $vals, $fu));
        }
        exit("<script>window.location.href='../admin-tools_edit-{$fu}';</script>");
        break;
    case "tmoneyupd":
        $a = trims($_POST['data']);
        $in = explode('|', $a);
        $t = trims($_POST['tid']);
        $l = count($in);
        for ($i = 0; $i < $l; $i++) {
            $a = trims($_POST[$in[$i]]);
            if($a=="")$a="main";
            query("UPDATE tools_money SET {$in[$i]} = ? WHERE tid = ?", array($a, $t));
            //$j=$j."/".$in[$i]."=".$a;
        }//exit($j.$t);
        $_SESSION["alert"] = alert("修改成功！");
        exit("ok");
        break;
        
    case "siteupd":
        $h = trims($_POST['host']);
        $uid=$yms[1];
        $hh = query("select host,uid from user where host=?", array($h))->fetch();
        if($hh)exit("<script>alert('该域名已被'{$hh['uid']}'使用'); history.go(-1);</script>");

        $a = trims($_POST['name']);
        $b = trims($_POST['title']);
        $g = trims($_POST['ggtext']);
        $str=implode("|.|",array($a,$b,$g));
        $_SESSION["alert"] = alert("站点修改成功");
        query("UPDATE user SET diyconf = ?,host=? WHERE uid = ?", array($str,$h, $uid));
        exit("<script>window.location.href='../admin-site_edit-{$uid}';</script>");
        break;
    case "setdd":
        $a=$yms[1];
        $b=$yms[2];
        $dd=query("SELECT zt,money,uid,name FROM orders where tradeno='{$b}'")->fetch();
        if(!isset($dd['zt'])) exit("失败：该订单不存在");
        if($dd['zt']==5) exit("失败：该订单已退款，不允许操作订单");
        if($a=="out"){
            query("
            UPDATE orders SET zt = ? WHERE tradeno = ?;
            UPDATE user SET money = money+{$dd['money']},xfmoney=xfmoney-{$dd['money']} WHERE uid = ?;
            INSERT user_log (uid,time,name,m,cid) VALUES ('{$dd['uid']}','{$time}','订单退款：{$dd['name']}','{$dd['money']}','4')
            ", array(5,$b,$dd['uid']));
            exit('退款成功');
        }else{
             if($a=="dcl") $zt=1;
             if($a=="ok") $zt=3;
             if($a=="err") $zt=4;
             query("UPDATE orders SET zt = {$zt} WHERE tradeno = ?",array($b));
             exit('修改成功');
        }
        break;
    default:
        exit("<script>alert('找不到该操作:{$yms[0]}'); history.go(-1);</script>");
}