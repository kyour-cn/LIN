<?php
$Date_1 = date("Y-m-d");
$Date_2 = "2018-4-20";
$d1 = strtotime($Date_1);
$d2 = strtotime($Date_2);
$Days = round(($d1 - $d2) / 3600 / 24);
$m = round($pdo->query("select sum(money) from orders where zt=3")->fetch()[0], 2);
$a = $pdo->query("SELECT count(Id) from user ")->fetch()[0];
$d = $pdo->query("SELECT count(Id) from orders where zt=3")->fetch()[0];

$sql="SELECT * FROM news where c1 = 'new' ORDER BY time desc limit 5";
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$rs = count($rows);

$sql="SELECT * FROM news where c1 = 'top' ORDER BY time desc limit 5";
$ttt=$pdo->query("SELECT * FROM news where nid='1'")->fetch();
$tt2= explode('|.|',$ttt['c2']);
$tt3= explode('|.|',$ttt['c3']);
$tt4= explode('|.|',$ttt['c4']);
$ttxt= explode('|.|',$ttt['text']);
?>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <a href="#">
            <div class="card red summary-inline">
                <div class="card-body">
                    <i class="icon fa fa-heartbeat fa-4x"></i>
                    <div class="content">
                        <div class="title"><?php echo $Days; ?></div>
                        <div class="sub-title">运行时间</div>
                    </div>
                    <div class="clear-both"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <a href="#">
            <div class="card yellow summary-inline">
                <div class="card-body">
                    <i class="icon fa fa-users fa-4x"></i>
                    <div class="content">
                        <div class="title"><?php echo $a; ?></div>
                        <div class="sub-title">用户数量</div>
                    </div>
                    <div class="clear-both"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <a href="#">
            <div class="card green summary-inline">
                <div class="card-body">
                    <i class="icon fa fa-bar-chart fa-4x"></i>
                    <div class="content">
                        <div class="title"><?php echo $d; ?></div>
                        <div class="sub-title">订单数量</div>
                    </div>
                    <div class="clear-both"></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <a href="#">
            <div class="card blue summary-inline">
                <div class="card-body">
                    <i class="icon fa fa-cny fa-4x"></i>
                    <div class="content">
                        <div class="title"><?php echo $m; ?></div>
                        <div class="sub-title">交易金额</div>
                    </div>
                    <div class="clear-both"></div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-sm-7 col-xs-12">

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">本站公告</div>
                </div>
            </div>
            <div class="card-body">
                        <?php echo $conf['gg']; ?>
            </div>
        </div><br>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">本站消息</div>
                </div>
            </div>
            <div class="card-body">
                
                <ul class="message-list">
                    
                    <?php
                    if ($rs < 1) {
                        echo "没有消息";
                    } else {

                        foreach ($rows as $r) {
                            ?>
                                        <a href="v-new-<?php echo $r['nid'];?>">
                                            <li>
                                                <img src="./assets/img/news.png" class="profile-img pull-left">
                                                <div class="message-block">
                                                    <div><span class="username"><?php echo $r['c2'];?></span> <span class="message-datetime"><?php echo $r['time'];?></span>
                                                    </div>
                                                    <div class="message"><?php echo  mb_substr(strip_tags($r['text']), 0, 120, 'utf-8');?></div>
                                                </div>
                                            </li>
                                        </a>
                            <?php
                        }
                    }
                    ?>
                    <a href="v-news" id="message-load-more">
                        <li class="text-center load-more">
                            <i class="fa fa-refresh"></i> 查看全部
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">感谢信</div>
                </div>
            </div>
            <div id="text" class="card-body">
                <h5>您好，我们尊敬的客户，给予了我们无比的气力，在您的大力关心与支持下，以及我们全体员工的勤奋努力下，我们凭借优质的服务，良好的信誉，取得了一个又一个的辉煌成绩。<br>&nbsp;&nbsp;&nbsp;&nbsp;饮水思源，我们深知，我们所取得的每一点进步和成功，都离不开您的关注、信任、支持和参与。您的理解和信任是我们进步的强大动力，您的关心和支持是我们成长的不竭源泉。您的每一次参与、每一个建议，都让我们激动不已，促使我们不断奋进。有了您，我们前进的征途才有源源不尽的信心和气力;有了您，我们的事业才能长盛不衰地兴旺和发展。<br>&nbsp;&nbsp;&nbsp;&nbsp;为报答多年来您对我们的支持、信任和帮助，借此岁末年初之际，我们将开展优质服务活动，用真情往返报您，届时您来办理业务，将会让您得到一份惊喜!<br>&nbsp;&nbsp;&nbsp;&nbsp;在今后的岁月里，希看能够继续得到您的关心和大力支持，我们将继续为您提供最真诚的服务。<br>&nbsp;&nbsp;&nbsp;&nbsp;再一次感谢您的帮助和支持，恭祝您身体健康!阖家幸福!事业兴旺!万事如意!
                </h5>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">热门推荐商品</div>
                </div>
            </div>
            <div id="text" class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row no-margin no-gap">
                            <div class="col-md-3 col-sm-6">
                                <div class="pricing-table dark-blue">
                                    <div class="pt-header">
                                        <div class="plan-pricing">
                                            <div class="pricing">￥<?php echo $tt3[0];?></div>
                                        </div>
                                    </div>
                                    <div class="pt-body">
                                        <h4><?php echo $tt2[0];?></h4>
                                        <ul class="plan-detail">
                                            <li><?php echo $ttxt[0];?></li>
                                        </ul>
                                    </div>
                                    <div class="pt-footer">
                                        <a href="./v-xd-<?php echo $tt4[0];?>" class="btn btn-success">立即购买</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="pricing-table green">
                                    <div class="pt-header">
                                        <div class="plan-pricing">
                                            <div class="pricing">￥<?php echo $tt3[1];?></div>
                                        </div>
                                    </div>
                                    <div class="pt-body">
                                        <h4><?php echo $tt2[1];?></h4>
                                        <ul class="plan-detail">
                                            <li><?php echo $ttxt[1];?></li>
                                        </ul>
                                    </div>
                                    <div class="pt-footer">
                                        <a href="./v-xd-<?php echo $tt4[1];?>" class="btn btn-success">立即购买</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="pricing-table  dark-blue">
                                    <div class="pt-header">
                                        <div class="plan-pricing">
                                            <div class="pricing">￥<?php echo $tt3[2];?></div>
                                        </div>
                                    </div>
                                    <div class="pt-body">
                                        <h4><?php echo $tt2[2];?></h4>
                                        <ul class="plan-detail">
                                            <li><?php echo $ttxt[2];?></li>
                                        </ul>
                                    </div>
                                    <div class="pt-footer">
                                        <a href="./v-xd-<?php echo $tt4[2];?>" class="btn btn-success">立即购买</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="pricing-table green">
                                    <div class="pt-header">
                                        <div class="plan-pricing">
                                            <div class="pricing">￥<?php echo $tt3[3];?></div>
                                        </div>
                                    </div>
                                    <div class="pt-body">
                                        <h4><?php echo $tt2[3];?></h4>
                                        <ul class="plan-detail">
                                            <li><?php echo $ttxt[3];?></li>
                                        </ul>
                                    </div>
                                    <div class="pt-footer">
                                        <a href="./v-xd-<?php echo $tt4[3];?>" class="btn btn-success">立即购买</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>