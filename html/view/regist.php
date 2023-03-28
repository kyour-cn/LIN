<?php
if($_SESSION["islogin"]=="1"){
    exit('<script>alert("已登录账号！");window.location.href="./"</script>');
}
?>
<div class="row">
    <div class="col-sm-3 col-xs-0"></div>
    <div class="col-sm-6 col-xs-12">
        <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">用户注册</div>
                                    </div>
                                </div>
                                <div class="card-body">
        <form action="/php/users.php?regist" method="post">

            <div class="form-group has-feedback">
                <label for="username">用户账号</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input id="username" name="uid" class="form-control" placeholder="请输入登录用户名" maxlength="20" type="text">
                </div>
                <span style="color:red;display: none;" class="tips"></span>
                <span style="display: none;" class=" glyphicon glyphicon-remove form-control-feedback"></span>
                <span style="display: none;" class="glyphicon glyphicon-ok form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="username">昵称</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input id="username" name="name" class="form-control" placeholder="请输入用户昵称" maxlength="20" type="text">
                </div>
                <span style="color:red;display: none;" class="tips"></span>
                <span style="display: none;" class=" glyphicon glyphicon-remove form-control-feedback"></span>
                <span style="display: none;" class="glyphicon glyphicon-ok form-control-feedback"></span>
            </div>
            
            <div class="form-group has-feedback">
                <label for="password">密码</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input id="password" name="password" class="form-control" placeholder="请输入密码" maxlength="20" type="password">
                </div>

                <span style="color:red;display: none;" class="tips"></span>
                <span style="display: none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span style="display: none;" class="glyphicon glyphicon-ok form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="passwordConfirm">确认密码</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input name="pass2" id="passwordConfirm" class="form-control" placeholder="请再次输入密码" maxlength="20" type="password">
                </div>
                <span style="color:red;display: none;" class="tips"></span>
                <span style="display: none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span style="display: none;" class="glyphicon glyphicon-ok form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="phoneNum">QQ号码</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                    <input id="phoneNum" name="qq" class="form-control" placeholder="请输入QQ号码" maxlength="10" type="text">
                </div>
                <span style="color:red;display: none;" class="tips"></span>
                <span style="display: none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span style="display: none;" class="glyphicon glyphicon-ok form-control-feedback"></span>
            </div>
            
            
            <div class="input-group">
      <span class="input-group-addon">验证码</span>
      <input name="code" style="height:40px" class="form-control" aria-label="Amount (to the nearest dollar)" type="text">
      <span class="input-group-addon"><img onClick="location.reload();" src="./php/code.php" height="25"></span>
    </div><br>
    

            <div class="form-group">
                <input class="form-control btn btn-primary" id="submit" value="立&nbsp;&nbsp;即&nbsp;&nbsp;注&nbsp;&nbsp;册" type="submit">
            </div>
            <div class="form-group">
                <a  href="./v.php?login" class="form-control btn btn-danger" >登&nbsp;&nbsp;录</a>
            </div>
            <!--div class="form-group">
                <input value="重&nbsp;&nbsp;置" id="reset" class="form-control btn btn-danger" type="reset">
            </div-->
            <div class="form-group">
                <a  href="./" class="form-control btn btn-danger" >返&nbsp;&nbsp;回</a>
            </div>
        </form>
    </div>
</div>
    </div>
</div>