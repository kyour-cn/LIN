<?php
$iuser=array('zt'=>'1','money'=>'0','px'=>"10","iszk"=>"");
if($yms[2]=="add"){
    //$iuser=array('zt'=>'1','money'=>'0');
    $btitle=$btitle."/添加用户分组";
}else{
$iuser=$pdo->query("SELECT * FROM class where cid='{$yms[2]}'")->fetch();
}
?>
                    <div class="row">
                        <div class="col-sm-8 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">商品分类编辑</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action ="./php/admin.php?classupd&<?php echo $yms[2];?>" method="post">
                                    <font color="red">提示：编辑分组立即生效！</font>
                                    <div class="sub-title">分类ID</div>
                                    <div>
                                        <input name="cid" placeholder="<?php echo $iuser['cid'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">分类名</div>
                                    <div>
                                        <input name="name" value="<?php echo $iuser['name'];?>" class="form-control" type="text">
                                    </div>
                                    
                                    <div class="sub-title">排序</div>
                                    <div>
                                        <input name="px" value="<?php echo $iuser['px'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">分类介绍</div>
                                    <div>
                                        <input name="text" value="<?php echo $iuser['text'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">分类状态</div>
                                    <div class="checkbox3 checkbox-success checkbox-inline checkbox-check checkbox-round  checkbox-light">
                                            <input name="zt" value="1" id="checkbox1" <?php if($iuser['zt']=="1")echo 'checked="checked"';?> type="checkbox">
                                            <label for="checkbox1">
                                              是否启用该分类
                                            </label>
                                    </div><br>
                                    <div class="checkbox3 checkbox-success checkbox-inline checkbox-check checkbox-round  checkbox-light">
                                            <input name="iszk" value="1" id="checkbox2" <?php if($iuser['iszk']=="1")echo 'checked="checked"';?> type="checkbox">
                                            <label for="checkbox2">
                                              是否启用用户组折扣
                                            </label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">提交数据</button>
                                    <a href="./view.php?admin&class" class="btn btn-info">返回列表</a>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>