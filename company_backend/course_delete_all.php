<?php require '__admin_required.php'; ?>
<?php

// 多重刪除
require __DIR__. '/__init.php';

$sids = isset($_GET['sid']) ? $_GET['sid'] : ''; //將陣列轉成字串
    

if (! empty($sids)) {
$pdo->query("DELETE FROM `course_tb` WHERE `sid` IN ($sids)"); 
}
header('Location: '. $_SERVER['HTTP_REFERER']);