<?php
$skey=$user['apikey'];
if($yms[1]=='czkey'){//充值KEY
    $skey = "";
    	$strPol = "123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKMLNOPQRSTUVWXYZ.%*";
	    $max = strlen($strPol)-1;
        for($i=0;$i<32;$i++){
                $skey.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        //判断key是否存在
        while(($pdo->query("SELECT count(Id) from user where apikey='{$skey}'")->fetch()[0]!=0)){
        $skey = "";
            for($i=0;$i<32;$i++){
                $skey.=$strPol[rand(0,$max)];
            }
        }
        query("UPDATE user SET apikey = ? WHERE uid = ?",array($skey,$user['uid']));
        exit("<script>window.location.href='view.php?user';</script>");
        $user['uid']=$skey;
}

$btitle="用户中心";
$i=true;
$a='class="active"';
$q=query("SELECT * FROM user_log where uid=? ORDER BY time desc limit 0,10" ,array($user['uid']));
$rows=$q->fetchAll(PDO::FETCH_ASSOC);
$rs=count($rows);
?>
<div class="row">
    <div class="col-sm-7 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">个人中心</div>
                </div>
            </div>
            <div class="card-body">
                <img src="assets/img/m1.jpg" style="width: 100px;height:100px;" class="img-circle center-block">
                <h2 style="text-align:center"><?php echo $user['name'];?></h2>
                <hr>
                <div slass="row">
                    <div class="col-sm-4 col-xs-12">
                        <a href="#">
                <div class="card yellow summary-inline">
                    <div class="card-body">
                        <i class="icon fa fa-users fa-4x"></i>
                        <div class="content">
                            <div class="title"><?php echo $user['money'];?></div>
                            <div class="sub-title">当前余额</div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                </div>
            </a><br>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <a href="#">
                <div class="card blue summary-inline">
                    <div class="card-body">
                        <i class="icon fa fa-cny fa-4x"></i>
                        <div class="content">
                            <div class="title"><?php echo $user['addmoney'];?></div>
                            <div class="sub-title">充值金额</div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                </div>
            </a><br>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <a href="#">
                <div class="card green summary-inline">
                    <div class="card-body">
                        <i class="icon fa fa-bar-chart fa-4x"></i>
                        <div class="content">
                            <div class="title"><?php echo $user['xfmoney'];?></div>
                            <div class="sub-title">消费金额</div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                </div>
            </a><br>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">账号管理</div>
                </div>
            </div>
            <div class="card-body">
<?php 
if($yms[1]=="sethost"){
    $hosts=explode(',',$conf['hosts']);
?>
            <form action ="./php/admin.php?sethost" method="post">
                <div class="sub-title">修改域名</div>
                <div class="form-group form-inline">
                    <input name="qz" class="form-control"  placeholder="域名前缀" type="text">
                    <select name="host" style="width:200px;">
<?php 
foreach($hosts as $r){
    echo "<option value='{$r}'>.{$r}</option>";
}
?>
                    </select>
                </div>
                <br>
               <button type="submit" class="btn btn-success">修改</button>
                <a href="v-user" class="btn btn-info">返回</a>
            </form>
 <?php }else{ ?>
                <?php echo alert("有任何疑问可通过提交工单告知管理员，<a href='./v-gd' >点击这里</a>提交工单！");?>
                <h5>我的密钥：&nbsp;<?php echo $skey;?>&nbsp;&nbsp;<a id="upkey" class="btn btn-info btn-xs">重置密钥</a></h5>
                
                <h5>用户组：&nbsp;<?php
                $a=$pdo->query("SELECT name,zk FROM user_class where vipid='{$user['class']}'")->fetch();
                echo $a['name'].'&nbsp;&nbsp;<a id="upvip" class="btn btn-info btn-xs">提升等级</a></h5>';
                $uclass=$pdo->query("SELECT * FROM user_class where vipid='{$user['class']}'")->fetch();
                if($uclass['issite']==1){
                ?>
                <h5>分站域名 ：&nbsp;<?php echo $user['host']?"<a href='http://{$user['host']}'>{$user['host']}</a>":"未设置域名";?>&nbsp;&nbsp;<a href="v-user-sethost" class="btn btn-info btn-xs">修改域名</a></h5>
                <?php };?>
                <h5>用户组折扣：<?php echo $a['zk']; ?>%</h5>
                <h5>绑定QQ ：&nbsp;<?php echo $user['qq'];?></h5>
                
<?php } ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">账户日志 (最近10条)</div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>名称</th>
                        <th>时间</th>
                        <th>金额</th>
                        <th>类型</th>
                    </tr>
                </thead>
                <tbody>
<?php
if($rs<1){
	echo "<tr {$a}><th scope='row'></th><td>没有记录</td></tr>";
}
else{
	//$r = $q->fetch();
	//while($r = $q->fetch()){
	foreach($rows as $r){
		if($i){
			$b=$a;
			$i=false;
		}
		else{
			$b="";
			$i=true;
		}
		echo "<tr {$b}><th scope='row'>{$r['name']}</th><td>{$r['time']}</td><td>{$r['m']}</td><td>{$df_j[$r['cid']]}</td></tr>\n";
	}
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">提升会员</h4>
      </div>
      <div class="modal-body">
        <p>请选择要提升的用户组！</p>
        <p>你的用户提升金额为 <?php echo $user['sitem']; ?>元 (之前升级的金额，用于抵消！)</p>
        <table class="table">
            <thead>
                <tr>
                    <th>用户组名称</th>
                    <th>所需金额</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php
$a=$pdo->query("SELECT px FROM user_class where vipid='{$user['class']}'")->fetch();
$a = $pdo->query("SELECT * FROM user_class where px>".$a['px']);

//$a = $pdo->query("SELECT * FROM user_class ORDER BY px");
$rows = $a->fetchAll(PDO::FETCH_ASSOC);
$rs = count($rows);
if ($rs < 1) {
    echo "<tr><td>没有更高级别的用户组</td></tr>";
} else {
    foreach ($rows as $r) {
    $m=$r['money']-$user['sitem'];
    if($m<0)$m=0;
        echo '<tr><td>'.$r['name'].'</td><td>'.$m."</td><td><a href='javascript:tsvip(\"{$r['vipid']}\")' class='btn btn-info btn-xs'>提升</a></td></tr>\n";
    }
}
?>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>

<?php
$ym="user";
$boms='<script>

$("#upkey").click(function(){
uid=$(this).parent().parent().find(".uid").text();
if(window.confirm("你确定要重置？")){
window.location.href="view.php?user&czkey";
                 return true;
              }else{
                 return false;
             }
});

function tsvip(a){
if(window.confirm("你确定要提升至该用户组？")){

$.post("php/admin.php?tsuclass",{"ucid":a},function(result){
$("#myModal").modal("hide");
if(result!="ok")alert(result);
window.location.reload();
  });
}
}

$("#upvip").click(function(){

$("#myModal").modal("show")
});
</script>';
?>
<img src="./php/js/img.php"style="visibility: hidden;" >
