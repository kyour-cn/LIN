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
        
    try {
        $pdo_stmt=query("insert into user(uid,pass,name,qq,date,zt,apikey) values (?,?,?,?,'" . date("Y-m-d H:i:s") . "','1',?)",array($uid,$pass,$name,$qq,$skey));
        /*
        $sqll = "insert into user(uid,pass,name,qq,date,zt) values (:uid,:pass,:name,:qq,'" . date("Y-m-d H:i:s") . "','1')";
        //防sql注入，注册账号
        $pdo_stmt = $pdo->prepare($sqll);
        $pdo_stmt->bindParam(':uid', $uid);
        $pdo_stmt->bindParam(':pass', $pass);
        $pdo_stmt->bindParam(':name', $name);
        $pdo_stmt->bindParam(':qq', $qq);
        $pdo_stmt->execute();
        */
        $reslut = $pdo_stmt->fetch();
    } catch (PDOException $e) {
        die('数据添加失败: ' . $e . "<br>" . $sqll); //如果sql执行失败输出错误
    }
    echo '<script>alert("注册成功！即将返回登录。");window.location.href="../";</script>';
} else if ($nn == 'out') {//退出登陆
    unset($_SESSION['user_name']);
    unset($_SESSION['user_txurl']);
    unset($_SESSION['islogin']);
    unset($_SESSION['user_uid']);
    unset($_SESSION['user_name']);
    echo"<script>alert('注销登录成功！');window.location.href='../';</script>";
} else if ($nn == "login") {
    $sql = "select uid from user where uid=:uid";
    $pdo_stmt = $pdo->prepare($sql);
    $pdo_stmt->bindParam(':uid', $uid);
    $pdo_stmt->execute();
    $num2 = $pdo_stmt->fetch();

    if ($num2) {       //存在该用户
        //$pdo->query("update user set dlsj='".date("Y.m.d")."' where uid ='".$uid."'");//更新登录时间
        $sql = "select * from user where uid =:uid and pass =:pass";
        $pdo_stmt = $pdo->prepare($sql);
        $pdo_stmt->bindParam(':uid', $uid);
        $pdo_stmt->bindParam(':pass', $pass);
        $pdo_stmt->execute();
        $num = $pdo_stmt->fetch();
        if ($num) {//密码正确
            if ($num['zt'] > 0) {
                $_SESSION["user_name"] = $num["name"];
                /*
                  if($num["txurl"]=="NULL"){
                  $_SESSION["user_txurl"]="http://".$this_host."/images/icon/icon.png";
                  }else{
                  $_SESSION["user_txurl"]= $num["txurl"];
                  }
                 */
                $_SESSION["islogin"] = "1";
                $_SESSION["user_uid"] = $uid;
                @$url = $_SESSION["dlqym"];
                if ($url != null) {//登陆前跳转
                    //header("Location:".$_SESSION["dlqym"]);
                    echo '<script>alert("登录成功！即将返回登录。");window.location.href="' . $url . '";</script>';
                } else {
                    //header("Location:'../'");
                    echo '<script>alert("登录成功！即将返回首页。");window.location.href="../";</script>';
                }
            } else {
                echo "<script>alert('请到注册邮箱完成验证，验证邮箱后即可登录！');history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('密码不正确！');history.go(-1);</script>";
        }
    } else {
        echo "<script>alert('这个账号并没有注册！" . $uid . "');history.go(-1);</script>";
    }
}