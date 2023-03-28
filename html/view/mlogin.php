<?php
//登录页面
$_SESSION["dlqym"] = $_SERVER["HTTP_REFERER"];
if($_SESSION["islogin"]=="1"){
    exit('<script>alert("已登录账号！");window.location.href="./"</script>');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="Content-Script-Type" content="text/javascript">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="renderer" content="webkit">
	<meta itemprop="image" content="./static/images/common/ico.png?ver=4.25" />
<link href="./assets/css/login.wap.css" rel="stylesheet">
<link href="./assets/css/common.css" rel="stylesheet">
	<link href="./static/style/font-awesome/css/font-awesome.css?ver=4.25" rel="stylesheet">
	<!--[if IE 7]>
	<link rel="stylesheet" href="./static/style/font-awesome/css/font-awesome-ie7.css">
	<![endif]--> 
<style>
    body{background-image: url('./assets/img/m1.jpg');background-size:cover;}
    /*.loginbox{background-image: url('./assets/img/ysj.jpg');background-size:cover;}*/
</style>
	<title>KEY云</title>
</head>

<body>
	<style type="text/css">.aero:before,.aero:after,.background{background-image:url(./static/images/wall_page/2.jpg)}</style>	<div class="background"></div>
	<div class="loginbox login-wap aero" >
    <div class="title">
        <div class="logo"><i class="icon-cloud"></i><b>登录</b></div>
        <div class="info">————登录后台</div>

    </div>
		<div class="form">
        <form action="./php/users.php?login" method="post">
            <div class="inputs">
                <div>
                    <i class="font-icon fa fa-user" ></i>
                    <input id="uid" name="uid" placeholder="登陆账号" required="" autocomplete="on" type="text">
                </div>
                <div>
                    <i class="font-icon  fa fa-key"></i>
                    <input id="password" name="password" placeholder="密码" required="" autocomplete="on" type="password">
                </div>
            </div>
            <div class="actions">
                <label for="rm">
                    <a href="v.php?regist" class="forget-password" draggable="false">注册用户</a>					</label>
                <a href="./" class="forget-password" draggable="false">回到主页</a>
                <!--a href="javascript:void(0);" class="forget-password" draggable="false">忘记密码</a-->
                <br>
                <input id="submit" value="登录" type="submit">
            </div>

            <div class="msg"></div>

        </form>
		</div>
	</div>

</body>
</html>
