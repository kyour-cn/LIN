<?php
@$ym = $_SERVER["QUERY_STRING"];
$yms = explode("&", $ym);
$ym = $yms[0];
$path = "";
if (!empty($ym)) {
    $path = "./html/view/" . $ym . ".php";
    if (!is_file($path)) {
        //echo $path;
        header("Location:404.html");
    }
}

$btitle = "平台首页";
include './php/main.php';
?>
        <?php
        include $path;
        /*
          @$f = $_GET["n"];
          @$e = $_GET["e"];
          if(isset($f)) {
          $path="/php/view/".$f.".php";
          // echo $path;
          if(is_file($path)){
          $path="/php/view/404.php";
          }
          include ".".$path; //require_once
          }else if(isset($e)){
          //include './php/temp/test.php';
          echo $_SESSION["test_echo"];
          }
         */
        ?>
