<?php
/* *
 * 功能：彩虹易支付异步通知页面


 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 */
$nohr = true;
require_once("../php/main.php");
require_once("../php/ddcl.php");
require_once("epay.config.php");
require_once("lib/epay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if ($verify_result) {//验证成功
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //请在这里加上商户的业务逻辑程序代
    //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
    //商户订单号
    $out_trade_no = trims($_GET['out_trade_no']);

    //彩虹易支付交易号
    $trade_no = trims($_GET['trade_no']);

    //交易状态
    $trade_status = trims($_GET['trade_status']);

    //支付方式
    $type = trims($_GET['type']);


    if ($_GET['trade_status'] == 'TRADE_SUCCESS') {

        $a = query("SELECT * FROM orders where tradeno =?",array($out_trade_no));
        $rows = $a->fetchAll(PDO::FETCH_ASSOC);
        $rs = count($rows);
        if ($rs < 1) {
//没有这个订单
        } else {
            $r = $rows[0];
            $user = $pdo->query("SELECT * FROM user where uid='{$r["uid"]}'")->fetch();
            if ($r['zt'] == '0') {//未支付
                $pdo->query("update orders set zt='1' where tradeno ='{$out_trade_no}'");
                $r['zt'] = '1';
            }
            if ($r['zt'] == '1') {//未处理
                ddcl($r, $user); //处理订单，不接受结果
            }
        }
        //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
    }
    echo "success";  //请不要修改或删除
} else {
    //验证失败
    echo "fail";
}