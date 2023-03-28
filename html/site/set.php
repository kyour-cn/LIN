<?php
$btitle = $btitle . "/系统";

?>
<div class="row">
    <div class="col-md-8 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">站点配置</div>
                </div>
            </div>
            <div class="card-body">
                <form action ="./php/admin.php?mysiteupd" method="post">
                    <div class="sub-title">站点名称</div>
                    <div><input name="name" value="<?php echo $sites[0];?>" class="form-control" type="text"></div>
                    <div class="sub-title">站点标题</div>
                    <div><input name="title" value="<?php echo $sites[1];?>" class="form-control" type="text"></div>
                    <div class="sub-title">站点公告</div>
                    <div>
                        <textarea name="ggtext" class="form-control" id="ggtext">
                            <?php echo $sites[2]; ?>
                        </textarea>
                    </div>
                    <!--div class="sub-title">安全设置</div>
                    <div class="checkbox3 checkbox-success checkbox-inline checkbox-check checkbox-round  checkbox-light">
                        <input name="ccon" value="1" id="c1" <?php if ($conf['ccon'] == "1") echo 'checked="checked"'; ?> type="checkbox">
                        <label for="c1">
                            是否开启防CC模块
                        </label>
                    </div><br>
                    <div class="checkbox3 checkbox-success checkbox-inline checkbox-check checkbox-round  checkbox-light">
                        <input name="ptime" value="1" id="c2" <?php if ($conf['ptime'] == "1") echo 'checked="checked"'; ?> type="checkbox">
                        <label for="c2">
                            默认时区（国外服务器开启）
                        </label>
                    </div-->
                    

                    <br>
                    <button type="submit" class="btn btn-success">提交数据</button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php
$boms = "
<script src='https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js'></script>
<script>
CKEDITOR.replace('ggtext');
</script>";