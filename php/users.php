<?php
include './main.php';
//注册用户
@$nn = $_SERVER["QUERY_STRING"];
$yms = explode("&", $nn);
$nn = $yms[0];
@$uid = trims($_POST['uid']);
@$name = trims($_POST['name']);
@$pass = trims($_POST['password']);
@$qq = trims($_POST['qq']);
@$code = strtolower(trims($_POST['code']));

if ($nn == "regist") {
    if ($_SESSION['authcode'] != $code)
        exit("<script>alert('请正确填写验证码'); history.go(-1);</script>");
    if ($pass != trims($_POST['pass2']))
        exit("<script>alert('两次输入的密码不相同'); history.go(-1);</script>");
    //表单验证
    if (strlen($uid) < 4 or strlen($name) < 2 or strlen($pass) < 6 or strlen($qq) < 4) {
        exit("<script>alert('请确保每一项不能为空，账号用户名>3，密码>5'); history.go(-1);</script>");
    }
    $num = query("select uid from user where uid=?", array($uid))->fetch();
    if ($num) {
        exit("<script>alert('用户名已存在'); history.go(-1);</script>");
    }
    
    $skey = "";
	$strPol = "123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKMLNOPQRSTUVWXYZ.%*";
	$max = strlen($strPol)-1;
        for($i=0;$i<32;$i++){
                $skey.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        //判断key是否存在
        while(($pdo->query("SELECT count(Id) from user where apikey='{$skey}'")->fetch()[0]!=0)){
        $skey = "";
        for($i=0;$i<32;$i++){
                $skey.=$strPol[rand(0,$max)];
        }
        }
        
    try {
        $time=date("Y-m-d H:i:s",time());
        query("insert into user(uid,pass,name,qq,date,zt,apikey,upsite) values (?,?,?,?,'{$time}','1',?,?)",array($uid,$pass,$name,$qq,$skey,$issite?$conf['siteuid']:"NONE"));
    } catch (PDOException $e) {
        die('数据添加失败: ' . $e . "<br>" . $sqll);
    }
    echo '<script>alert("注册成功！请重新登录。");window.location.href="../";</script>';
} else if ($nn == 'out') {//退出登陆
    unset($_SESSION['user_name']);
    unset($_SESSION['user_txurl']);
    unset($_SESSION['islogin']);
    unset($_SESSION['user_uid']);
    unset($_SESSION['user_name']);
    echo"<script>alert('注销登录成功！');window.location.href='../';</script>";
} else if ($nn == "login") {
    $num2 = query("select uid from user where uid=?",array($uid))->fetch();

    if ($num2) {       //存在该用户
        //$pdo->query("update user set dlsj='".date("Y.m.d")."' where uid ='".$uid."'");//更新登录时间
        //$sql = "select * from user where uid =:uid and pass =:pass";
        $pdo_stmt = query("select * from user where uid =? and pass =?",array($uid,$pass));//$pdo->prepare($sql);
        //$pdo_stmt->bindParam(':uid', $uid);
        //$pdo_stmt->bindParam(':pass', $pass);
        //$pdo_stmt->execute();
        $num = $pdo_stmt->fetch();
        if ($num) {//密码正确
            if ($num['zt'] ) {
                $_SESSION["user_name"] = $num["name"];
                $_SESSION["islogin"] = "1";
                $_SESSION["user_uid"] = $uid;
                @$url = $_SESSION["dlqym"];
                if ($url != null) {//登陆前跳转
                    //header("Location:".$_SESSION["dlqym"]);
                    echo '<script>alert("登录成功！");window.location.href="' . $url . '";</script>';
                } else {
                    //header("Location:'../'");
                    echo '<script>alert("登录成功！即将返回首页。");window.location.href="../main";</script>';
                }
            } else {
                echo "<script>alert('该账号未启用，请联系管理员！');history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('密码不正确，请核对后再试！');history.go(-1);</script>";
        }
    } else {
        echo "<script>alert('这个账号并没有注册！" . $uid . "');history.go(-1);</script>";
    }
}