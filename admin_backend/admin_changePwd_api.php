<?php
require '__admin_required.php';
require 'init.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

// 如果沒有輸入必要欄位 -> 將上方的$result轉為json -> 結束這支程式
// if (empty($_POST['name']) || empty($_POST['id'])) {
//     echo json_encode($result, JSON_UNESCAPED_UNICODE); // json_encode 將 array 轉換成 json,  JSON_UNESCAPED_UNICODE 跳脫中文字
//     exit;
// }

$sql_1 = 'SELECT `password` FROM `member_list` WHERE `email` = ? AND `password`=?';
$stmt_1 = $pdo->prepare($sql_1);
$stmt_1->execute([
    $_SESSION['loginUser']['email'],
    $_POST['old_pwd'],
]);
$row_1 = $stmt_1->fetch();

// 輸入的舊密碼有在資料庫中
if (!empty($row_1) && $_POST['password'] == $_POST['confirm_pwd']) {
    $sql = "UPDATE `member_list` SET `password`=? WHERE `sid`=? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['password'], $_POST['sid']]);

    // 有成功修改資料
    if ($stmt->rowCount() == 1) {
        $result['success'] = true;
        $result['info'] = '修改成功';
    } else {
        $result['info'] = '沒有修改';
    }
} else {
    if ($_POST['password'] != $_POST['confirm_pwd']) {
        $result['info'] = '輸入密碼不相同';
    } else {
        $result['info'] = '輸入密碼不正確';
    }
}
;


echo json_encode($result, JSON_UNESCAPED_UNICODE);
