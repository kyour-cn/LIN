<?php
$iuser=array('zt'=>'1','money'=>'0','px'=>"10","zk"=>100);
if($yms[2]=="add"){
    //$iuser=array('zt'=>'1','money'=>'0','px'=>"10");
    $btitle=$btitle."/添加用户分组";
}else{
$iuser=$pdo->query("SELECT * FROM user_class where vipid='{$yms[2]}'")->fetch();
}
?>
                    <div class="row">
                        <div class="col-sm-8 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">用户分组编辑</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action ="./php/admin.php?user_classupd&<?php echo $yms[2];?>" method="post">
                                    <font color="red">提示：编辑分组立即生效！</font>
                                    <div class="sub-title">分组ID(全英文)</div>
                                    <div>
                                        <input name="vipid" placeholder="<?php echo $iuser['vipid'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">分组名</div>
                                    <div>
                                        <input name="name" value="<?php echo $iuser['name'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">默认折扣:?%</div>
                                    <div>
                                        <input name="zk" value="<?php echo $iuser['zk'];?>" class="form-control" placeholder="不能位空" type="text">
                                    </div>
                                    <div class="sub-title">价值</div>
                                    <div>
                                        <input name="money" value="<?php echo $iuser['money'];?>" class="form-control" type="text">
                                    </div>
                                    <?php if($iuser['vipid']!="main"){ ?>
                                    <div class="sub-title">排序</div>
                                    <div>
                                        <input name="px" value="<?php echo $iuser['px'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">用户组状态</div>
                                    <div class="checkbox3 checkbox-success checkbox-inline checkbox-check checkbox-round  checkbox-light">
                                        <input name="zt" value="1" id="ck1" <?php echo $iuser['issite'] == "1"?'checked="checked"':''; ?> type="checkbox">
                                        <label for="ck1">
                                            是否启用分站
                                        </label>
                                    </div>
                                    <?php }?>
                                    <br>
                                    <button type="submit" class="btn btn-success">提交数据</button>
                                    <a href="./view.php?admin&user_class" class="btn btn-info">返回列表</a>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>