<?php
/* * 
 * 功能：支付结果处理页面
 */
require_once("../php/main.php");
require_once("../php/ddcl.php");
require_once("epay.config.php");
require_once("lib/epay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if ($verify_result) {//验证成功
    //商户订单号
    $out_trade_no = trims($_GET['out_trade_no']);

    //支付宝交易号
    $trade_no = trims($_GET['trade_no']);

    //交易状态
    $trade_status = trims($_GET['trade_status']);

    //支付方式
    $type = trims($_GET['type']);
    $r = null;
    if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
        $a = query("SELECT * FROM orders where tradeno =?",array($out_trade_no));
        $rows = $a->fetchAll(PDO::FETCH_ASSOC);
        $rs = count($rows);
        if ($rs < 1) {
           exit("系统不存在此订单！");
        } else {
            $r = $rows[0];
            $user = $pdo->query("SELECT * FROM user where uid='{$r["uid"]}'")->fetch();
            if ($r['zt'] == '0') {//未支付
                query("update orders set zt='1' where tradeno =?",array($out_trade_no));
                $r['zt'] = '1';
            }
            if ($r['zt'] == '1') {//未处理
                if (ddcl($r, $user) == "ok") {
                    $r['zt'] = '3';
                } else {
                    $_SESSION["alert"] = alert('已支付成功但是订单处理失败，请联系管理员解决！',1);
                    header("Location:" . $_SESSION["payqurl"]);
                }
            }
            if ($r['zt'] == '3') {
                $_SESSION["alert"] = alert('付款已成功，请检查是否到账');
                header("Location:" . $_SESSION["payqurl"]);
            }
        }
    } else {
        $_SESSION["alert"] = "支付状态未知：trade_status=" . $_GET['trade_status'];
        header("Location:'./'");
    }

    echo "验证成功<br />";
} else {
    echo "验证失败，非法请求";
}
/*

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>支付结果</title>
    </head>
    <body>
    </body>
</html>

*/