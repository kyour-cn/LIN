<?php
$skey=$user['apikey'];
if($yms[1]=='czkey'){//充值KEY
    $skey = "";
    	$strPol = "123456789abcdefghijklmnpqrstuvwxyz";
	    $max = strlen($strPol)-1;
        for($i=0;$i<8;$i++){
                $skey.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        //判断key是否存在
        while(($pdo->query("SELECT count(Id) from user where apikey='{$skey}'")->fetch()[0]!=0)){
        $skey = "";
        for($i=0;$i<8;$i++){
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
                    <div class="title">账号管理</div>
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
                我的密钥：&nbsp;<?php echo $skey;?>&nbsp;<a id="upkey" class="btn btn-info btn-xs">重置密钥</a>
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
	echo "<tr {$a}><th scope='row'></th><td>没有记录</td><td></td><td></td></tr>";
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
		echo "<tr {$b}><th scope='row'>{$r['name']}</th><td>{$r['time']}</td><td>{$r['m']}</td><td>{$df_j[$r['cid']]}</td></tr>";
	}
}
?>
                                                </tbody>
                                            </table>
                                        </div>
                        </div>
</div>
<?php
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
</script>';
?>
<img src="./php/js/img.php"style="visibility: hidden;" >