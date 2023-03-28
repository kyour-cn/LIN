            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <ol class="breadcrumb navbar-breadcrumb">
                            <li class="active" id="title"><?php echo $btitle; ?></li>
                            <?php if(isset($ac))@include $ac;unset($ac);?>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
<?php
$ss="gd";
if($conf['admin']==$_SESSION["user_uid"]){
$ss="admin&gd";
$s = $pdo->query("SELECT count(Id) from gd where cid=0 and uc=0")->fetch()[0];
}else
$s = $pdo->query("SELECT count(Id) from gd where cid=0 and uc=0 and uid='{$user['uid']}'")->fetch()[0];
?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">消息 <?php echo $s;?> <i class="fa fa-comments-o"></i> </a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="title">
                                    我的工单 <span class="badge pull-right"><?php echo $s;?></span>
                                </li>
                                <li class="message">
                                    <a href="view.php?<?php echo $ss;?>">点击查看</a>
                                </li>
                            </ul>
                        </li>
                        <!--li class="dropdown danger">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i> 0</a>
                            <ul class="dropdown-menu danger  animated fadeInDown">
                                <li class="title">
                                    与我相关 <span class="badge pull-right">4</span>
                                </li>
                                <li>
                                    <ul class="list-group notifications">
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> 新的提示
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge success">1</span> <i class="fa fa-check icon"></i>任务完成
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> 新回复
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item message">
                                                显示全部
                                            </li>
                                        </a>
                                    </ul>
                                </li>
                            </ul>
                        </li-->
                    </ul>
                </div>
            </nav>