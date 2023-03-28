<?php
if($yms[1]=='doc'){
?>
<div class="row">
    <div class="col-sm-7 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">科佑儿LIN下单系统-API对接文档</div>
                </div>
            </div>
            <div class="card-body">
                <blockquote>
                    <p>本文档只实用于本系统，请正确填写接口地址！
                    </p>
                    <footer>
                    每个用户都有一个随机生成的8位随机唯一秘钥，简称key。只可重置，不可修改！<br>
                    你可以去<a href="./view.php?user"><font color="red">用户中心(点这里)</font></a>查看和重置！
                    </footer>
                </blockquote>
                <div class="sub-title">API统一说明 - about</div>
                <p>
                    - API通过http协议进行基础指令传递来完成相应的功能的接口工具！<br>
                    本接口的一些介绍:<br>
                    <b>run参数 : API处理结果返回类型！</b><br>
                    run=code 返回处理结果数字代码！<br>
                    如 : 1
                    <br>
                    <i>run=msg 返回处理结果数字代码！</i><br>
                    如 : 商品购买成功
                    <br>
                    run=json 返回处理结果的json字符串(默认)<br>
                    如 : {code="1",msg="商品购买成功",name="商品名",money="金额"}
                    <br><br>
                    <i>返回code(结果数字代码)说明！</i><br>
                    0 : 请求未处理，原因：秘钥不正确，商品不存在，商品参数数量不正确<br>
                    -1 : 余额不足以进行该操作！
                </p>
                <hr>
                <div class="sub-title">在线下单 - order</div>
                <p>
                    <h5>api.php?order</h5>
                    <b>key </b>: 用户秘钥，必填<br>
                    <b>tid </b>: 商品id<br>
                    <b>input</b> : 传入参数值(下单数据)，多个用|符号隔开<br>
                    --如 input=123  多个参数  input=123|456|xxx<br>
                    --参数数量必须与商品设定的个数相同！<br>
                    <b>num</b> : 购买数量，默认1，按照商品规则填写！<br>
                    <br>
                    <b>示例:http://<?php echo $this_host; ?>/api.php?order<br>
                    key=xx&tid=xx&input=xx&num=xx
                    </b>
                </p>
                <div class="sub-title"><未完善>获取商品列表 - tools</div>
                <h5>api.php?tools</h5>
                <p>http://<?php echo $this_host; ?>/api.php?tools</p>
                返回json数据
            </div>
        </div>
    </div>
</div>

<?php }else{


$btitle=$btitle."/商品列表";
 $s = $pdo->query("SELECT count(Id) from tools ")->fetch()[0]; 
 $f=array(20,0,0,0,0);//0分页记录数/1总页数/2当前页/3查询开始记录数/4查询结束记录数
if($s>$f[0]){
$f[1]=ceil($s / $f[0]);
if(isset($yms[2])){
$f[2]=$yms[2];
}else{
$f[2]=1;
}
if($f[2]>$f[1]) $f[2]=$f[1];
$f[4]=$f[2]*$f[0];
$f[3]=$f[4]-$f[0];
}
$a = $pdo->query("SELECT * FROM tools ORDER BY px limit {$f[3]},{$f[0]}");
$rows = $a->fetchAll(PDO::FETCH_ASSOC);
$rs = count($rows);

$sit=query("SELECT diytool FROM user where uid=?",array($user['uid']))->fetch();
$diyt=json_decode($sit['diytool'],true);

$a=$pdo->query("SELECT px FROM user_class where vipid='{$user['class']}'")->fetch();
$a = $pdo->query("SELECT * FROM user_class where px<".$a['px']);
//$a = $pdo->query("SELECT * FROM user_class");
$uclass = $a->fetchAll(PDO::FETCH_ASSOC);
$adtag="tools";
?>
<div class="panel panel-default">
    <div class="panel-heading">商品对接API一键生成 - 共<?php echo $s;?>个商品</div>
    <div class="panel-body">
        <p>这里可以一键生成商品下单API，手机用户可滑动查看右边内容。</p>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>操作</th>
                    <th>商品ID</th>
                    <th>商品名</th>
                    <?php
                    foreach ($uclass as $a) {
                    echo "<th> {$a['name']} 价格</th>\n";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                    <?php
                    if ($rs < 1) {
                        echo "<th scope='row'></th><td>没有记录</td></tr>";
                    } else {
                        foreach ($rows as $r) {
                    ?>
                <tr>
                    <td style="width:100px;"><a class="btn btn-info btn-xs editbtn">生成API</a></td>
                    <th  style="width:120px;" class="uid" scope="row"><?php echo $r['tid']; ?></th>
                    <th style="width:200px;"><?php echo $r['name']; ?></th>
                    <?php
                    foreach ($uclass as $a){
                    $b = $pdo->query("SELECT * FROM tools_money where tid='{$r['tid']}'")->fetch();
                    //print_r($b);
                    $tm=gettoolmonsite($r,$a['vipid']);
                    $tj=$diyt[$r['tid']][$a['vipid']];
                    if(empty($tj))$tj=0;
                    echo "<th>{$tm}+{$tj}</th>\n";
                    //echo "SELECT * FROM tools_money where tid='{$r['tid']}'";
                    }
                    ?>
                </tr>
                    <?php
                        }
                    }
                    ?>
            </tbody>
        </table>
        

        <?php if($f[1]>1){ ?>
            <ul class="pagination">
            <?php if($f[2]!=1){ ?>
                <li>
                    <a href="<?php echo 'view.php?'.$yms[0].'&'.$yms[1]; ?>" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <?php
                }
                
               for ($x=1; $x<=$f[1]; $x++) {
                if($f[2]==$x)
                echo '<li class="active"><a href="view.php?'.$yms[0]."&".$yms[1]."&".$x.'">'.$x.'</a></li>';
                else
                echo '<li><a href="view.php?'.$yms[0]."&".$yms[1]."&".$x.'">'.$x.'</a></li>';
                }
             if($f[2]!=$f[1]){
             ?>
                <li>
                    <a href="<?php echo 'view.php?'.$yms[0].'&'.$yms[1].'&'.$f[1]; ?>" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <?php }?>
    </div>
</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">商品提成设定</h4>
      </div>
      <div class="modal-body">
        <p>下方链接为本商品的对接API</p>
        <div id="modk"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>


<?php
$ukey=$user['apikey'];
$boms=<<<EOF
<script>
function ginp(a,b,c){
return '<div class="form-group"><label for="recipient-name" class="control-label">'+a+'</label><input type="text" value="'+c+'" class="form-control" id="'+b+'"></div>';
}
var ukey="$ukey";
$(".editbtn").click(function(){
uid=$(this).parent().parent().find(".uid").text();
tid=uid;
//var htm=$.ajax({url:"php/js/tmoney.php?n=1&tid="+uid,async:false});
//eval(htm.responseText);
var api=$.ajax({url:"php/js/getapi.php?n=1&tid="+uid,async:false});
$("#modk").html("代刷网：<br>"+api.responseText);
$("#myModal").modal("show")
});

  $("#setbtn").click(function(){
  var data={};
  data["data"]=plist.join("|");
  data["tid"]=tid;
  for(var i = 0;i < plist.length; i++) {
  data[plist[i]]=$("#"+plist[i]).val();
}

$.post("php/admin.php?sitemupd",data,function(result){
$("#myModal").modal("hide")
window.location.reload();
  });

  });
</script>
EOF;
}
?>