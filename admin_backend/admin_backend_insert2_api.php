<?php
require '__admin_required.php';

require 'init.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '沒有輸入姓名',
    'post' => $_POST,
];

# 如果沒有輸入必要欄位, 就離開
// if (empty($_POST['name'])) {
//     echo json_encode($result, JSON_UNESCAPED_UNICODE); // json_encode 將 array 轉換成 json,  JSON_UNESCAPED_UNICODE 跳脫中文字
//     exit;
// }

$sql = "INSERT INTO `member_list`(`name`, `is_company`, `is_teacher`, `is_hall_owner`, `is_hire`, `email`, `password`, `tel`, `tax_id`, `capital`, `ppl_num`, `addr_district`,`addr`, `brand_1`, `brand_2`, `brand_3`, `fax`, `bank_acc`, `bank_num`, `teacher_name`, `teacher_birthday`, `teacher_gender`, `teacher_tel`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
    $_POST['tax_id'],
    $_POST['capital'],
    $_POST['ppl_num'],
    $_POST['addr_district'],
    $_POST['addr'],
    $_POST['brand_1'],
    $_POST['brand_2'],
    $_POST['brand_3'],
    $_POST['fax'],
    $_POST['bank_acc'],
    $_POST['bank_num'],
    (empty($_POST['teacher_name']) ? '' : $_POST['teacher_name']),
    $_POST['teacher_birthday'],
    ($_POST['teacher_gender'] == null ? 'none' : $_POST['teacher_gender']),
    (empty($_POST['teacher_tel'])) ? '' : $_POST['teacher_tel'],
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE); // 將 Array 轉為 JSON 格式
