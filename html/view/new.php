<?php 
    $btitle=$btitle."/消息查看";
    
    $iuser=$pdo->query("SELECT * FROM news where nid='{$yms[1]}'")->fetch();
?>

<div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title"><?php echo $iuser['c2']; ?></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="sub-title"><?php echo $iuser['time']; ?></div>
                                    <?php echo $iuser['text']; ?>
                                    <a href="main" class="btn btn-info">返回首页</a>
                                </div>
                            </div>