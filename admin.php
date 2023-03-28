<?php
$isl = true;
$btitle = "平台首页";
include './php/main.php';
if($conf['ccon']=='1')include './php/cc.php';
include './html/inc/head.php';
include './html/inc/top.php';
include_once './html/inc/sidebar.php';
?>
<!-- <div class="container-fluid"> -->

<div class="side-body padding-top">
    <?php
    if (isset($_SESSION["alert"])) {
        echo $_SESSION["alert"];
        unset($_SESSION["alert"]);
    }
    include './html/inc/h-v1.php';
    ?>
</div>
<?php
include './html/inc/footer.php';
$etime = microtime(true); //获取程序执行结束的时间
$total = $etime - $stime;  //计算差值
?>
<script>
    $("#index").addClass("active");
</script>