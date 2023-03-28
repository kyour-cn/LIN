<?php

include $_SERVER['DOCUMENT_ROOT'].'/php/main.php';
$q=query("SELECT text FROM tools where tid=?",array($_GET["tid"]))->fetch();

echo $q['text'];