<?php //对接API接口程序
@$ym = $_SERVER["QUERY_STRING"];
$yms = explode("&", $ym);
$ym = $yms[0];
include './php/main.php';
$er=array(
"msg"=>"请求未响应",//文字代码
"code"=>"0",//返回数字代码
"name"=>"",//名称
"umoney"=>"",//用户余额
"tmoney"=>"",//商品价格
"no"=>"",//订单号
"zt"=>""
);
$ggc="json";
function endc(){
global $er;global $sout;global $ggc;global $ddid;
$sout["e"]=false;
switch ($ggc)
{
case "text":
  die($er["msg"]);
case "json":
  die("{code:\"{$er["code"]}\",msg:\"{$er["msg"]}\",tmoney:\"{$er["tmoney"]}\",umoney:\"{$er["umoney"]}\",no:\"{$er["no"]}\",name:\"{$er["name"]}\"}");
case "xml":
  //die('<xml><ds><code>'.$er["code"] .'</code><msg>'.$er["msg"] .'</msg><m>'. $er["m"] .'</m><y>'. $er["y"] .'</y></ds>');
case "msg":
  die($er["msg"]);
default:
  die($er["code"]);
}
}
//处理请求
switch($ym){
case "order"://下单
$out_trade_no = date("YmdHis") . mt_rand(100, 999);
$key=trims($_REQUEST['key']);
$tid=trims($_REQUEST['tid']);
$num=trims($_REQUEST['num']);
$inputs=trims($_REQUEST['input']);
$rs=trims($_REQUEST['rs']);//返回值类型
	$user=query("SELECT * FROM user where apikey=?",array($key))->fetch();
if($user['apikey']!=$key or $key==""){
$er['msg']="秘钥不正确或不存在";
}




    //下单开始
$time = date("Y-m-d H:i:sa");
    if (empty($num)) $num = "1";
    $tool = query("SELECT * FROM tools where tid=?",array($tid))->fetch();
    if (empty($tool['tid'])) {
        $er['name']='该商品并不存在！';
        endc();
    }
    $s1=count(explode('|',$tool['inputs']));
    $s2=count(explode('|',$inputs));
    if($s1!=$s2){
        $er['msg']="参数数量不正确";
        endc();
    }
    $money = $tool['money']; //未计算折扣
    
    //计算价格
    $b = $pdo->query("SELECT * FROM tools_money where tid='{$tool['tid']}'")->fetch();
    $money=$b[$user['class']];
    if($money=="main"){
        $money=$tool['money'];
    }
    
    $name = "API购买:" . $tool['name'];
    $sql = "INSERT INTO `orders`(`tid`, `uid`, `name`, `addtime`, `tradeno`, `money`, `zt`, `cid`, `input`, `num`) VALUES (?,?, ?, ?, ?, ?, 0, '2', ?, ?)";
    $b = "0";
    
    
    $a = array($tool['tid'],$user['uid'], $name, $time, $out_trade_no, $money, $inputs, $num);
    print_r($a);
    query($sql, $a);
    
        if ($user['money'] < $money) {
            //$_SESSION["alert"] = '<div class="alert alert-danger" role="alert">您的余额不足已购买该商品！</div>';
            $er['msg']='余额不足';
            endc();
        }
        $pdo->query("update orders set zt='1' where tradeno ='{$out_trade_no}'");
        $a = $user['money'] - $money;
        $xf= $user['xfmoney'] +$money;
        query("update user set money=? , xfmoney=? where uid =?", array($a,$xf, $user['uid']));
        $a = $pdo->query("select * from orders where tradeno = '{$out_trade_no}'");
        $rows = $a->fetchAll(PDO::FETCH_ASSOC);
        $rs = count($rows);
        if ($rs < 1) {
            $er['msg']='订单创建失败，数据库错误';
            
        }
            $r = $rows[0];
            //余额支付
            $pdo->query("update orders set zt='2' where tradeno ='{$out_trade_no}'");
            require_once("./php/ddcl.php");
            $b=ddcl($r, $user);
            if($b=="ok"){
            $er['msg']='下单成功';
            }else{
            $er['msg']=$b;
            }
            $er['code']='1';
            //下单结束




































endc();
break;
case "user_add"://添加用户

break;
case "order_update":
$oid=trims($_REQUEST['name']);
      query("UPDATE user_class SET vipid = ? WHERE vipid = ?",array($u,$yms[1]));
break;
default:
$er['msg']="Unicode";
endc();
}