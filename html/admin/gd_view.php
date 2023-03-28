<?php
$gd = query("SELECT * FROM gd where Id=?", array($yms[2]))->fetch();
//$gds=query("SELECT * FROM gd where Id=? and cid='1",array($yms[2]))->fetch();
$rows = query("SELECT * FROM gd where gid=? and cid=1 ORDER BY time", array($yms[2]))->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-sm-7 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">工单内容</div>
                </div>
            </div>
            <div class="card-body">
                <h2 style="text-align:center"><?php echo mb_substr($gd['text'], 0, 8, 'utf-8'); ?></h2>
                <hr>

                <div class="row">
                    <?php
                    echo '<div class="col-md-9"><div class="alert alert-success" role="alert"><strong>' . $user['name'] . '：</strong>' . $gd['text'] . '</div></div>';
                    
                        //$r = $q->fetch();
                        //while($r = $q->fetch()){
                        foreach ($rows as $r) {
                            if ($r['uc'] != 1) {
                                ?>
                                <div class="col-md-9"><div class="alert alert-success" role="alert"><strong><?php echo $r['uid']; ?>：</strong><?php echo $r['text']; ?></div></div>
                                <?php
                            } else {
                                ?>
                                <div class="col-md-9 col-md-offset-3"><div class="alert alert-warning" role="alert"><strong><?php echo $user['name']; ?>：</strong><?php echo $r['text']; ?></div></div>
                                <?php
                            }
                        }
                    
                    ?>

<!--div class="col-md-9"><div class="alert alert-success" role="alert"><strong>管理员：</strong>你好，请问有什么可以帮到你的吗？</div></div>

<div class="col-md-9 col-md-offset-3"><div class="alert alert-warning" role="alert"><strong>用户：</strong>你好，我这边遇到点问题<br>下单后并没有到账。</div></div>
<div class="col-md-7"><div class="alert alert-success" role="alert"><strong>管理员：</strong>哦，这可能是因为您太丑了的原因。</div></div-->
                </div>
                <form action="./php/gds.php?ad_upd&<?php echo $yms[2];?>" method="post">
                <div class="sub-title">发送消息</div>
                <?php
                if($gd['uc']==1){
                    echo "已完成！不能继续回复";
                }else{
                ?>
                <div>
                    <input name="text" placeholder="请填写要发送的内容" class="form-control" type="text">
                </div><br>
                <button type="submit" href="view.php?gd" class="btn btn-success pull-right"> 发送 </button>
                <?php }?>
                <a href="./php/gds.php?end&<?php echo $yms[2];?>" class="btn btn-default"> 结束工单 </a>
                <a href="view.php?admin&gd" class="btn btn-default pull-right"> 返回列表 </a>
                </form>
                <br>
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