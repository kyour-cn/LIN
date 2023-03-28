<?php
$iuser=array();
if($yms[2]=="add"){
    //$iuser=array('zt'=>'1','money'=>'0');
    $btitle=$btitle."/添加用户分组";
}else{
$iuser=$pdo->query("SELECT * FROM news where nid='{$yms[2]}'")->fetch();
}
?>
                    <div class="row">
                        <div class="col-sm-8 col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">站内信编辑</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action ="./php/admin.php?newupd&<?php echo $yms[2];?>" method="post">
                                    <font color="red">提示：修改后立即生效！</font>
                                    <div class="sub-title">消息标题</div>
                                    <div>
                                        <input name="name" value="<?php echo $iuser['c2'];?>" class="form-control" type="text">
                                    </div>
                                    <div class="sub-title">消息内容</div>
                                                        <div>
                        <textarea name="text" class="form-control" id="text">
                            <?php echo $iuser['text']; ?>
                        </textarea>
                    </div>
                                    
                                    <br>
                                    <button type="submit" class="btn btn-success">提交数据</button>
                                    <a href="./view.php?admin&news" class="btn btn-info">返回列表</a>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php
$boms = "
<script src='https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js'></script>
<script>
CKEDITOR.replace('text');
</script>";
