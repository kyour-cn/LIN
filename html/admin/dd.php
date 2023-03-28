<?php
$btitle=$btitle."/订单";
 $s = $pdo->query("SELECT count(Id) from orders ")->fetch()[0]; 
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

$a = $pdo->query("SELECT * FROM orders ORDER BY addtime desc limit {$f[3]},{$f[0]}");
$rows = $a->fetchAll(PDO::FETCH_ASSOC);
$rs = count($rows);

?>
<div class="panel panel-default">
    <div class="panel-heading">用户管理中心 - 共<?php echo $s;?>条记录</div>
    <div class="panel-body">
        <p>这里可以进行订单增删查改的可视化操作，手机用户可滑动查看右边内容。</p>
        <a class="btn btn-warning btn-xs">筛选订单</a>&nbsp;
        <!--a class="btn btn-warning btn-xs">分类查看</a>&nbsp;
        <a class="btn btn-xs btn-danger">删除</a-->
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>操作</th>
                    <th>用户ID</th>
                    <th>名称</th>
                    <th>金额</th>
                    <th>下单数据</th>
                    <th>订单号</th>
                    <th>下单时间</th>
                    <th>状态</th>
                    <th>处理结果/备注</th>
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
                    <td><a class="btn btn-info btn-xs editbtn">编辑</a>&nbsp;<a class="btn btn-xs btn-danger delbtn">删除</a></td>
                    <th scope="row"><?php echo $r['uid']; ?></th>
                    <th><?php echo $r['name']; ?></th>
                    <th><?php echo $r['money']; ?></th>
                    <th><?php echo $r['input']; ?></th>
                    <th class="uid"><?php echo $r['tradeno']; ?></th>
                    <th><?php echo date("Y-m-d H:i:s",strtotime($r['addtime'])); ?></th>
                    <th><?php echo $df_cl[$r['zt']]; ?></th>
                    <th><?php echo $r['bz']; ?></th>
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
        <h4 class="modal-title" id="exampleModalLabel">用户订单处理</h4>
      </div>
      <div class="modal-body">
        <h4>修改订单状态</h4>
        <button type="button" onClick="setdd('dcl')" class="btn btn-primary" data-dismiss="modal">待处理</button>
        <button type="button" onClick="setdd('ok')" class="btn btn-primary" data-dismiss="modal">成功</button>
        <button type="button" onClick="setdd('err')" class="btn btn-primary" data-dismiss="modal">失败</button>
        <h4>订单操作</h4>
        <button type="button" onClick="setdd('out')" class="btn btn-primary" data-dismiss="modal">退款</button>
        
        <div id="modk"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<?php
$boms=<<<EOT
<script>
function setdd(s){
var htm=$.ajax({url:"php/admin.php?setdd&"+s+"&"+tid,async:false});
    alert(htm.responseText);
    window.location.reload();
}
$(".editbtn").click(function(){
uid=$(this).parent().parent().find(".uid").text();
tid=uid;

$("#myModal").modal("show")
});
$(".delbtn").click(function(){
uid=$(this).parent().parent().find(".uid").text();
if(window.confirm("你确定要删除"+uid+"？")){
window.location.href="./php/admin.php?dddel&"+uid;
                 return true;
              }else{
                 return false;
             }
});
</script>
EOT;
?>