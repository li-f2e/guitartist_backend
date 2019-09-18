<?php
require '__admin_required.php';
require 'init.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];

$sql = "UPDATE `member_list` SET `alt_email`=?,`tel`=?,`alt_tel`=?,`fax`=?, `addr`=?  WHERE `sid`=? ";



// 如果沒有輸入必要欄位 -> 將上方的$result轉為json -> 結束這支程式
// if (empty($_POST['name']) || empty($_POST['id'])) {
//     echo json_encode($result, JSON_UNESCAPED_UNICODE); // json_encode 將 array 轉換成 json,  JSON_UNESCAPED_UNICODE 跳脫中文字
//     exit;
// }

$stmt = $pdo->prepare($sql);


$stmt->execute([
    // $_POST['email'], 
    $_POST['alt_email'],
    $_POST['tel'],
    $_POST['alt_tel'],
    $_POST['fax'],
    $_POST['addr'],
    $_POST['sid']
]);
// 沒有修改內容 = 沒有更新內容 => rowCount = 0; 
if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
