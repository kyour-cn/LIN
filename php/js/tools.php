function tonum(n){
    return Number(n).toFixed(2);
}

var money=[0,0];
function toe(a,b,c){
    return '<div class="sub-title">'+a+'</div><div><input name="'+b+'" id="'+b+'"value="'+c+'" class="form-control" type="text"></div>';
}
function getshuoshuo(){
    qq=$("input[name='in1']").val();
    $.post("php/js/get.php?qqss=1",{'qq':qq},function(result){//8065104
        ss=JSON.parse(result).data;
        var h='说说ID<div class="form-group form-inline"><input name="in2" id="in2" class="form-control"  placeholder="说说ID" type="text">&nbsp;<select id="ssxz" name="host" style="height:33px;width:200px;">';
        for (x in ss){
            h+= "<option value='"+ss[x].tid+"'>"+ss[x].content+"</option>";
        }
        h+='</select>&nbsp;<a href="javascript:getshuoshuo()" class="btn btn-info">自动获取</a></div>';
        $('#qqss').html(h);
        $("input[name='in2']").val(ss[0].tid);
        $("#ssxz").change(function(){
        var a=$(this).val();
        $("input[name='in2']").val(a);
        });
      });
}
$(document).ready(function(){
    $("#tid").change(function(){
    var a=$(this).val();
    var vm=tools[a].m;
    if(tools[a].mm!=""){
        vm="<s>"+tools[a].mm+"</s>&nbsp;&nbsp;折后："+vm;
    }
    money.vm=tools[a].m;
    money.mm=tools[a].mm;
    $("#tmoney").html(vm);
    htmlobj=$.ajax({url:"/php/js/tools_get.php?tid="+a,async:false});
    $("#text").html(htmlobj.responseText);
    htmlobj=null;
    if(tools[a].num==0){
        $("#numd").html("");
    }else{
        $("#numd").html(toe("购买数量(不能低于"+tools[a].num+")","num","num")+"<br>");
        $('#num').val(tools[a].num);
        $('#num').bind('input propertychange', function(){
            var n=$(this).val();
            var m=tonum(money.vm*n);
            var p=tonum(money.mm*n);
            if(money.mm!=""){
                m="<s>"+p+"</s>&nbsp;&nbsp;折后："+m;
            }
            $("#tmoney").html(m);
        
        });
    }
        var s=tools[a].in.split("|");
        var v=tools[a].inn.split('|');
        var xv="";

        for(n  in s){
            if(v[n]=="说说ID"||v[n]=="说说 I D"){
                xv+="<div id='qqss'></div><br>";
                getshuoshuo();
            }else{
                xv+=v[n]+'<input name="'+s[n]+'" class="form-control" placeholder="" type="text"><br>';
            }
        }
        $("#xdinp").html(xv);
    });
});
var tools={
<?php

function getmm($tool){//no site+
    global $user;
    global $pdo;
    global $issite;
    global $conf;
    $userc=$user['class'];
    $b = $pdo->query("SELECT * FROM tools_money where tid='{$tool['tid']}'")->fetch();
    $money=$b[$userc];
    if($money=="main"){
        $money=$tool['money'];
        $c = $pdo->query("SELECT iszk FROM class where cid='{$tool['class']}'")->fetch();
        if($c['iszk']=="1"){
        //$uc=$pdo->query("SELECT zk FROM user_class where vipid='{$userc}'")->fetch();
        //$money=round($money*($uc['zk']/100),8);
        }else
        return "";
    }
    if($issite){
        $sit=query("SELECT diytool FROM user where uid=?",array($conf['siteuid']))->fetch();
        $diyt=json_decode($sit['diytool'],true);
        //print_r($diyt);
        //echo "\n".$tool['tid']."/".[$userc]."/".$diyt[$tool['tid']][$userc];
        //exit;
        $tj=$diyt[$tool['tid']][$userc];
        if(empty($tj))$tj=0;
        $money+=$tj;
        //$money+=0.01;
    }
    return $money;
}



$isl=true;
include $_SERVER['DOCUMENT_ROOT'].'/php/main.php';
$q=query("SELECT * FROM tools where class=? and zt='1' ORDER BY px",array($_GET["c"]));
while($r = $q->fetch()){
$s="";
$in=explode('|',$r['inputs']);
$l=count($in);
if($l==1){
$s=$in[0];
}else{
for($i=0;$i<$l;$i++){
  $s=$s."in".($i+1);
  if($i<$l-1) $s=$s."|";
 }
}
//$r = $pdo->query("SELECT * FROM user_class");
//$mm = $r->fetch();
/*
$b = $pdo->query("SELECT * FROM tools_money where tid='{$r['tid']}'")->fetch();
$mon=$b[$user['class']];//$r['money']
if($mon=="main"){
    $c = $pdo->query("SELECT * FROM class where cid='{$r['class']}'")->fetch();
    $mon=$r['money'];
    $mm="";
    if($c['iszk']=="1"){
        $mm=$mon;
        $uc=$pdo->query("SELECT * FROM user_class where vipid='{$user['class']}'")->fetch();
        $mon=round($r['money']*($uc['zk']/100),8);
    }
}
*/
    //分站提成计算

$mm=getmm($r);
//$mm=getsitetc($r['tid']);计算提成金额

//if($mm)
$mon=getmytoolmon($r);
    //$a=str_replace("'","\\'",$r['text']);
    //$e=str_replace(PHP_EOL, '',$a);
    echo "'{$r['tid']}': {m:'{$mon}',mm:'{$mm}',in:'{$s}',inn:'{$r['inputs']}',num:{$r['num']}},\n";
    $s++;
}
?>
}
