<?php
require '__admin_required.php';

require 'init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (!empty($sid)) {
    $sql = "UPDATE `member_list` SET `is_suspended`=? WHERE `sid`=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['is_suspended'] = 1,
        $sid,
    ]);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
