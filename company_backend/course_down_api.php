<?php require '__admin_required.php'; ?>
<?php

require __DIR__ . '/init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (!empty($sid)) {
    $out="1";
    $sql = "UPDATE `course_tb` SET `course_down`=$out WHERE`sid`=$sid";
    
    $pdo->query($sql);
   
}

header('Location:' . $_SERVER['HTTP_REFERER']);
