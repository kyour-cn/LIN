<?php
$btitle=$btitle."/商品";
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

$a = $pdo->query("SELECT * FROM user_class");
$uclass = $a->fetchAll(PDO::FETCH_ASSOC);
$adtag="tools";
?>
<div class="panel panel-default">
    <div class="panel-heading">商品价格管理 - 共<?php echo $s;?>条记录</div>
    <div class="panel-body">
        <p>这里可以进行商品用户组独立价格设定，手机用户可滑动查看右边内容。</p>
        <p><font color="red">注意：<span class='btn btn-default btn-xs'>默认</span>为默认价格！以商品 (默认价格x用户组折扣%)为准！</font></p>

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
                    echo "<th>{$a['vipid']} / {$a['name']}</th>\n";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                    <?php
                    if ($rs < 1) {
                        echo "<th scope='row'></th><td>没有记录</td><td></td><td></td><td></td><td></td></tr>";
                    } else {
                        foreach ($rows as $r) {
                    ?>
                <tr>
                    <td><a class="btn btn-info btn-xs editbtn">编辑</a></td>
                    <th class="uid" scope="row"><?php echo $r['tid']; ?></th>
                    <th><?php echo $r['name']; ?></th>
                    <?php
                    foreach ($uclass as $a){
                    $b = $pdo->query("SELECT * FROM tools_money where tid='{$r['tid']}'")->fetch();
                    //print_r($b);
                    if($b[$a['vipid']]=='main')
                    echo "<th><span class='btn btn-default btn-xs'>默认</span></th>\n";
                    else
                    echo "<th>{$b[$a['vipid']]}</th>\n";
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
        <h4 class="modal-title" id="exampleModalLabel">商品价格设定</h4>
      </div>
      <div class="modal-body">
        <p>如果需要设置默认请填写main或留空！</p>
        <div id="modk"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button id="setbtn" type="button" class="btn btn-primary">修改价格</button>
      </div>
    </div>
  </div>
</div>


<?php
$boms=<<<EOF
<script>
function ginp(a,b,c){
return '<div class="form-group"><label for="recipient-name" class="control-label">'+a+'</label><input type="text" value="'+c+'" class="form-control" id="'+b+'"></div>';
}

$(".editbtn").click(function(){
uid=$(this).parent().parent().find(".uid").text();
tid=uid;
var htm=$.ajax({url:"php/js/tmoney.php?tid="+uid,async:false});
eval(htm.responseText);
$("#myModal").modal("show")
});

  $("#setbtn").click(function(){
  var data={};
  data["data"]=plist.join("|");
  data["tid"]=tid;
  for(var i = 0;i < plist.length; i++) {
  data[plist[i]]=$("#"+plist[i]).val();
}

  $.post("php/admin.php?tmoneyupd",data,function(result){
    if(result!="ok")alert("修改可能未成功！");
$("#myModal").modal("hide")
window.location.reload();
  });

  });
</script>
EOF;
?>