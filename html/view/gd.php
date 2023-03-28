<?php
$btitle = "管理工单";
$i = true;
$rows = query("SELECT * FROM gd where uid=? and cid=0 ORDER BY time desc", array($user['uid']))->fetchAll(PDO::FETCH_ASSOC);
$rs = count($rows);
$ym = "user";
?>
<div class="row">
    <div class="col-sm-7 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">工单管理</div>
                </div>
            </div>
            <div class="card-body">
                <img src="assets/img/m1.jpg" style="width: 100px;height:100px;" class="img-circle center-block">
                <h2 style="text-align:center"><?php echo $user['name']; ?></h2>
                <h2 style="text-align:center">
                </h2>
                <hr>
                <div class="list-group"><a href="view.php?gd_view&add" class="btn btn-success">添加工单</a>
                    <a  class="list-group-item active">
                        工单列表
                    </a>
                    <?php
                    if ($rs < 1) {
                        echo '<a class="list-group-item"><h4 class="list-group-item-heading">没有工单记录</h4></a>';
                    } else {
                        //$r = $q->fetch();
                        //while($r = $q->fetch()){
                        foreach ($rows as $r) {
                            ?>
                            <a href="view.php?gd_view&<?php echo $r['Id']; ?>" class="list-group-item"><h4 class="list-group-item-heading"><?php echo mb_substr($r['text'], 0, 8, 'utf-8');
                    if ($r['uc'] != '1') echo'&nbsp;&nbsp;<span class="badge">未完成</span>'; ?></h4></a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <br>



    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">常见问题</div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr class="active"><th scope='row'>为什么下单后没有到账？</th><td>因为你丑。</td></tr>
                        <tr ><th scope='row'>为什么我丑？</th><td>因为你没钱。</td></tr>
                        <tr class="active"><th scope='row'>为什么我没钱？</th><td>因为你丑。</td></tr>
                        <tr ><th scope='row'>为什么我丑？</th><td>因为你没钱。</td></tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$boms = '<script>

$("#upkey").click(function(){
uid=$(this).parent().parent().find(".uid").text();
if(window.confirm("你确定要重置？")){
window.location.href="view.php?user&czkey";
                 return true;
              }else{
                 return false;
             }
});
</script>';
?>
<img src="./php/js/img.php"style="visibility: hidden;" >