<?php require '__admin_required.php'; ?>
<?php

require __DIR__. '/__init.php';

$sid=isset($_GET['sid'])? intval($_GET['sid']) : 0 ;
if(!empty($sid)){
    $sql="DELETE FROM `course_tb` WHERE`sid`=$sid";
    $pdo->query($sql);
}

header('Location:'.$_SERVER['HTTP_REFERER']);