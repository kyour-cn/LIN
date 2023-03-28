<?php
$sql = "SELECT * FROM news where c1 = 'top' ORDER BY time desc limit 5";
$ttt = $pdo->query("SELECT * FROM news where nid='1'")->fetch();
$tt2 = explode('|.|', $ttt['c2']);
$tt3 = explode('|.|', $ttt['c3']);
$tt4 = explode('|.|', $ttt['c4']);
$ttxt = explode('|.|', $ttt['text']);
    $btitle=$btitle."/公告设置";
?>

<div class="row">
    <div class="col-lg-8 col-xs-12">



        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">系统公告设置</div>
                </div>
            </div>
            <div class="card-body">
                <form action ="./php/admin.php?systemgg" method="post">
                    <p><font color="red">这里是本系统运行设置，数据一般保存到数据库，如有不清楚的设置请勿修改，以免造成不可逆的后果。</font></p>


                    <div class="sub-title">公告</div>
                    <div>
                        <textarea name="ggtext" class="form-control" id="ggtext">
                            <?php echo str_replace("\\n", "\n", $conf['gg']); ?>
                        </textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">提交修改</button>
                </form>

            </div>
        </div>
        <br>




        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">热门推荐设置</div>
                </div>
            </div>
            <div id="text" class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-xs-12">
                        <form class="bs-example bs-example-form" action ="./php/admin.php?systemtg" method="post">

                            <label for="basic-url">第一个推荐</label>
                            <div class="input-group">
                                <span class="input-group-addon">名称</span>
                                <input class="form-control" type="text" name="va1" value="<?php echo $tt2[0];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">价格</span>
                                <input class="form-control" type="text" name="va2" value="<?php echo $tt3[0];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">介绍</span>
                                <input class="form-control" type="text" name="va3" value="<?php echo $ttxt[0];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">商品分类ID</span>
                                <input class="form-control" type="text" name="va4" value="<?php echo $tt4[0];?>">
                            </div>

                            <label for="basic-url">第二个推荐</label>
                            <div class="input-group">
                                <span class="input-group-addon">名称</span>
                                <input class="form-control" type="text" name="vb1" value="<?php echo $tt2[1];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">价格</span>
                                <input class="form-control" type="text" name="vb2" value="<?php echo $tt3[1];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">介绍</span>
                                <input class="form-control" type="text" name="vb3" value="<?php echo $ttxt[1];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">商品分类ID</span>
                                <input class="form-control" type="text" name="vb4" value="<?php echo $tt4[1];?>">
                            </div>

                            <label for="basic-url">第三个推荐</label>
                            <div class="input-group">
                                <span class="input-group-addon">名称</span>
                                <input class="form-control" type="text" name="vc1" value="<?php echo $tt2[2];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">价格</span>
                                <input class="form-control" type="text" name="vc2" value="<?php echo $tt3[2];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">介绍</span>
                                <input class="form-control" type="text" name="vc3" value="<?php echo $ttxt[2];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">商品分类ID</span>
                                <input class="form-control" type="text" name="vc4" value="<?php echo $tt4[2];?>">
                            </div>

                            <label for="basic-url">第四个推荐</label>
                            <div class="input-group">
                                <span class="input-group-addon">名称</span>
                                <input class="form-control" type="text" name="vd1" value="<?php echo $tt2[3];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">价格</span>
                                <input class="form-control" type="text" name="vd2" value="<?php echo $tt3[3];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">介绍</span>
                                <input class="form-control" type="text" name="vd3" value="<?php echo $ttxt[3];?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">商品分类ID</span>
                                <input class="form-control" type="text" name="vd4" value="<?php echo $tt4[3];?>">
                            </div>
                    <button type="submit" class="btn btn-success">提交修改</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">首页推荐商品设置</h4>
            </div>
            <div class="modal-body">
                <p>名称</p>
                <div><input name="name" value="科佑儿VIP下单系统" class="form-control" type="text"></div>
                <div id="modk"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button id="setbtn" type="button" class="btn btn-primary">修改</button>
            </div>
        </div>
    </div>
</div>

<?php
$boms = "
<script src='https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js'></script>
<script>
function settg(){
$(\"#myModal\").modal(\"show\")
}

$(\"#setbtn\").click(function(){

  $.post(\"php/admin.php?tmoneyupd\",data,function(result){
    alert(result);
$(\"#myModal\").modal(\"hide\")
window.location.reload();
  });
  });



CKEDITOR.replace('ggtext');
</script>";
