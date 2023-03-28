<?php
$iuser=array('zt'=>'1','money'=>'0');
if($yms[2]=="add"){
    //$iuser=array('zt'=>'1','money'=>'0');
    $btitle=$btitle."/添加用户";
}else{
$iuser=$pdo->query("SELECT * FROM user where uid='{$yms[2]}'")->fetch();
}
?>
                    <div class="row">
                        <div class="col-sm-8 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">用户编辑</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action ="./php/admin.php?userupd&<?php echo $yms[2];?>" method="post">
                                    <font color="red">提示：用户资料请谨慎修改，修改资料或余额可能会引用户不满！</font>
                                    <div class="sub-title">用户ID</div>
                                    <div>
                                        <input name="uid" placeholder="<?php echo $iuser['uid'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">用户名</div>
                                    <div>
                                        <input name="name" value="<?php echo $iuser['name'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">余额</div>
                                    <div>
                                        <input name="money" value="<?php echo $iuser['money'];?>" class="form-control" placeholder="不能位空" type="text">
                                    </div>
                                    <div class="sub-title">QQ</div>
                                    <div>
                                        <input name="qq"  value="<?php echo $iuser['qq'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">密码</div>
                                    <div>
                                        <input name="pass" placeholder="留空则不修改" class="form-control"  type="text">
                                    </div>
                                    
                                    <div class="sub-title">用户组</div>
                                    <select name="cid" style="width:100%;" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
                                    
                                                        <?php
$a = $pdo->query("SELECT * FROM user_class ORDER BY px");
$rows = $a->fetchAll(PDO::FETCH_ASSOC);
$rs = count($rows);

                    if ($rs < 1) {
                        echo "<th scope='row'></th><td>没有记录</td><td></td><td></td><td></td><td></td></tr>";
                    } else {
                        foreach ($rows as $r) {
                            $a= '<option';
                            if($r['vipid']==$iuser['class'])$a=$a. ' selected="selected"';
                            echo $a." value='{$r['vipid']}'>{$r['name']}</option>";
                        }
                    }
                    ?>
                                        </select>
                                        
                                    <div class="sub-title">账号状态</div>
                                    <div class="checkbox3 checkbox-success checkbox-inline checkbox-check checkbox-round  checkbox-light">
                                            <input name="zt" value="1" id="checkbox-fa-light-2" <?php if($iuser['zt']=="1")echo 'checked="checked"';?> type="checkbox">
                                            <label for="checkbox-fa-light-2">
                                              是否启用该账号
                                            </label>
                                          </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">提交数据</button>
                                    <a href="./view.php?admin&user" class="btn btn-info">返回列表</a>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>