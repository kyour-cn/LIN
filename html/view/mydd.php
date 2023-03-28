<?php
$btitle = "我的订单";
 $s = $pdo->query("SELECT count(Id) from orders where uid = '{$_SESSION["user_uid"]}' and zt!='0'")->fetch()[0]; 
 $f=array(20,0,0,0,0);//0分页记录数/1总页数/2当前页/3查询开始记录数/4查询结束记录数
if($s>$f[0]){
$f[1]=ceil($s / $f[0]);
if(isset($yms[1])){
$f[2]=$yms[1];
}else{
$f[2]=1;
}
if($f[2]>$f[1]) $f[2]=$f[1];
$f[4]=$f[2]*$f[0];

$f[3]=$f[4]-$f[0];
}

$sql="SELECT tradeno,name,input,num,addtime,zt FROM orders where uid = '{$_SESSION["user_uid"]}' and zt!='0' ORDER BY addtime desc limit {$f[3]},{$f[0]}";
$a = $pdo->query($sql);
$rows = $a->fetchAll(PDO::FETCH_ASSOC);
$rs = count($rows);


$ym="user";
?>
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <div class="title">订单记录表<span class="description">共<?php echo $s; ?>条记录</span></div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>订单ID</th>
                    <th>商品名称</th>
                    <th>下单数据</th>
                    <th>数量</th>
                    <th>时间</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    if ($rs < 1) {
                        echo "<th scope='row'></th><td>没有记录</td></tr>";
                    } else {

                        foreach ($rows as $r) {
                            echo "<th scope='row'>{$r['tradeno']}</th><td>{$r['name']}</td><td>{$r['input']}</td><td>{$r['num']}</td><td>{$r['addtime']}</td><td>{$df_cl[$r['zt']]}</td></tr>";
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
        <center>
        <?php if($f[1]>1){ ?>
            <ul class="pagination">
            <?php if($f[2]!=1){ ?>
                <li>
                    <a href="<?php echo 'view.php?'.$yms[0]; ?>" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <?php
                }
                
               for ($x=1; $x<=$f[1]; $x++) {
                if($f[2]==$x)
                echo '<li class="active"><a href="view.php?'.$yms[0]."&".$x.'">'.$x.'</a></li>';
                else
                echo '<li><a href="view.php?'.$yms[0]."&".$x.'">'.$x.'</a></li>';
                }
             if($f[2]!=$f[1]){
             ?>
                <li>
                    <a href="<?php echo 'view.php?'.$yms[0].'&'.$f[1]; ?>" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <?php }?>
        </center>
    </div>
</div>