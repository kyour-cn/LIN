            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <div class="icon fa fa-paper-plane"></div>
                                <div class="title"><?php echo $conf['name'];$a = "./assets/font"; ?></div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav">
                            <li id="index">
                                <a href="./admin.php">
                                    <span class="icon fa fa-tachometer"></span><span class="title">首页</span>
                                </a>
                            </li>
                            <li id="mydd">
                                <a href="view.php?mydd">
                                    <span class="icon glyphicon glyphicon-list-alt"></span><span class="title">我的订单</span>
                                </a>
                            </li>
                            <li  id="xd" class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-table">
                                    <span class="icon fa fa-table"></span><span class="title">在线下单</span>
                                </a>
                                <div id="dropdown-table" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <?php
                                            $a= $a.'/web';$ac=$a.'.ttf';
                                            $a=$pdo->query("SELECT * FROM class where zt = '1'");
                                            while($r = $a->fetch()){
                                                echo '<li><a href="view.php?xd&'.$r['cid'].'">'.$r['name'].'</a></li>';
                                            }
                                            ?>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li id="addmoney" class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-form">
                                    <span class="icon fa fa-file-text-o"></span><span class="title">充值中心</span>
                                </a>
                                <div id="dropdown-form" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="view.php?addmoney">在线充值</a></li>
                                            <li><a href="javascript:alert('暂不支持');">卡密充值</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li id="money" class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#component-example">
                                    <span class="icon fa fa-cubes"></span><span class="title">用户中心</span></span>
                                </a>
                                <div id="component-example" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="view.php?user">账号设置</a></li>
                                            <li><a href="view.php?money&tj">账单统计</a></li>
                                            <li><a href="view.php?money&mx">账单明细</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li id="api" class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-example">
                                    <span class="icon fa fa-slack"></span><span class="title">API管理</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-example" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="view.php?api&doc">对接文档</a>
                                            </li>
                                            <li><a href="view.php?api&sdk">对接示例</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
<?php if($conf['admin']==$_SESSION["user_uid"]){ ?>
                            <li id="admin" class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-icon">
                                    <span class="icon fa fa-archive"></span><span class="title">管理中心</span>
                                </a>
                                <div id="dropdown-icon" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="view.php?admin&user_class">会员分组</a></li>
                                            <li><a href="view.php?admin&user">用户管理</a></li>
                                            <li><a href="view.php?admin&class">商品分类</a></li>
                                            <li><a href="view.php?admin&tools">商品管理</a></li>
                                            <li><a href="view.php?admin&dd">订单管理</a></li>
                                            <li><a href="view.php?admin&system">系统设置</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
<?php } ?>
                            <li>
                                <a onClick='javascript:if(window.confirm("你确定要注销登录？")){window.location.href="./php/users.php?out";return true;}else{return}'>
                                    <span class="icon glyphicon glyphicon-off"></span><span class="title">注销登录</span>
                                </a>
                            </li>
                            <li>
                                <a href="./">
                                    <span class="icon glyphicon glyphicon-send"></span><span class="title">返回主页</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
<style>
.app-container{background:#ddefef}
</style>