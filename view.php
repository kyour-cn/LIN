<?php
$isl = true;
@$ym = $_SERVER["QUERY_STRING"];
$yms = explode("&", $ym);
ob_start();
$ym = $yms[0];
$path = "";
$boms = "";
if (!empty($ym)) {
    $path = "./html/view/" . $ym . ".php";
    if (!is_file($path)) {
        header("Location:404.html");
    }
}
$btitle = "平台首页";
include './php/main.php';
if ($conf['ccon'] == '1')
    include './php/cc.php';
include './html/inc/head.php';
include './html/inc/top.php';
include './html/inc/sidebar.php';
?>
<!-- <div class="container-fluid"> -->
<div class="side-body padding-top">
    <?php
    if (isset($_SESSION["alert"])) {
        echo $_SESSION["alert"];
        unset($_SESSION["alert"]);
    }
    include $path;
    ?>
</div>
<?php
include './html/inc/footer.php';
$etime = microtime(true); //获取程序执行结束的时间
$total = $etime - $stime;  //计算差值
echo $boms;
?>

<script>
    $("#title").html("<?php echo $btitle; ?>");
    $("#<?php echo $ym; ?>").addClass("active");
<?php echo $botjs;?>

</script>