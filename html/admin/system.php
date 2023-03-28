<?php
$btitle = $btitle . "/系统";
?>
<div class="row">
    <div class="col-md-8 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">系统运行配置</div>
                </div>
            </div>
            <div class="card-body">
                <form action ="./php/admin.php?system" method="post">
                    <p><font color="red">这里是本系统运行设置，数据一般保存到数据库，如有不清楚的设置请勿修改，以免造成不可逆的后果。</font></p>
                    <div class="sub-title">站点名称</div>
                    <div><input name="name" value="<?php echo $conf['name'];?>" class="form-control" type="text"></div>
                    <div class="sub-title">站点标题</div>
                    <div><input name="title" value="<?php echo $conf['title'];?>" class="form-control" type="text"></div>
                    <div class="sub-title">分站可选域名(多个 , 隔开,如 abc.cn)</div>
                    <div><input name="hosts" value="<?php echo $conf['hosts'];?>" class="form-control" type="text"></div>
                    <div class="sub-title">CDN (assets目录地址，默认./或留空)</div>
                    <div><input name="cdn" value="<?php echo $conf['cdn'];?>" class="form-control" type="text"></div>
                    <div class="sub-title">安全设置</div>
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
                    </div>
                    

                    <br>
                    <button type="submit" class="btn btn-success">提交数据</button>
                </form>

            </div>
        </div>
    </div>
</div>

