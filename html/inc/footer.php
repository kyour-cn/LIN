        </div>
        <footer class="app-footer">
            <div class="wrapper">
                <span class="pull-right"><?php echo $conf['ver']; ?> <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © 2018 Copyright. KEY &nbsp;&nbsp;by&nbsp;&nbsp; <a href="http://www.kyour.vip/" target="_blank" ><?php echo $conf['name'];?></a>
            </div>
        </footer>
        </div>
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/jquery.min.js"></script>
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/bootstrap.min.js"></script>
            <!--script type="text/javascript" src="./assets/lib/js/Chart.min.js"></script-->
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/bootstrap-switch.min.js"></script>
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/jquery.dataTables.min.js"></script>
            <!--script type="text/javascript" src="./assets/lib/js/dataTables.bootstrap.min.js"></script-->
            <script type="text/javascript" src="<?php echo $cdn;?>assets/lib/js/select2.full.min.js"></script>
            <!--script type="text/javascript" src="./assets/lib/js/ace/ace.js"></script>
            <script type="text/javascript" src="./assets/lib/js/ace/mode-html.js"></script>
            <script type="text/javascript" src="./assets/lib/js/ace/theme-github.js"></script-->
            <?php if(isset($ac))@include $ac;unset($ac);?>
            <script type="text/javascript" src="<?php echo $cdn;?>assets/js/app.js"></script>
            <!--script type="text/javascript" src="./assets/js/index.js"></script-->
</body>

</html>
