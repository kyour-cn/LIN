<?php
@$ym = $_SERVER["QUERY_STRING"];
$yms = explode("&", $ym);
include './php/main.php';
if($conf['ccon']=='1')include './php/cc.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $conf['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/lib/css/select2.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdn;?>assets/css/themes/flat-blue.css">
</head>

<body class="flat-blue landing-page">
    <nav class="navbar navbar-inverse navbar-fixed-top  navbar-affix" role="navigation" data-spy="affix" data-offset-top="60">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <div class="icon fa fa-paper-plane"></div>
                    <div class="title"><?php echo $conf['name']; ?></div>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse " aria-expanded="true">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="ad.kyour.vip">主页</a></li>
                    <li><a href="#about">帮助</a></li>
                    <li><a href="#contact">联系我们</a></li>
                    <li><a href="admin.php">进入后台</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <div class="jumbotron app-header">
        <div class="container">
            <h2 class="text-center"><i class="app-logo fa fa-connectdevelop fa-5x color-white"></i><div class="color-white"><?php echo $conf['name']; ?></div></h2>
            <p class="text-center color-white app-description">KEY云端在线管理平台是科佑儿网络科技开发的在线云管理系统。集成多种在线开发管理功能。<br>帮助你团队的快速开发，方便管理！</p>
            <p class="text-center"><a class="btn btn-primary btn-lg app-btn" href="main" role="button">开始使用 »</a></p>
        </div>
    </div>
    <div class="container-fluid app-content-a">
        <div class="container">        <div class="row text-center">
            <div class="col-md-4 col-sm-6">
                <span class="fa-stack fa-lg fa-5x">
                  <i class="fa fa-circle-thin fa-stack-2x"></i>
                  <i class="fa fa-twitter fa-stack-1x"></i>
                </span>
                <h2>轻量运行</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-md-4 col-sm-6">
                <span class="fa-stack fa-lg fa-5x">
                  <i class="fa fa-circle-thin fa-stack-2x"></i>
                  <i class="fa fa-inbox fa-stack-1x"></i>
                </span>
                <h2>高速响应</h2>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-md-4 col-sm-6">
                <span class="fa-stack fa-lg fa-5x">
                  <i class="fa fa-circle-thin fa-stack-2x"></i>
                  <i class="fa fa-comments-o fa-stack-1x"></i>
                </span>
                <h2>可视管理</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        </div>
    </div>
    <div class="container-fluid app-content-b feature-1">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-6">
                </div>
                <div class="col-md-5 col-sm-6 text-right color-white">
                    <h2 class="featurette-heading">First featurette heading. It'll blow your mind.</h2>
                    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid app-content-a">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center app-content-header">Pricing</h2>
                    <p class="text-center app-content-description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row no-margin no-gap">
                        <div class="col-md-3 col-sm-6">
                            <div class="pricing-table dark-blue">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing">$10</div>
                                        <div class="pricing-type">per month</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>Basic Plan</h4>
                                    <ul class="plan-detail">
                                        <li>1 Website</li>
                                        <li>100 GB Storage</li>
                                        <li>Unlimited Bandwidth</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                    <button type="button" class="btn btn-primary">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="pricing-table green">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing">$25</div>
                                        <div class="pricing-type">per month</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>Standard Plan</h4>
                                    <ul class="plan-detail">
                                        <li>5 Website</li>
                                        <li>500 GB Storage</li>
                                        <li>Unlimited Bandwidth</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                    <button type="button" class="btn btn-success">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="pricing-table  dark-blue">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing">$50</div>
                                        <div class="pricing-type">per month</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>Advanced Plan</h4>
                                    <ul class="plan-detail">
                                        <li>10 Website</li>
                                        <li>1 TB Storage</li>
                                        <li>Unlimited Bandwidth</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                    <button type="button" class="btn btn-primary">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="pricing-table dark-blue">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing">$100</div>
                                        <div class="pricing-type">per month</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>Unlimited Plan</h4>
                                    <ul class="plan-detail">
                                        <li>Unlimited Website</li>
                                        <li>Unlimited Storage</li>
                                        <li>Unlimited Bandwidth</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                    <button type="button" class="btn btn-primary">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid app-content-b contact-us">
        <div class="container">
            <div class="row featurette">
                <div class="col-md-6"><h2 class="color-white contact-us-header">Contact Us</h2>
                <p class="color-white contact-us-description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut </p></div>
                <div class="col-md-6">
                    <form>

                        <div class="row">
                            <div class="col-sm-6"><input id="name" name="name" type="text" class="form-control" placeholder="Full Name"> </div>
                            <div class="col-sm-6"><input id="email" name="email" type="email" class="form-control" placeholder="Email address"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><textarea id="message" name="message" class="form-control" placeholder="Your Message" rows="5"></textarea></div>
                        </div>
                        <div>
                            <button id="contact-submit" type="submit" class="btn btn-success pull-right">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /END THE FEATURETTES -->
    <!-- FOOTER -->
    <footer class="app-footer">
      <div class="container">
        <p class="text-muted">&copy; 2015, Tui2Tone Templates Studio.</p>
      </div>
    </footer>
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/jquery.min.js"></script>
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/bootstrap.min.js"></script>
            <!--script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/Chart.min.js"></script-->
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/bootstrap-switch.min.js"></script>
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/jquery.dataTables.min.js"></script>
            <!--script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/dataTables.bootstrap.min.js"></script-->
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/select2.full.min.js"></script>

    <!-- /.container -->
</body>
</html>