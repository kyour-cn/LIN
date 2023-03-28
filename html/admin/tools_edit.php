<?php
$iuser = array('zt' => '1', 'money' => '0','px'=>10);
if ($yms[2] == "add") {
    //$iuser=array('zt'=>'1','money'=>'0');
    $btitle = $btitle . "/添加商品";
} else {
    $iuser = $pdo->query("SELECT * FROM tools where tid='{$yms[2]}'")->fetch();
}
?>
<div class="row">
    <div class="col-sm-8 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">商品信息编辑</div>
                </div>
            </div>
            <div class="card-body">
                <form action ="./php/admin.php?toolsupd&<?php echo $yms[2]; ?>" method="post">
                    <font color="red">提示：请按规范编辑商品信息，避免出错！</font>
                    <div class="sub-title">商品id</div>
                    <div>
                        <input name="tid" placeholder="<?php echo $iuser['tid']; ?>" class="form-control" type="text">
                    </div>
                    <div class="sub-title">商品名</div>
                    <div>
                        <input name="name" value="<?php echo $iuser['name']; ?>" class="form-control" type="text">
                    </div>
                    <div class="sub-title">下单参数名(多个以 | 符号隔开)</div>
                    <div>
                        <input name="inputs" value="<?php echo $iuser['inputs']; ?>" class="form-control" type="text">
                    </div>
                    <div class="sub-title">默认价格(普通用户)</div>
                    <div>
                        <input name="money" value="<?php echo $iuser['money']; ?>" class="form-control" placeholder="不能位空" type="text">
                    </div>
                    <div class="sub-title">排序</div>
                    <div>
                        <input name="px" value="<?php echo $iuser['px']; ?>" class="form-control" type="text">
                    </div>
                    <div class="sub-title">商品介绍文本</div>
                    <div>
                        <textarea name="text" class="form-control" id="editor">
                            <?php echo str_replace("\\n", "\n", $iuser['text']); ?>
                        </textarea>
                    </div>

                    <div class="sub-title">选择分类</div>
                    <select name="cid" style="width:100%;" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">

                        <?php
                        $a = $pdo->query("SELECT * FROM class ORDER BY px");
                        $rows = $a->fetchAll(PDO::FETCH_ASSOC);
                        $rs = count($rows);

                        if ($rs < 1) {
                            echo "没有分类";
                        } else {
                            foreach ($rows as $r) {
                                $a = '<option';
                                if ($r['cid'] == $iuser['class'])
                                    $a = $a . ' selected="selected"';
                                echo $a . " value='{$r['cid']}'>{$r['name']}</option>";
                            }
                        }
                        ?>
                    </select>

                    <div class="sub-title">订单处理方式</div>
                    <select name="clid" id="clid" style="width:100%;" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">

                        <?php
                        foreach ($df_clid as $k => $v) {
                            $a = '<option';
                            if ($k == $iuser['clid'])
                                $a = $a . ' selected="selected"';
                            echo $a . " value='{$k}'>{$v}</option>";
                        }
                        ?>
                    </select>
                    <div id="clv"></div>
                    <div class="sub-title">商品状态</div>
                    <div class="checkbox3 checkbox-success checkbox-inline checkbox-check checkbox-round  checkbox-light">
                        <input name="zt" value="1" id="checkbox-fa-light-2" <?php if ($iuser['zt'] == "1") echo 'checked="checked"'; ?> type="checkbox">
                        <label for="checkbox-fa-light-2">
                            是否上架该商品
                        </label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">提交数据</button>
                    <a href="./view.php?admin&tools" class="btn btn-info">返回列表</a>
                </form>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
<?php
$boms = "<script>
var clid='" . $iuser['clid'] . "';
var clval='" . $iuser['clval'] . "';
var clpost='" . $iuser['clpost'] . "';
var cookie='" . $iuser['cookie'] . "';
function toe(a,b,c){
return '<div class=\"sub-title\">'+a+'</div><div><input name=\"'+b+'\" id=\"'+b+'\"value=\"'+c+'\" class=\"form-control\" type=\"text\"></div>';
}

function cls(a){
switch(a){
case '0':
$('#clv').html('');
break;
case '1':
$('#clv').html(toe('URL地址(可用变量)','clval','clval')+toe('POST值(可用变量)','clpost','clpost')+toe('Cookie(可留空)','cookie','cookie'));
$('#clpost').val(clpost);
$('#clval').val(clval);
$('#cookie').val(cookie);
break;
case '2':
$('#clv').html(toe('邮箱地址','clval','clval'));
$('#clval').val(clval);
break;
case '3':
$('#clv').html(toe('第三方商城','clval','clval'));
$('#clval').val('社区功能开发中...');
}
}

CKEDITOR.replace('text');
$('#clid').change(function(){
var vv=$(this).val();
cls(vv);
});
cls($('#clid').val());
</script>";
