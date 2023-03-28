<?php

if($_GET['qqss']) exit(file_get_contents("https://www.jibaqiu.com/shuoshuo/ajax.php?act=getshuo&uin=".$_POST['qq']));

echo file_get_contents($_REQUEST['url']);
