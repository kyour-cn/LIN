<?php
//登录页面
$_SESSION["dlqym"] = $_SERVER["HTTP_REFERER"];
if($_SESSION["islogin"]=="1"){
    exit('<script>alert("已登录账号！");window.location.href="./"</script>');
}

function isMobile(){ 
  $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''; 
  $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';    
  function CheckSubstrs($substrs,$text){ 
    foreach($substrs as $substr) 
      if(false!==strpos($text,$substr)){ 
        return true; 
      } 
      return false; 
  }
  $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
  $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod'); 
      
  $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) || 
       CheckSubstrs($mobile_token_list,$useragent); 
      
  if ($found_mobile){ 
    return true; 
  }else{ 
    return false; 
  } 
}
if (isMobile()){
  header('location: ./m.php?mlogin');//如果为手机端，执行跳转
}




?>
<link href="./assets/css/login.css" rel="stylesheet">
<style>
    body{background-image: url('./assets/img/bgm3.jpg');background-size:cover;}
    .loginbox{background-image: url('./assets/img/ysj.jpg');background-size:cover;}
</style>
<div class="loginbox animated-500 fadeInDown aero" >
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