<?php
require '__admin_required.php';

require 'init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(! empty($sid)) {
    $sql = "DELETE FROM `member_list` WHERE `sid`=$sid";
    $pdo->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);