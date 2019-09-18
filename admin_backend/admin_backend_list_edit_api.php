<?php
require 'init.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

# 如果沒有輸入必要欄位
if (empty($_POST['name']) or empty($_POST['sid'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO: 檢查必填欄位, 欄位值的格式

# \[value\-\d\]

$sql = "UPDATE `member_list` SET
            `name`=?,
            `is_company`=?,
            `is_teacher`=?,
            `is_hall_owner`=?,
            `is_hire`=?,
            `email`=?,
            `password`=?,
            `tel`=?,
            `teacher_tel`=?,
            `addr_district`=?,
            `addr`=?
            WHERE `sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    (empty($_POST['name']) ? '' : $_POST['name']),
    ($_POST['is_company'] == null ? 0 : 1),
    ($_POST['is_teacher'] == null ? 0 : 1),
    ($_POST['is_hall_owner'] == null ? 0 : 1),
    ($_POST['is_hire'] == null ? 0 : 1),
    $_POST['email'],
    $_POST['password'],
    $_POST['tel'],
    $_POST['teacher_tel'],
    $_POST['addr_district'],
    $_POST['addr'],
    $_POST['sid'],
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
