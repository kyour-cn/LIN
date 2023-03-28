<?php
/* *
 * 功能：易支付入口-请勿修改
 */
$isl = true;
require_once("../php/main.php");
require_once("epay.config.php");
require_once("lib/epay_submit.class.php");
@$ym = $_SERVER["QUERY_STRING"];
@$_SESSION["payqurl"] = $_SERVER['HTTP_REFERER'];
$yms = explode("&", $ym);
$ym = $yms[0];

$notify_url = $this_url . "/pay/notify_url.php";
//需http://格式的完整路径，不能加?id=123这类自定义参数
//页面跳转同步通知页面路径
$return_url = $this_url . "/pay/return_url.php";
//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
//商户订单号
$out_trade_no = date("YmdHis") . mt_rand(100, 999);
//商户网站订单系统中唯一订单号，必填
//支付方式
$type = trims($_POST['type']);
$num =trims( $_POST['num']);
//$input = trims($_POST['input']);
$tid=trims($_POST['tid']);
//商品名称
$name = "测试";
//付款金额
$money = '0.01';
//站点名称
$sitename = '科佑儿网络';
$time = date("Y-m-d H:i:sa");

//下单处理
if ($ym == "add"){
    $money =trims( $_POST['money']);
    $name = "充值余额" . $money . "元";
    $sql = "INSERT INTO `orders`(`tid`, `uid`, `name`, `addtime`, `tradeno`, `money`, `zt`, `cid`, `input`) VALUES ('0', ?, ?, ?, ?, ?, 0, '1', ?)";
    $a = array($_SESSION["user_uid"], $name, $time, $out_trade_no, $money, "余额" . $user['money']);
    query($sql, $a);
    //$pdo->query($sql);
}else if ($ym == "xd"){
    if (empty($num)) $num = "1";
    $tool = $pdo->query("SELECT * FROM tools where tid='{$tid}'")->fetch();
    if (empty($tool['tid'])) {
        $_SESSION["alert"] = '<div class="alert alert-danger" role="alert">该商品并不存在！</div>';
        header("Location:" . $_SESSION["payqurl"]);
        exit;
    }
    
    
    $money = $tool['money']; //未计算折扣
    
    //计算价格
    $b = $pdo->query("SELECT * FROM tools_money where tid='{$tool['tid']}'")->fetch();
    $money=$b[$user['class']];
    if($money=="main"){
        $money=$tool['money'];
    }
    
    $name = "购买:" . $tool['name'];
    $sql = "INSERT INTO `orders`(`tid`, `uid`, `name`, `addtime`, `tradeno`, `money`, `zt`, `cid`, `input`, `num`) VALUES (?,?, ?, ?, ?, ?, 0, '2', ?, ?)";
    $b = "0";
    $input="";
    //处理input上传数据组合
    $in=explode('|',$tool['inputs']);
    $l=count($in);
    if($l==1){
$input=trims($_POST[$in[0]]);
}else{
for($i=0;$i<$l;$i++){ 
  $input=$input.trims($_POST["in".($i+1)]); 
  if($i<$l-1) $input=$input."|";
 }
}
    
    
    $a = array($tool['tid'],$_SESSION["user_uid"], $name, $time, $out_trade_no, $money, $input, $num);
    query($sql, $a);
    
        if ($user['money'] < $money) {
            $_SESSION["alert"] = '<div class="alert alert-danger" role="alert">您的余额不足已购买该商品！</div>';
            header("Location:" . $_SESSION["payqurl"]);
            exit;
        }
        $pdo->query("update orders set zt='1' where tradeno ='{$out_trade_no}'");
        $a = $user['money'] - $money;
        $xf= $user['xfmoney'] + $money;
        query("update user set money=? , xfmoney=? where uid =?", array($a,$xf, $user['uid']));
        $a = $pdo->query("select * from orders where tradeno = '{$out_trade_no}'");
        $rows = $a->fetchAll(PDO::FETCH_ASSOC);
        $rs = count($rows);
        if ($rs < 1) {
            $_SESSION["alert"] = '<div class="alert alert-danger" role="alert">订单创建失败，数据库错误:epay.74！</div>';
            header("Location:" . $_SESSION["payqurl"]);
            exit;
        }
            $r = $rows[0];
            
//      if ($type == "yue") {//余额支付
            $pdo->query("update orders set zt='2' where tradeno ='{$out_trade_no}'");
            require_once("../php/ddcl.php");
            $b=ddcl($r, $user);
            if($b=="ok"){
            $_SESSION["alert"] = '<div class="alert alert-danger" role="alert">订单处理已完成，请核实处理结果！</div>';
            }else{
            $_SESSION["alert"] = '<div class="alert alert-danger" role="alert">订单处理结果：'.$b.'</div>';
            }
            header("Location:../view.php?mydd");
            exit;
 //       }
        //exit; //不继续进行付款
    }//结束
    //exit; //拒绝付款测试用


//易支付
$parameter = array(
  "pid" => trim($alipay_config['partner']),
  "type" => $type,
  "notify_url" => $notify_url,
  "return_url" => $return_url,
  "out_trade_no" => $out_trade_no,
  "name" => $name,
  "money" => $money,
  "sitename" => $sitename
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;
?>