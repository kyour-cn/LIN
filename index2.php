<?php
@$ym = $_SERVER["QUERY_STRING"];
$yms = explode("&", $ym);
include './php/main.php';
if($conf['ccon']=='1')include './php/cc.php';

?><html class="" lang="zh" data-attr-t="" lang-t="lang"><head>
<meta charset="utf-8">
<meta name="Author" content="Ping++">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?php echo $conf['title']; ?></title>
<link rel="stylesheet" href="//www.wmsg.cc/css/app-821eedfc46.css">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=11.0, " id="mixia_vpid">

<meta class="foundation-mq"></head>
<body>
<div class="top-bar-wrapper">
<div class="row column">
<div class="title-bar show-for-small-only">
<button id="hamburger" class="menu-icon" type="button" data-toggle=""></button>
</div>
<div class="top-bar hide-for-small-only">
<div class="top-bar-title">
</div>
<div class="top-bar-left">
</div>
<div class="top-bar hide-for-small-only">
<div class="top-bar-right">
<ul class="menu">
<li><a href="main" data-t="top-nav.login">登录</a></li>
<li><a href="v.php?regist" class="button cta hollow small" data-t="top-nav.signup">注册</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="mobile-nav show-for-small-only" id="sidebar-menu">
<ul>
<li><a href="../user" data-t="top-nav.login">商户登录</a></li>
<li class="divider"><a href="../user/reg.php?my=add" data-t="top-nav.signup">密钥注册</a></li>
<li><a href="/SDK" data-t="top-nav.login">支付测试</a></li>
<li><a href="./update.php" onclick="alert('暂未开放');return false;">开发文档</a><li>
<li><a href="http://wpa.qq.com/msgrd?v=3&uin=1532332928&site=qq&menu=yes" data-t="top-nav.login">联系客服</a></li>
</ul>
</div>
<div class="ui-mask"></div>
<section class="hero hero--clip" id="hero" style='background:#eff;'>
<div class="row">
<div class="small-12 columns">
<div class="hero-copy is-animated">
<h2 data-t="dashboard.hero.heading"><?php echo $conf['name']; ?></h2>
<center><h5 data-t="dashboard.hero.subheading">手机电脑平板一站通用，<br>轻松开启又快又稳定的易支付平台。</h5></center>
<p>
<a class="button cta" href="v.php?regist" >立即注册</a>
<a class="button cta" href="main">立即登录</a>
</p>
</div>
</div>
</div>
</section>
<section class="news ld-content" id="financing">
<div class="row align-center align-middle">
<div class="column shrink">
<h5 data-t="index.news.fq.title">
<form action="ulist.php" method="GET" class="form-inline"><input type="hidden" name="my" value="search">
</form>目前已有<strong style="color:red;"> <b><?php echo $pdo->query("SELECT count(Id) from user ")->fetch()[0]; ?></b></strong> 个商户在使用此平台</h5>
</div>
</div>
</section>
<section class="ld-feature-grid ld-content ld-content--center" id="overview">
<div class="row align-center">
<div class="small-11 medium-10 large-9 column">
<div class="row small-up-1 medium-up-3 align-top">
<div class="ld-feature-grid__column column">
<div class="ld-feature-grid__icon"><img src="//www.wmsg.cc/css/img/ds-shopping-chart.svg"></div>
<h5 data-t="dashboard.features.data.title">分布执行</h5>
<p class="small" data-t="dashboard.features.data.description">我们己对程序进行了多次优化，有效的解决了服务器执行任务延迟的问题。</p>
</div>
<div class="ld-feature-grid__column column">
<div class="ld-feature-grid__icon"><img src="//www.wmsg.cc/css/img/ds-emoticons-wink.svg"></div>
<h5 data-t="dashboard.features.account.title">我们优势</h5>
<p class="small" data-t="dashboard.features.account.description">支持一个账号管理多个QQ，免去频繁登录多个账号的烦恼。</p>
</div>
<div class="ld-feature-grid__column column">
<div class="ld-feature-grid__icon"><img src="//www.wmsg.cc/css/img/ds-media-sound-wave.svg"></div>
<h5 data-t="dashboard.features.monitoring.title">实时监控</h5>
<p class="small" data-t="dashboard.features.monitoring.description">实时监控服务器负荷，为易支付稳定做出保障。</p>
</div>
</div>
<div class="row small-up-1 medium-up-3 align-top">
<div class="ld-feature-grid__column column">
<div class="ld-feature-grid__icon"><img src="//www.wmsg.cc/css/img/ds-ui-grid.svg"></div>
<h5 data-t="dashboard.features.apps.title">安全保证</h5>
<p class="small" data-t="dashboard.features.apps.description">实时查询，安全可靠，账号保护措施安全可靠； 业内费率比率高，维护商户利益，7*24小时全天候服务！</p>
</div>
<div class="ld-feature-grid__column column">
<div class="ld-feature-grid__icon"><img src="//www.wmsg.cc/css/img/ds-tech-mobile-recharger.svg"></div>
<h5 data-t="dashboard.features.dev.title">账号管理</h5>
<p class="small" data-t="dashboard.features.dev.description">平台适合自己设置密钥，让你不再为密钥忘了而烦恼！</p>
</div>
<div class="ld-feature-grid__column column">
<div class="ld-feature-grid__icon"><img src="//www.wmsg.cc/css/img/ds-headphones-mic.svg"></div>
<h5 data-t="dashboard.features.tickets.title">高效服务</h5>
<p class="small" data-t="dashboard.features.tickets.description">我们提供7X24小时在线服务，对日交易高额用户可提供一对一服务！</p>
</div>
</div>
</div>
</div>
</section>
<section class="bottom-cta bottom-cta--gray">
<div class="row align-center">
<div class="small-12 medium-8 large-7 columns">
<h3 data-t="bottom-cta.default.title">一分钟开启你的商业</h3>
<p><a href="main" class="button cta" data-t="bottom-cta.default.cta">免费注册账号</a></p>
</div>
</div>
</section>
<footer>
<div class="row">
<div class="small-12 medium-expand columns">
<center><p class="xsmall">Copyright © 2018 <a target="_blank" href="/"><?php echo $conf['name']; ?></a> <a target="_blank" href="http://www.kyour.vip">保留所有权利</a></p></center>
</div>
</div>
</footer>

<script src="http://www.wmsg.cc/css/app-f8b80f22b3.js"></script>
<script type="text/javascript" async="" src="//idm-su.baidu.com/su.js"></script>
</body></html>