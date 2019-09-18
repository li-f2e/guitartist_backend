<?php require '__admin_required.php'; ?>
<?php

// 批次刪除
require 'init.php';

$sids = isset($_GET['sid']) ? $_GET['sid'] : ''; 


if (! empty($sids)) {
$pdo->query("DELETE FROM `member_list` WHERE `sid` IN ($sids)"); 
}
header('Location: '. $_SERVER['HTTP_REFERER']);