<?php
$btitle=$btitle."/商品分类";
 $s = $pdo->query("SELECT count(nid) from news where c1='new'")->fetch()[0]; 
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

$a = $pdo->query("SELECT * FROM news where c1='new' ORDER BY time desc limit {$f[3]},{$f[0]}");
$rows = $a->fetchAll(PDO::FETCH_ASSOC);
$rs = count($rows);

$adtag="gg";
?>
<div class="row">
<div class="col-sm-8 col-xs-12">
<div class="panel panel-default">
    <div class="panel-heading">站内消息管理 - 共<?php echo $s;?>条记录</div>
    <div class="panel-body">
        <p>这里可以进行站内消息增删查改的可视化操作，手机用户可滑动查看右边内容。</p>
        <a href="view.php?admin&new_edit&add" class="btn btn-info btn-xs">添加消息</a>&nbsp;
        <!--a class="btn btn-xs btn-danger">删除</a-->
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>操作</th>
                    <th>编号</th>
                    <th>名称</th>
                    <th>内容</th>
                    <th>时间</th>
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
                    <td><a class="btn btn-info btn-xs editbtn">编辑</a>&nbsp;<a class="btn btn-xs btn-danger delbtn">删除</a></td>
                    <th class="uid" scope="row"><?php echo $r['nid']; ?></th>
                    <th><?php echo $r['c2']; ?></th>
                    <th><?php echo  mb_substr(strip_tags($r['text']), 0, 120, 'utf-8'); ?>...</th>
                    <th><?php echo $r['time']; ?></th>
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
</div>
</div>
<?php
$boms='<script>
$(".editbtn").click(function(){
uid=$(this).parent().parent().find(".uid").text();
window.location.href="./view.php?admin&new_edit&"+uid;
});
$(".delbtn").click(function(){
uid=$(this).parent().parent().find(".uid").text();
if(window.confirm("你确定要删除"+uid+"？")){
window.location.href="./php/admin.php?newdel&"+uid;
                 return true;
              }else{
                 return false;
             }
});
</script>';
?>