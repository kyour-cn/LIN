<?php
//if(is_file("./install.lock")){exit("系统已完成安装，请删除install/install.lock文件再试");}
error_reporting(0);
session_start();
$_SESSION['iskyses'] = 1;
@header('Content-Type: text/html; charset=UTF-8');
@$ym = $_SERVER["QUERY_STRING"];
$yms = explode("&", $ym);
$ym = $yms[0];
function checkfunc($f, $m = false) {
    if (function_exists($f)) {
        return '<font color="green">可用</font>';
    } else {
        if ($m == false) {
            return '<font color="black">不支持</font>';
        } else {
            return '<font color="red">不支持</font>';
        }
    }
}
?>


<html lang="zh-cn">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
        <title>安装-科佑儿下单系统</title>
        <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>

    </head>
    <body>
        <nav class="navbar navbar-fixed-top navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <span class="navbar-brand">安装向导</span>
                </div>
            </div>
        </nav>
        <div class="container" style="padding-top:60px;">
            <div class="col-xs-12 col-sm-8 col-lg-6 center-block" style="float: none;">

                <div class="panel panel-primary">
                    <div class="panel-heading" style="background: #587077;">
                        <h3 class="panel-title" align="center">科佑儿下单系统</h3>
                    </div>
                    <div class="panel-body">

                        <?php
                        if ($ym == "next1") {
                            ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:20%">函数检测</th>
                                        <th style="width:15%">需求</th>
                                        <th style="width:15%">当前</th>
                                        <th style="width:50%">用途</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>PHP 5.2+</td>
                                        <td>必须</td>
                                        <td><?php echo phpversion(); ?></td>
                                        <td>PHP版本支持</td>
                                    </tr>
                                    <tr>
                                        <td>curl_exec()</td>
                                        <td>必须</td>
                                        <td><?php echo checkfunc('curl_exec', true); ?></td>
                                        <td>抓取网页</td>
                                    </tr>
                                    <tr>
                                        <td>file_get_contents()</td>
                                        <td>必须</td>
                                        <td><?php echo checkfunc('file_get_contents', true); ?></td>
                                        <td>读取文件</td>
                                    </tr>
                                    <tr>
                                        <td>session</td>
                                        <td>必须</td>
                                        <td><?php echo $_SESSION['iskyses'] == 1 ? '<font color="green">可用</font>' : '<font color="red">不支持</font>'; ?></td>
                                        <td>PHP必备功能</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p><span><a class="btn btn-primary" href="./"><<上一步</a></span>
                                <span style="float:right"><a class="btn btn-primary" href="?next2" align="right">下一步>></a></span></p>

                            <?php
                        } else if ($ym == "next2") {
                            ?>

                            <div class="panel-body">
                                <form action="?do=3" class="form-sign" method="post">
                                    <label for="name">数据库地址:</label>
                                    <input class="form-control" name="db_host" value="localhost" type="text">
                                    <label for="name">数据库端口:</label>
                                    <input class="form-control" name="db_port" value="3306" type="text">
                                    <label for="name">数据库用户名:</label>
                                    <input class="form-control" name="db_user" type="text">
                                    <label for="name">数据库密码:</label>
                                    <input class="form-control" name="db_pwd" type="text">
                                    <label for="name">数据库名:</label>
                                    <input class="form-control" name="db_name" type="text">
                                    <!--label for="name">数据表前缀:</label>
                                    <input class="form-control" name="db_qz" value="shua" type="text"-->
                                    <br><input class="btn btn-primary btn-block" name="submit" value="保存配置" type="submit">
                                </form><br>
                                （如果已事先填写好config.php相关数据库配置，请 <a href="?do=3&amp;jump=1">点击此处</a> 跳过这一步！）
                            </div>

                            <?php
                        } else if ($ym == "next3") {
                            ?>

                        <?php } else { ?>

                            <p><iframe src="./readme.txt" style="width:100%;height:465px;"></iframe></p>
                            <?php if (is_file("./install.lock")) { ?>
                                <div class="alert alert-warning">
                                    您已经安装过，如需重新安装请删除<font color=red> install/install.lock </font>文件后再安装！
                                </div>
                            <?php } else { ?>
                                <p align="center"><a class="btn btn-primary" href="?next1">开始安装</a></p>
                                <?php
                            }
                        }
                        ?>




                    </div>

                </div>


            </div>
    </body>
</html>