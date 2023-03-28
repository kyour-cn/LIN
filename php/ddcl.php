<?php
//订单处理
function ddcl($r,$user){
global $pdo;
$o="ok";
switch ($r[cid])
{
case "1"://充值
    $a=$user['money']+$r['money'];
    $b=$user['addmoney']+$r['money'];
    $pdo->query("update user set money='{$a}' , addmoney='{$b}' where uid ='{$r['uid']}'");
    $pdo->query("update orders set zt='3' where tradeno ='{$r['tradeno']}'");
    $time=date("Y-m-d H:i:s",time());
    $pdo->query("INSERT user_log (uid,time,name,m,cid) VALUES ('{$user['uid']}','{$time}','充值余额{$r['money']}元','{$r['money']}','1')");
    //$o="ok";
break;
case "2"://消费
    $a=apiddcl($r);
    $time=date("Y-m-d H:i:s",time());
    if($a[0]=="ok"){
    query("update orders set zt='3',bz=? where tradeno ='{$r['tradeno']}'",array($a[1]));
    $pdo->query("INSERT user_log (uid,time,name,m,cid) VALUES ('{$user['uid']}','{$time}','{$r['name']}','{$r['money']}','2')");
    }else{
        query("update orders set zt='3',bz=? where tradeno ='{$r['tradeno']}'",array($a[2]));
        $o=$a[1];
    }
break;
default:
    $o="订单类型不存在：cid=".$r[cid];
}
return $o;
}

function apiddcl($r){
    global $pdo;
    $tool=$pdo->query("SELECT * FROM tools where tid='{$r['tid']}'")->fetch();
    $a=str_replace(array('[time]', '[name]','[money]','[num]'), array($r['addtime'],$tool['name'],$r['money'],$r['num']), $tool['clval']);
    $b=str_replace(array('[time]', '[name]','[money]','[num]'), array($r['addtime'],$tool['name'],$r['money'],$r['num']), $tool['clpost']);
    $in=explode('|',$r['input']);
    //$inv=explode('|',$tool['inputs']);
$l=count($in);
if($l==1){
    $a=str_replace("[in1]",$in[0], $a);
    $b=str_replace("[in1]",$in[0], $b);
}else{
for($i=0;$i<$l;$i++){
    $a=str_replace("[in".($i+1)."]",$in[$i], $a);
    $b=str_replace("[in".($i+1)."]",$in[$i], $b);
 }
}


$header = array(
     "Content-Type:application/x-www-form-urlencoded;charset=UTF-8",
     "SocketLog:SocketLog(tabid=121&client_id=ADMIN_ADMIN)",
     "Cookie:".$tool['cookie'],
     'User-Agent:Mozilla/5.0 (Windows NT 6.1; rv:57.0) Gecko/20100101 Firefox/57.0');
//array_push($header,"Cookie:".$tool['cookie']);
$curl="";
try{
    $curl=cp($a,$b,$header);
} catch (Exception $e) {
    return array("err",$e->getMessage());
}
if($tool['vals']!="NONE"){
$val=explode("||",$tool['vals']);
if($val[0]=="TEXT"){
if($curl!=$val[1]) return array("err","订单结果判断为错误，请检查是否成功！",$curl);
}else if($val[0]=="JSON"){
    $vv=explode("&",$val[1]);
    //$jj=preg_replace(["/([a-zA-Z_]+[a-zA-Z0-9_]*)\s*:/", "/:\s*'(.*?)'/"], ['"\1":', ': "\1"'], $curl);
    $jsn=json_decode($curl, true);
    foreach ($vv as $k => $v){
        $fg=explode("=",$vv[$k]);
        if($jsn[$fg[0]]!=$fg[1])
        return array("err","订单错误，请检查是否成功:JSON",$curl);
    }
}
}
    return array("ok",$curl);
}