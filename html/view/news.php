<?php

$sql="SELECT * FROM news where c1 = 'new' ORDER BY time desc";
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$rs = count($rows);

?>

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">本站全部消息</div>
                </div>
            </div>
            <div class="card-body">
                
                <ul class="message-list">
                    
                    <?php
                    if ($rs < 1) {
                        echo "没有消息";
                    } else {

                        foreach ($rows as $r) {
                            ?>
                                        <a href="v-new-<?php echo $r['nid'];?>">
                                            <li>
                                                <img src="./assets/img/news.png" class="profile-img pull-left">
                                                <div class="message-block">
                                                    <div><span class="username"><?php echo $r['c2'];?></span> <span class="message-datetime"><?php echo $r['time'];?></span>
                                                    </div>
                                                    <div class="message"><?php echo  mb_substr(strip_tags($r['text']), 0, 120, 'utf-8');?></div>
                                                </div>
                                            </li>
                                        </a>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>