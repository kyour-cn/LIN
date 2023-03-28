function toe(a,b,c){
return '<div class="sub-title">'+a+'</div><div><input name="'+b+'" id="'+b+'"value="'+c+'" class="form-control" type="text"></div>';
}

$(document).ready(function(){
$("#tid").change(function(){
var a=$(this).val();
$("#tmoney").text(tools[a].m);
$("#text").html(tools[a].text);
if(tools[a].num==0){
$("#numd").html("");
}else{
$("#numd").html(toe("购买数量","num","num"));
$('#num').val(tools[a].num);
}
var s=tools[a].in.split("|");
var v=tools[a].inn.split('|');
var xv="";
//alert(tools[a].in);
for(n  in s){
xv+=v[n]+'<input name="'+s[n]+'" class="form-control" placeholder="" type="text"><br>';
}
$("#xdinp").html(xv);
});
});

var tools={
<?php
$isl=true;
include $_SERVER['DOCUMENT_ROOT'].'/php/main.php';
$q=query("SELECT * FROM tools where class=? ORDER BY px",array($_GET["c"]));
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

$b = $pdo->query("SELECT * FROM tools_money where tid='{$r['tid']}'")->fetch();
$mon=$b[$user['class']];//$r['money']
if($mon=="main")$mon=$r['money'];




    $a=str_replace("'","\\'",$r['text']);
    echo "{$r['tid']}: {m:'{$mon}',text:'{$a}',in:'{$s}',inn:'{$r['inputs']}',num:{$r['num']}},\n";
    $s++;
}
?>
}