<?php
$btitle="在线充值";
$i=true;
$a='class="active"';
$b="";
$q=query("SELECT * FROM user_log where cid='1' and uid=? ORDER BY time desc limit 0,10" ,array($_SESSION["user_uid"]));
$rows=$q->fetchAll(PDO::FETCH_ASSOC);
$rs=count($rows);
?>
<div class="row">
<div class="col-sm-7 col-xs-12">
<div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">本站余额充值</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="./pay/epay.php?add" method="post">
                                    <blockquote>
                                          <p>您在本站共充值了<?php echo $user['addmoney']; ?>元，当前剩余<?php echo $user['money']; ?>元！</p>
                                          <footer>感谢您对我们的信任 <cite title="Source Title">祝您生活愉快</cite></footer>
                                    </blockquote>
                                    <div class="sub-title">充值金额数量（元/人名币）</div>
                                    <div>
                                        <input class="form-control" name="money" placeholder="可保留两位小时，比如 20.55" type="text">
                                    </div>
                                    <p class="bg-success">我们支持最常用的QQ、微信、支付宝三大平台在线充值，方便、快捷、安全的选择！</p>
                                    <div class="sub-title">请选择支付方式</div>
                                        <div>
                                          <div class="radio3 radio-check radio-inline">
                                            <input id="radio4" name="type" value="alipay" checked="" type="radio">
                                            <label for="radio4">
                                              支付宝
                                            </label>
                                          </div>
                                          <div class="radio3 radio-check radio-success radio-inline">
                                            <input id="radio5" name="type" value="wxpay" type="radio">
                                            <label for="radio5">
                                              微信
                                            </label>
                                          </div>
                                          <div class="radio3 radio-check radio-warning radio-inline">
                                            <input id="radio6" name="type" value="qqpay" type="radio">
                                            <label for="radio6">
                                              QQ
                                            </label>
                                          </div>
                                        </div>
                                    <button type="submit" class="btn btn-success">充值</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="card">
                            <div class="card-header">
                                    <div class="card-title">
                                    <div class="title">我的充值记录</div>
                                    </div>
                                </div>
                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
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
		echo "<tr {$b}><th scope='row'>{$r['Id']}</th><td>{$r['time']}</td><td>{$r['m']}</td><td>{$df_j[$r['cid']]}</td></tr>";
	}
}
?>
                                                </tbody>
                                            </table>
                                        </div>
                        </div>
                    </div>