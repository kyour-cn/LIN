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
$time =date("Y-m-d H:i:s",time());

//下单处理
if ($ym == "add"){
    $money =trims( $_POST['money']);
    if(!isnum($money)){
        $_SESSION["alert"] = alert('金额输入有误！',1);
        header("Location:" . $_SESSION["payqurl"]);
        exit;
    }
    $name = "充值余额" . $money . "元";
    $sql = "INSERT INTO `orders`(`tid`, `uid`, `name`, `addtime`, `tradeno`, `money`, `zt`, `cid`, `input`) VALUES ('0', ?, ?, ?, ?, ?, 0, '1', ?)";
    $a = array($user['uid'], $name, $time, $out_trade_no, $money, "余额" . $user['money']);
    query($sql, $a);
    //$pdo->query($sql);
}else if ($ym == "xd"){
    if (empty($num)) $num = "1";
    $tool = $pdo->query("SELECT * FROM tools where zt='1' and tid='{$tid}'")->fetch();
    if (empty($tool['tid'])) {
        $_SESSION["alert"] = alert('该商品并不存在！',1);
        header("Location:" . $_SESSION["payqurl"]);
        exit;
    }
    if($num<$tool['num']){
        $_SESSION["alert"] = alert("下单数量不能低于{$tool['num']}！",1);
        header("Location:" . $_SESSION["payqurl"]);
        exit;
    }
    
     //未计算折扣
    
    //计算价格
    $money=getmytoolmon($tool);
    /*
    $b = $pdo->query("SELECT * FROM tools_money where tid='{$tool['tid']}'")->fetch();
    $money=$b[$user['class']];
    if($money=="main"){
        $money=$tool['money'];
        $c = $pdo->query("SELECT * FROM class where cid='{$tool['class']}'")->fetch();
        if($c['iszk']=="1"){
        $uc=$pdo->query("SELECT * FROM user_class where vipid='{$user['class']}'")->fetch();
        $money=round($money*($uc['zk']/100),8);
        }
    }
    */

    $name = "购买:" . $tool['name'];
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

    query("INSERT INTO `orders`(`tid`,`uid`,`name`,`addtime`,`tradeno`,`money`,`zt`,`cid`,`input`,`num`) VALUES (?,?,?,?,?,?,0,'2',?,?)",array($tool['tid'],$user['uid'], $name, $time, $out_trade_no, $money, $input, $num));
        if ($user['money'] < $money) {
            $_SESSION["alert"] = alert('您的余额不足已购买该商品！',1);
            header("Location:" . $_SESSION["payqurl"]);
            exit;
        }
        $pdo->query("update orders set zt='1' where tradeno ='{$out_trade_no}'");
        $rows = $pdo->query("select * from orders where tradeno = '{$out_trade_no}'")->fetchAll(PDO::FETCH_ASSOC);
        $rs = count($rows);
        if ($rs < 1) {
            $_SESSION["alert"] = '<div class="alert alert-danger" role="alert">订单创建失败，数据库错误:epay.74！</div>';
            header("Location:" . $_SESSION["payqurl"]);
            exit;
        }
        $a = $user['money'] - $money;
        $xf= $user['xfmoney'] + $money;
        query("update user set money=? , xfmoney=? where uid =?", array($a,$xf, $user['uid']));
        if($issite){
            $mm=getsitetc($tid);
            query("update user set money=money+'{$mm}' where uid =?", array($conf['siteuid']));//添加提成
            $pdo->query("INSERT user_log (uid,time,name,m,cid) VALUES ('{$conf['siteuid']}','{$time}','下级提成：{$mm}元','{$mm}','2')");
        }
            $r = $rows[0];
//      if ($type == "yue") {//余额支付
            $pdo->query("update orders set zt='2' where tradeno ='{$out_trade_no}'");
            require_once("../php/ddcl.php");
            $b=ddcl($r, $user);
            if($b=="ok"){
            $_SESSION["alert"] = alert('订单处理已完成，请核实处理结果！');
            }else{
            $_SESSION["alert"] = alert('订单处理结果：'.$b,1);
            }
            header("Location:../view.php?mydd");
            exit;
 //       }
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